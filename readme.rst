############
Présentation
############

Ce projet fait partie du cours de base de données du DUT MMI de l'IUT de Lens.
Il s'agit d'un site permettant de naviguer dans une base de données sur les
séries.
Les données sont obtenues par l'API de TVMaze
(https://www.tvmaze.com/api). Le site a été développé en utlisant le framework
CodeIgniter et Spectre CSS.
Tout est complet et fonctionnel, à l'exception du fichier
application/config/query.sql supposé contenir toutes les requêtes SQL du site,
et qui contient à la place un descriptif des requêtes attendues et laissée en
exercice. Le but est évidemment de trouver et écrire ces requêtes, afin
de rendre le site pleinement opérationnel.


**********
Pré-requis
**********

Le projet nécessite une version suffisament récente de PHP, ainsi que
l'installation de quelques bibliothèques par Composer
(qui doit donc être installé aussi). Vous devez disposer d'un accès à une base
de données MySQL (déjà créée) qui contiendra les informations initiales sur les
séries (pour remplir la base, vous pouvez importer le fichier tvshows.sql si ce
n'est pas déjà fait, ou une fois le site installé utiliser l'onglet recherche
et ajouter manuellement vos séries en cliquant dessus dans le résultat de
recherche)

En option, node.js peut être utilisé pour
lancer la mise à jour de la base de données auprès de TVMaze. Si node n'est pas
installé, seule cette fonctionnalité sera absente (donc la page de recherche et
le bouton de raffraîchissement des séries seront sans effet).


************
Installation
************

Les fichiers sont récupérés de préférence avec git clone. Ensuite,
à partir du répertoire racine du projet (celui contenant ce fichier d'aide) il
faut installer le projet avec les commandes suivantes::

  composer install
  npm i axios #(optionnel)
  cd application/config
  cp database.php.example database.php

Il faut ensuite adapter le contenu de database.php à votre configuration Mysql.
A l'iut, les informations utiles peuvent être obtenues avec la commande suivante::

  cat ~/.my.cnf


*********
Lancement
*********

Toujours à partir de la racine du projet, on peut utiliser php pour servir le
site::

  php -S 127.0.0.1:8000

Normalement, on peut ensuite l'ouvrir dans un navigateur à cette addresse
( 127.0.0.1:8000 )


*******
travail
*******

Il ne vous reste plus qu'à compléter le fichier application/config/query.sql
Pensez à tester vos requêtes au fur et à mesure.

A partir des requêtes permettant de s'authentifier, il nécessaire d'avoir fini
certains TP pour avancer sur le mini-projet.
