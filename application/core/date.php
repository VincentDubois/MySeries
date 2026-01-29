<?php
function format_date($date, $annee = true){
  //var_dump($date);
  $ymd = explode('-',$date);
  $jour = (int) $ymd[2];
  $mois = explode(' ','Janvier Février Mars Avril Mai Juin Juillet Août Septembre Octobre Novembre Décembre')[(int) $ymd[1]-1];
  return $annee ? "$jour $mois $ymd[0]" : "$jour $mois";
}

function ajout($date,$jours){
  if ($jours==0) return $date;
  $sign = ($jours < 0 ) ? '' : '+';
  return date('Y-m-d', strtotime("$date $sign$jours days"));
}

function jour($date){
  $semaine = explode(' ','Dimanche Lundi Mardi Mercredi Jeudi Vendredi Samedi Dimanche');
  return $semaine[(int) date('N',strtotime($date))];
}

 ?>
