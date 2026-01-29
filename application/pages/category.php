<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';
require_once 'application/helpers/image_cache.php';

$data = get_logged_user();
$data['categories'] = get_all_categories();

if (isset($nom) && $nom != null){
        $data['current_cat'] = $nom;
        $lastVisit =  $data['lastVisit'] ?? date('Y-m-d',strtotime('-7 day'));
        $data['serie_list'] = get_by_genre($nom,$lastVisit);
}

echo $blade->run('gallery',$data);