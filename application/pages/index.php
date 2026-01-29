<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';
require_once 'application/helpers/image_cache.php';

$data = get_logged_user();
$lastVisit =  $data['lastVisit'] ?? date('Y-m-d',strtotime('-7 day'));

$data['serie_list'] = get_all_series(60,$lastVisit);

echo $blade->run('gallery',$data);