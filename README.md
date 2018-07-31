1 - installer wamp
2 - copier le code source dans le repertoire www de wamp
3 - importer le fichier mada.sql dans un SGBD mysql
4 - Aller dans la racine de l'application,ouvrir une ligne de commande, puis lancer la commande suivante:
        # php bin/console doctrine:schema:update --force
        si la ligne de commande ne reconnait pas php, il faut ajouter php dans le variable d'environnement de windows
        php se trouve dans: C:\wamp64\bin\php\php5.6.25 (le chemin peut etre different)
5 - visitez l'adresse : http://localhost/Madagascar/web/app_dev.php/
6 - C'est fini

login: harivola @gmail.com
mdp: 12345

NB: Vous pouvez ajouter des utilisateurs en cliquant sur inscription dans la page login
