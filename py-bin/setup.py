import getpass, shutil, os

mkdir = ["minecraft", "log", "data", "minecraft/log"]
mkfile = ["data/server.csv", "data/createNum.txt", "log/php.log", "log/python.log"]

systemdBase = """[Unit]
Description=Minecraft Server PHP Service
After=network.target

user={0}

[Service]
WorkingDirectory={1}

Restart=always

ExecStart=bash start.sh

[Install]
WantedBy=multi-user.target""".format(getpass.getuser(), os.path.abspath("./"))

def commandAdmin(command : str):
    if shutil.which("sudo"):
        command = "sudo " + command
    os.system(command)

def download(url : str):
    try:
        os.system("wget "+url)
        return True
    except:
        return False

def main():
    for i in mkdir:
        os.makedirs(i, exist_ok=True)
    
    for i in mkfile:
        with open(i, mode="w"): pass
    
    with open("data/createNum.txt", mode="w") as fp:
        fp.write("0")
        
    with open("./msp.service", mode="w") as fp:
        fp.write(systemdBase)
    
    commandAdmin("apt update")
    commandAdmin("apt upgrade -y")
    commandAdmin("apt install python3-full python3-pip php screen -y")
    download("https://corretto.aws/downloads/latest/amazon-corretto-22-x64-linux-jdk.deb", "corretto-jdk.deb")
    commandAdmin("dpkg -i corretto-jre.deb")
    os.system("pip3 install requests")
    commandAdmin("cp ./msp.service /etc/systemd/system/msp.service")
    commandAdmin("systemctl daemon-reload")
    
    print("""----- MSP Systemd -----
MSP Daemon : systemctl start/stop/enable msp.service""")
    
    os.remove("msp.service")
    os.remove("corretto-jdk.deb")

if __name__ == "__main__":
    main()