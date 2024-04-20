from os import chdir
from os.path import abspath, dirname

chdir(abspath(dirname(__file__)))

import configparser, subprocess, traceback, requests, logging, fcntl, json, sys, os

SERVERUUID = sys.argv[2]

logger = logging.getLogger()
logging.basicConfig(filename="../minecraft/log/"+SERVERUUID+".log", level=logging.INFO, format="%(asctime)s %(levelname)s %(name)s :%(message)s")

ini = configparser.ConfigParser()
ini.read('../config/config.ini')

def download(url : str, filename : str):
    try:
        with open(filename, mode='wb') as f:
            f.write(requests.get(url).content)
        return True
    except:
        return False

def getServerUrl(version : str):
    try:
        jsonDict = json.loads(requests.get("https://mcversions.net/mcversions.json").text)
        return jsonDict["stable"][version]["server"]
    except:
        return None

def createServer(serverUuid : str, motd : str, version : str):
    logger.info("- Create Server -")
    logger.info("ServerVer : "+version)
    
    os.mkdir("../minecraft/"+serverUuid)
    
    logger.info("Get Server DL URL.")
    serverUrl = getServerUrl(version)
    if not serverUrl:
        logger.error("Could not retrieve server URL.")
        return 1
    logger.info("ServerDL URL : "+serverUrl)
    logger.info("Download Server.")
    if not download(serverUrl, "../minecraft/"+serverUuid+"/server.jar"):
        logger.error("Server download failed.")
        return 2
    with open("../minecraft/"+serverUuid+"/eula.txt", mode="w") as fp:
        fp.write("eula=true")
    with open("../minecraft/"+serverUuid+"/server.properties", mode="w") as fp:
        fp.write(requests.get("https://server.properties/").text
                 .replace("motd=motd=A Minecraft Server", "motd="+motd))
    logger.info("- Create server success -")
    return 0
        
def startServer(serverUuid : str):
    logger.info("- Start Server -")
    with open("../data/createNum.txt", "r") as fp:
        createNum = fp.read()
        if int(createNum) > int(ini["server"]["serverCreationLimitsNum"]):
            logger.error("The maximum creation limit has been exceeded.")
            return 1
        
    fp = open("../data/createNum.txt", "w")
    fcntl.flock(fp.fileno(), fcntl.LOCK_EX)
    fp.write(str(int(createNum)+1))
    fcntl.flock(fp.fileno(), fcntl.LOCK_UN)
    fp.close()
    
    port = ini["server"]["serverPort"].split(",")[int(createNum)]
    
    logger.info(port)
    
    with open("../minecraft/"+serverUuid+"/server.properties", mode="r+") as fp:
        fp.write(fp.read().replace("server-port=25565", "server-port="+port))
    
    subprocess.call("java -Xms"+ini["server"]["serverMemXmsGiga"]+"G -Xmx"+ini["server"]["serverMemXmxGiga"]+"G -jar server.jar -nogui", cwd="../minecraft/"+serverUuid, shell=True)
    
    with open("../data/createNum.txt", "r") as fp:
        createNum = fp.read()
    
    fp = open("../data/createNum.txt", "w")
    fcntl.flock(fp.fileno(), fcntl.LOCK_EX)
    fp.write(str(int(createNum)-1))
    fcntl.flock(fp.fileno(), fcntl.LOCK_UN)
    fp.close()
    logger.info("- Stop Server -")
    return 0

if __name__ == "__main__":
    try:
        logger.info("Yea Yea Python Server")
        if sys.argv[1] == "-create":
            result = createServer(SERVERUUID, sys.argv[3], sys.argv[4])
            if result != 0: sys.exit(result)
        elif sys.argv[1] == "-start":
            startServer(SERVERUUID)
            
    except Exception as e:
        logger.error(traceback.format_exc())