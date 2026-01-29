<?php

function url_to_path($url,$default = 'portrait'){
  if ($url==NULL) $url='public/img/medium_'.$default.'.png';
  if(preg_match('[https?://static.tvmaze.com/uploads/images/(.+)]i', $url,$result)) {
    $path = $result[1];
    $path = str_replace('/','_',$path);
    return 'public/img/'.$path;
  }
  return $url;
}

function my_copy($url,$file){
// open file descriptor
$fp = fopen ($file, 'w+') or die('Unable to write a file');
// file to download
$ch = curl_init($url);
// enable SSL if needed
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// output to file descriptor
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// set large timeout to allow curl to run for a longer time
curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
curl_setopt($ch, CURLOPT_USERAGENT, 'any');
// Enable debug output
curl_setopt($ch, CURLOPT_VERBOSE, false);
curl_exec($ch);
curl_close($ch);
fclose($fp);

usleep(100);
return file_exists($file);
}

function cache_image($url,$default='portrait'){
  $path = url_to_path($url,$default);
  if ($path == $url) return $url;

  if ($path !== null && $path !== '' &&
    (file_exists($path)||my_copy($url,$path))) return BASE_URL.$path;
  return $url;
}

function cache_src($url,$portrait=true){
  $default = $portrait ? 'portrait' : 'landscape';
  echo 'src="'.cache_image($url,$default).'" ';
}
?>
