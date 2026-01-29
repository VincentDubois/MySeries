<?php
require_once 'application/core/routing.php';

// Configuration des routes, c'est à dire l'association entre les pages demandées
// et le code php à exécuter

// Le premier paramètre indique le fichier php à exécuter. Par exemple,
// index correspond à pages/index.php

// Les paramètres suivants indiquent les éventuels valeurs attendues et si il s'agit de GET ou POST
// Le fichier php correspondant n'est lancé que si tous les paramètres
// existent. Les paramètres validés sont automatiquement convertis
// en variables php de même nom
// Seule l'existence des paramètres est testée, pas leur valeur (c'est donc à vous de le faire)

add_page('index');

add_page('serie', ['idSerie' => GET, 'saison?' => GET]);
add_page('category', ['nom?' => GET] );
add_page('personne', ['idPersonne' => GET] );
//add_page('search', ['query' => GET]);

add_action('login', ['email' => POST, 'password' => POST]);
add_page('home');
add_action('logout');

add_action('follow', ['idSerie' => GET, 'saison' => GET, 'follow' => POST]);
add_action('vu', ['idSerie?' => GET, 'saison?' => GET, 'numero?' => GET, 'idEpisode' => GET,  'vu?' => POST]);

?>
