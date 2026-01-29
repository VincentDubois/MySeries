<?php
require_once 'application/helpers/queries/User.php';

require_query('check_user');

login($email,$password);
if (is_logged() && has('get_followed_series')){
    redirect('home');
} else {
    redirect('index');
}