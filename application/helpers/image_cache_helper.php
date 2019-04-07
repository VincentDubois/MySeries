<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper(['url','html']);

function url_to_path($url){
  if(preg_match('[http://static.tvmaze.com/uploads/images/(.+)]i', $url,$result)) {
    $path = $result[1];
    $path = str_replace('/','_',$path);
    return 'public/img/'.$path;
  }
  return $url;
}

function cache_image($url){
  $path = url_to_path($url);
  if ($path == $url) return $url;

  if ($path !== null && $path !== "" &&
    (file_exists(FCPATH.$path)||copy($url,FCPATH.$path))) return base_url($path);
  return $url;
}

function cache_src($url){
  echo 'src="'.cache_image($url).'" ';
}


?>
