

### check_user
# Obtient les informations de connection d un utilisateur,
# à partir de son email.
#
# Utilisation
#   permet de tester si un utilisateur existe
#   permet d authentifier un utilisateur existant
#   permet de récupérer la dernière date de connection
#
# Paramètre
#   :email
#
# Retourne les champs suivants :
#   id
#   password
#   lastVisit

SELECT id,password,lastVisit FROM user
  WHERE email = :email;

### register_user
# Ajoute un utilisateur dans la base de données. Il faut configurer
# le mail, le password et la dernière date de connection (lastVisit)
# check_user a déjà été utilisé pour vérifier qu il n y pas d utilisateur avec
# le même email dans la base
#
# Paramètres
#   :email
#   :password
#

INSERT INTO user(email,password,lastVisit)
  VALUES (:email,:password,CURDATE());


### get_all_series
# Obtient les images de toutes les séries.
# On triera les séries par age décroissant, et on retourne toutes les données
#
# Utilisation
#   Les séries retournées sont affichées sur la page d accueil
#
# Paramètre
#   :limit
#

SELECT * FROM serie
ORDER BY premiere DESC
LIMIT :limit;
