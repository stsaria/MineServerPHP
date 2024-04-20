mkdir minecraft log data minecraft/log
cd data && touch mcversions.json server.csv && echo 0 > createNum.txt && cd ..
cd log && touch php.log python.log && cd ..
sudo apt install python3-pip php screen -y
pip3 install requests