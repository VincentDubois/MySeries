############
Présentation
############

Ce projet fait partie du cours de base de données du BUT MMI de l'IUT de Lens.
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
(qui doit donc être installé aussi).

L'installation de composer est décrite ici : https://getcomposer.org/download/
Il y a deux options :

- Sous windows : installation via un programme à télécharger
- En ligne de commande (toutes machines) : l'installation se fait par des
  commandes en php (copier/coller chaque ligne séparément)

Vous devez disposer d'un accès à une base de données MySQL (déjà créée) qui contiendra les
séries. Pour remplir la base, vous pouvez importer le fichier tvshows.sql si ce
n'est pas déjà fait. On suppose donc dans la suite qu'un LAMP, MAMP ou WAMP est disponible

************
Installation
************

Si les fichiers sont récupérés sous forme d'archive, il faut l'extraire. Ensuite,
à partir du répertoire racine du projet (celui contenant ce fichier d'aide) il
faut installer le projet avec composer::

  composer install
  # ou
  php composer.phar install

Il faut ensuite adapter le contenu de application/config/config.php à votre configuration de
base de données et à l'url du site.

Sur les machines de l'iut, les informations utiles peuvent être obtenues avec la commande suivante::

  cat ~/.my.cnf

Les deux principales options pour faire tourner le site sont la ligne de commande (php -S)
et l'hébergement.

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

1) Vérifier que le répertoire contenant le site est placé dans votre 'documentRoot' ou 'htdocs'
   (ou /var/www/ sous Linux), le déplacer si nécessaire. Par défaut, le site est dans un répertoire
   MySeries.

2) Editez dans le fichier application/config/config.php le chemin d'installatin

3) Donnez la propriété et/ou les droits de modification à Apache pour le répertoire 'public' et ses
   sous-répertoires, ainsi que'au répertoire application/view/cache.
   Cela est nécessaire pour que les images soient récupérées et cachées en local, et pour blade. Par
   exemple sous Linux

::

     chown -R www-data:www-data public applocation/view/cache

*********************
Ecriture des requêtes
*********************

Toutes les requêtes SQL utilisées pour faire fonctionner le site ont été regroupées dans le fichier
‘application/config/query.sql’. C’est le seul fichier que vous avez besoin de modifier
(en plus du fichier de configuration).

Dans un vrai projet, les requêtes seraient réparties dans le code mais comme le but de ce cours est
de travailler uniquement sur la partie SQL, tout a été mis dans un seul fichier pour faciliter le travail.
Dans ce fichier, les blocs de commentaires précisent ce qui est attendu comme requête. L’endroit où écrire
le code SQL correspondant est précisé en commentaire juste après chaque bloc, ne modifiez que ces lignes là ::

  # Remplacez ces lignes par votre requête. Ne modifiez pas le bloc de
  # commentaires situé au dessus

Pour chaque requête, il y a des informations qui vous sont données sous forme de paramètres. Cela
veut dire que les valeurs réellement utilisées ne sont pas connues à l’avance, mais seront fournies par le
code php au moment d’exécuter la requête. Ces paramètres se notent tous en commençant par ‘:’ .
Leur nom est normalement suffisament explicite quanq au contenu que l’on peut attendre.
Par exemple, pour la première requête on peut commencer par le code suivant, fourni en commentaire ::

  SELECT * FROM serie LIMIT :limit;

Dans une telle requête, :limit sera remplacé par un nombre avant l’exécution. Cette requête n’est pas
exactement celle attendue pour la version finale, mais elle permet d’obtenir un résultat en attendant
d’avoir vu les outils nécessaires (on reviendra alors corriger cette requête)

Les informations attendues dans le résultat de chaque requête sont précisées dans le bloc de commentaires.
Il s’agit généralement des champs d’une table (éventuellement tous) ou du résultat d’un calcul. Quand un
alias particulier est attendu (souvent pour les calculs), il est aussi précisé à cet endroit.

Normalement, vous pouvez déjà compléter et tester certaines des requêtes situées avant la partie
‘Gestion des utilisateurs’. Au fur et a mesure que les notions sont présentées dans les TP, de nouvelles
requêtes seront possibles à écrire. Contrairement aux questions des TP pour lesquelles les concepts à mettre
en oeuvre sont évident, il faudra ici déterminer vous-mêmes quels outils utiliser, et même parfois si vos outils
actuels sont suffisants pour répondre à la question. En cas de doutes, demandez à votre enseignant.

Pour les questions un peu difficiles, essayez vos requêtes sous mysql ou phpMyAdmin
(en n’oubliant de mettre de vraies valeurs et pas des :champ) avant de les mettre dans le site.

=====
Tests
=====


Il est probable qu’un certain nombre d’erreurs se glissent dans vos requêtes, il est donc important de bien
tout tester au fur et à mesure, en utilisant chaque fonctionnalité du site dès que celle-ci est codée.

Les messages d’erreurs vous indiquent normalement ce qui s’est (mal) passé. Voici les principaux cas :

1) Erreurs SQL : dans ce cas, vous avez accès dans le message d’erreur à la requête avec ses paramètres
   remplacés par les valeurs correspondantes, et l’erreur retournée par MySQL.
2) Erreurs dans le nom d’un paramètre : le message vous précise normalement lequel
3) Accès à une page reposant sur une requête qui n’a pas encore été écrite :
   normalement, c’est précisé dans le message
4) Autres erreurs : il s’agit généralement d’une erreur dans les champs retournés
   (absents, ou mal nommés)

Rappel : tout ce que vous avez à éditer est dans le fichier ‘query.sql’, vous n’avez rien d’autre à modifier
(et surtout pas le code php. Par contre il utilise le même framework que ce qui sera vu en php et en SAE,
et vous pouvez très bien le consulter. En particulier, le répertoire ‘application/views’ devrait être assez
compréhensible. C’est dans ces fichiers que les données retournées par les requêtes sont utillisées pour
produire le code html)

Attention, pour écrire certaines requêtes, il faudra avancer dans les autres feuilles de TP.
