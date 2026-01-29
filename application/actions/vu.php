<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';

$vu=isset($vu);
if(is_logged()){
    watched($vu,$idEpisode);
    if (isset($saison))
        redirect('serie',compact('idSerie','saison'),$numero);
    else redirect('home');
} else {
    redirect('index');
}
