<?php
/************
 * Génère un token aléatoire de longueur donnée, utilisable
 * dans une url.
 * Le risque de générer deux fois le même token est faible, mais pas nul.
 * Une taille de 15 à 20 est recommandée
 *
 */
function generate_token($length){
  $bytes = random_bytes((int) (($length*3)/4+1)); // l'encodage ajoute 1/3 à la taille environ, donc on compense ici
  return substr(strtr(base64_encode($bytes), '+/=', '._-'),0,$length); // Les caractère à éviter dans une url sont remplacés
}
?>
