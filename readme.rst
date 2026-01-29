############
Présentation
############

Ce projet fait partie du cours de base de données du DUT MMI de l'IUT de Lens.
Il s'agit d'un site permettant de naviguer dans une base de données sur les
séries.
Les données sont obtenues par l'API de TVMaze
(https://www.tvmaze.com/api). Le site a été développé en utlisant Spectre CSS.
Tout est complet et fonctionnel, à l'exception du fichier
application/config/query.sql supposé contenir toutes les requêtes SQL du site,
et qui contient à la place un descriptif des requêtes attendues et dont l'écriture
est laissée en exercice. Le but est de rendre le site pleinement opérationnel.


**********
Pré-requis
**********

Le projet nécessite une version suffisament récente de PHP, ainsi que
l'installation de quelques bibliothèques par Composer
(qui doit donc être installé aussi). Vous devez disposer d'un accès à une base
de données MySQL (déjà créée) qui contiendra les
séries (pour remplir la base, vous pouvez importer le fichier tvshows.sql si ce
n'est pas déjà fait. On suppose donc dans la suite qu'un LAMP, MAMP ou WAMP est disponible

************
Installation
************

Si les fichiers sont récupérés sous forme d'archive, il faut l'extraire. Ensuite,
à partir du répertoire racine du projet (celui contenant ce fichier d'aide) il
faut installer le projet avec composer::

  composer install

Il faut adapter le contenu de application/config/config.php à votre configuration de
base de données et à l'url du site.

A l'iut, les informations utiles peuvent être obtenues avec la commande suivante::

  cat ~/.my.cnf

Les deux principales options pour faire tourner le site sont la ligne de commande (php -S)
et l'hébergement

Dans le premier cas, à partir de la racine du projet, on utilise php pour servir le
site::

  php -S 127.0.0.1:8000

Normalement, on peut ensuite l'ouvrir dans un navigateur à cette addresse
( 127.0.0.1:8000 )


***********
Hébergement
***********


Si vous ne disposez pas de php en ligne de commande ou si vous voulez un hébergement plus permanent,
il est possible d'utiliser votre serveur web (en local ou chez un hébergeur). Pour cela il faut :

1) Vérifier que le répertoire contenant le site est placé dans votre 'documentRoot' ou 'htdocs')
   (ex : /var/www/ sous Linux), le déplacer si nécessaire. Par défaut, le site est dans un répertoire
   MySeries.

2) Editez dans le fichier application/config/config.php le chemin d'installatin

3) Donnez la propriété et/ou les droits de modification à Apache pour le répertoire 'public' et ses
   sous-répertoires. Cela est nécessaire pour que les images soient récupérées et cachées en local. Par
   exemple sous Linux

::

     chown -R www-data:www-data public


*******
travail
*******

Il ne vous reste plus qu'à compléter le fichier application/config/query.sql
Pensez à tester vos requêtes au fur et à mesure en rafraichissant le site.

A partir des requêtes permettant de s'authentifier, il nécessaire d'avoir fini
certains TP pour avancer sur le mini-projet.
