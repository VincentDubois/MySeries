<?php
include "include.php";

# MySQL with PDO_MYSQ
$sql = $argv[1];
//echo $query;
$query=$pdo->prepare($sql);
$query->execute();
while($line = $query->fetch(PDO::FETCH_ASSOC)) {
  echo implode(",",$line)."\n";
}
?>
