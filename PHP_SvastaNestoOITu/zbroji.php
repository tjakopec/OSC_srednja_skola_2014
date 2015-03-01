<?php
if(!isset($_GET["pbroj"]) && !isset($_GET["dbroj"]))
exit;

include_once 'konfiguracija.php';
include_once 'spajanjeNaBazu.php';

$izraz = $pdo->prepare("insert into zapis (tko,odkuda,kada,prvibroj,drugibroj) values " . 
"(:tko,:odkuda,now(),:prvibroj,:drugibroj);");
$izraz->bindParam(':tko', $_GET["tko"]);
$izraz->bindParam(':odkuda', $_SERVER['REMOTE_ADDR']);
$izraz->bindParam(':prvibroj', $_GET["pbroj"]);
$izraz->bindParam(':drugibroj', $_GET["dbroj"]);
$izraz->execute();


$rez=new stdClass();
$rez->pbroj=$_GET["pbroj"];
$rez->dbroj=$_GET["dbroj"];
$rez->rezultat=$rez->pbroj+$rez->dbroj;

echo json_encode($rez);
