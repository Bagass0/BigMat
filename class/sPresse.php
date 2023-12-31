<?php

require_once 'Sites.php';

class sPresse extends Sites{
	protected $mysqli;
	protected $table = "SITE_PRESSE";

	public function updateTXT($TXT_ACTUALITE, $event){
		$txt = addslashes($TXT_ACTUALITE);
		$sql = "UPDATE `SITE_PRESSE` SET `TXT_PRESSE` = '$txt' WHERE `EVENT_ID` = '$event'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-N1, Merci de contacter l\'administrateur.');
	}

	public function setPicPresse($nomDestination, $idEvent){

		$sql = "UPDATE `SITE_PRESSE` SET `PIC_PRESSE` = '$nomDestination' WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-N2, Merci de contacter l\'administrateur.');
		return mysqli_fetch_assoc($req);
	}

	public function setFileBloc($i, $nomDestination, $idEvent){
		$sql = "UPDATE `SITE_PRESSE` SET `PIC_" . $i . "` = '$nomDestination' WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-N3, Merci de contacter l\'administrateur.');
	}

	public function setTxtBloc($i, $titre, $NB_BLOC, $idEvent){
		$titre = mysqli_real_escape_string($this->mysqli, $titre);
		$sql = "UPDATE `SITE_PRESSE` 
				SET `TITRE_" . $i . "` = '$titre',
				    `NB_PRESSE` = $NB_BLOC
				WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-N4, Merci de contacter l\'administrateur.');
	}
}