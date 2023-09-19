<?php

require_once './class/Sites.php';

class sAccueil extends Sites {

    protected $table = "SITE_ACCUEIL";
    protected $mysqli;

    public function updateTXT ($TXT_ACCUEIL_ST, $TXT_ACCUEIL_T_EDITO, $description, $TITRE_BLOCS, $idEvent) {

        $test = mysqli_real_escape_string($this->mysqli, $TXT_ACCUEIL_ST);
        $test2 = mysqli_real_escape_string($this->mysqli, $TXT_ACCUEIL_T_EDITO);
        $desc = mysqli_real_escape_string($this->mysqli, $description);
        $titre = mysqli_real_escape_string($this->mysqli, $TITRE_BLOCS);
        $sql = 'UPDATE `SITE_ACCUEIL` SET TXT_ACCUEIL_ST = "' .  $test . '",
                                          TXT_ACCUEIL_T_EDITO = "' . $test2 . '",
                                          TXT_ACCUEIL_EDITO = "' . $desc . '",
                                          TITRE_BLOCS = "' . $titre . '"
                                          WHERE `EVENT_ID` =' . $idEvent;
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-G1, Merci de contacter l\'administrateur.');
        return mysqli_fetch_array($req);
    }

    public function setPicAccueil($nomDestination, $idEvent){

        $sql = "UPDATE `SITE_ACCUEIL` SET `PIC_ACCUEIL` = '$nomDestination' WHERE `EVENT_ID` = '$idEvent'";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-G2, Merci de contacter l\'administrateur.');
        return mysqli_fetch_assoc($req);
    }

	public function updateCaroussel($NB_BLOCS, $TITRE, $TITRE_CONTENT, $TXT, $TXT_CONTENT, $event){
        $event = intval($event);
		$sql = "UPDATE `SITE_ACCUEIL` 
				SET NB_BLOCS = " . $NB_BLOCS . ",
				    $TITRE='".mysqli_real_escape_string($this->mysqli, $TITRE_CONTENT)."',
				    $TXT='".mysqli_real_escape_string($this->mysqli, $TXT_CONTENT)."' 
				    WHERE EVENT_ID = ".$event;
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-G3, Merci de contacter l\'administrateur.');
		return mysqli_fetch_assoc($req);

	}
}