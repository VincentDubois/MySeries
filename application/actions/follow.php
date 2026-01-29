<?php
require_once 'application/helpers/queries/User.php';
require_once 'application/helpers/queries/Serie.php';

if(is_logged()){
    follow($follow,$idSerie);
    redirect('serie',compact('idSerie','saison'));
} else {
    redirect('index');
}
