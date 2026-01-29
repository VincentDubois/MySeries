<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';
require_once 'application/helpers/queries/Personne.php';
require_once 'application/helpers/image_cache.php';

require_query('get_person');

$data = get_logged_user();

$data['personne'] = get_personne($idPersonne);
$data['serie'] = get_series_personne($idPersonne);

echo $blade->run('personne',$data);