<?php
include_once 'konfiguracija.php';
include_once 'spajanjeNaBazu.php';
$izraz = $pdo->prepare("select * from zapis where tko like :uvjet");
if(isset($_POST["uvjet"])){
	$uv="%" . $_POST["uvjet"] . "%";
$izraz->bindParam(':uvjet', $uv);	
}
else {
	$uv="%";
	$izraz->bindParam(':uvjet', $uv);
}
$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
