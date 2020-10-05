# Projet Guerledan en bassin à l'ENSTA BRETAGNE du 04/10/20 au 09/10/20

#Test Raspberry Pi 3 : 
ping 172.20.25.220

#Test bateau X : 
ping 172.20.25.2X
#Ex : test bateau 14 : ping 172.20.25.214

#Pour se connecter en ssh à la Rasp
ssh ue32@172.20.25.220

#Copier un fichier par ssh sur la Rasp à la racine
scp test.py ue32@172.20.25.220:

#Copier un fichier par ssh sur la Rasp dans le dossier nomDuDossier
scp test.py ue32@172.20.25.220:nomDuDossier

#Copier un dossier monDossier en ssh sur la Rasp
scp -r monDossier ue32@172.20.25.220:nomDuDossier

#Copier un fichier de la Rasp sur son PC perso
scp /Piquarricau/test.py estellearrc@172.20.22.55:~/Documents/Cours/ENSTA_Bretagne_2020_2022/Guerledan/Piquarricau

#Si problème de connection en ssh depuis la Rasp sur le PC, voir lien ci-dessous
https://phoenixnap.com/kb/ssh-to-connect-to-remote-server-linux-or-windows

#Détecter le bus I2C
i2cdetect -y o (ou 1)
