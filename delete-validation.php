<?php

include 'connect-backoffice.php';
require_once './class/User.php';

$usr = new User();
$id = $_GET["user"];
$event = $_GET["event"];

if($id != ""){

    $data = $usr->deleteValidation($id);

    header("Location: liste.php?event=".$event);
}
?>