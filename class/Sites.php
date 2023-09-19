<?php

require_once './config/Database.php';

class Sites {

    protected $mysqli;
    protected $table;

    public function __construct() {;
        $this->mysqli = Database::getMysqli();
    }

    public function findAllById($event){
        $event = intval($event);
        $sql = "SELECT * FROM `$this->table` WHERE `EVENT_ID` = $event";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-L1, Merci de contacter l\'administrateur.');
        return mysqli_fetch_assoc($req);
    }

	public function deletePicture($jour, $event){
        $event = intval($event);
		$sql = "UPDATE $this->table SET $jour ='' WHERE EVENT_ID = '$event'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-L2, Merci de contacter l\'administrateur.');
	}
	public function findNomById($event){
        $event = intval($event);
		$sql = "SELECT `NOM` FROM EVENTS WHERE `ID` = '$event'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-L2, Merci de contacter l\'administrateur.');
		return mysqli_fetch_assoc($req);
	}
}