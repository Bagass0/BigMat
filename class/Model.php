<?php

require_once './config/Database.php';
require_once './config/Config.php';
require_once './class/Fonctions.php';

$fct = new Fonctions();

class Model {

	protected $table;
	protected $mysqli;


	public function __construct(){
		$this->mysqli = Database::getMysqli();
	}

	public function findOneById($id){
		$id = intval($id);
		$sql = "SELECT * FROM `$this->table` WHERE `ID` = $id";
		$req = mysqli_query($this->mysqli, $sql);
		return mysqli_fetch_assoc($req);
	}

    public function findNomPrenom($id){
		$id = intval($id);
        $sql = "SELECT NOM, PRENOM FROM USERS WHERE ID = $id";
        $req = mysqli_query($this->mysqli, $sql);
        return mysqli_fetch_assoc($req);
    }

	public function allOrderByID(){
		$sql = 'SELECT * FROM ACTIVITES ORDER BY ID DESC';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-E1, Merci de contacter l\'administrateur.');
		return mysqli_fetch_array($req);
	}

	public function deleteFromId($id){
		$id = intval($id);
		$sql = "DELETE FROM $this->table WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-E2, Merci de contacter l\'administrateur.');
	}
// Ajout de Fabrce 16/10 pour le delete de Principal dans liste.php
	public function deleteFromSoc($soc){
		$soc = intval($soc);
		$sql = "DELETE FROM $this->table WHERE SOCIETE_ID = $soc";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-E3, Merci de contacter l\'administrateur.');

		$sql2 = "DELETE FROM SOCIETE WHERE ID = $soc";
		$req2 = mysqli_query($this->mysqli, $sql2) or die('Erreur 500-E4, Merci de contacter l\'administrateur.');
	}


	public function deletePicture($jour, $event){
		$event = intval($event);
		$sql = "UPDATE $this->table SET $jour='' WHERE ID = '" . $event . "'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-E5, Merci de contacter l\'administrateur.');
		return mysqli_fetch_array($req);
	}

	public function deleteItem($table, $item){
		$item = intval($item);
		$sql = "DELETE FROM $table WHERE ID = $item";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-E6, Merci de contacter l\'administrateur.');
		return mysqli_fetch_array($req);
	}

	public function selectItem($table, $item){
		$item = intval($item);
		$sql = "SELECT * FROM  $table WHERE ID = $item";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-E7, Merci de contacter l\'administrateur.');
		return mysqli_fetch_array($req);
	}
}