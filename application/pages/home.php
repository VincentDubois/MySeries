<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';
require_once 'application/helpers/image_cache.php';

if (is_logged()){
    $data = get_logged_user();
    $data['serie_list'] = get_followed();

    foreach($data['serie_list'] as &$element){
        $total=$element['total']; 
        $reste=$element['reste'];
        $vu=$total-$reste;
        $progress=(100*$vu)/$total;
        $element['vu'] = $vu;
        $element['progress'] = $progress;
    }
    echo $blade->run('home',$data);
} else {
    redirect_page('index');
}

