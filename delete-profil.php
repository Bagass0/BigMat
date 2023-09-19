<?php

include 'connect-backoffice.php';
require_once './class/User.php';

$model = new User();
$id = $_GET["user"];

if($id != ""){
    $event = $_GET["event"];
    $table = $_GET["table"];
	$soc = $_GET["soc"];

	if($soc != ""){	$data = $model->deleteFromSoc($soc);}
	else{	$data = $model->deleteFromId($id);;}

    header("Location: liste.php?event=".$event);
}
?>