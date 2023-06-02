docker ps
clear
git clone https://github.com/PDanielFG/tfg-desplegado.git
ls
mv tfg-desplegado/  app
ls
cd aa
cd app/
ls
cp docker-compose.yml ../
rm docker-compose.yml 
ls
cd ..
ls
clear
docker-compose up -d
sudo apt install docker-compose
clear
docker-compose up -d
docker ps
docker-compose down
