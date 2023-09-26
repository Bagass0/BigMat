<?php

require_once './class/Model.php';

class User extends Model {

    protected $table = "USERS";

	public function checkEmail($email){
		$email = mysqli_real_escape_string($this->mysqli, $email);
		$sql = 'SELECT COUNT(ID) as total FROM USERS WHERE EMAIL="'.$email.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A1, Merci de contacter l\'administrateur.');
		return mysqli_fetch_assoc($req);
	}

	public function updateConnexionById($id){
		$id = intval($id);
		$sql = "UPDATE USERS SET CONNEXION='".date("d-m-Y H:i")."' WHERE ID = '".$id."'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A2, Merci de contacter l\'administrateur.');
	}

    public function selectPassById($id){
		$id = intval($id);
		$sql = 'SELECT PASSWORD FROM USERS WHERE ID = "'.$id.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A3, Merci de contacter l\'administrateur.');
		return mysqli_fetch_row($req);
		//return mysqli_num_rows($req);
	}

	public function updateUsersByNewPass($newpassword, $id){
		$newpassword = mysqli_real_escape_string($this->mysqli, $newpassword);
		$sql = "UPDATE USERS SET PASSWORD= '$newpassword' , FIRST_CO = '1' WHERE id = '$id'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A4, Merci de contacter l\'administrateur.');
	}

	public function updateFirstcoById($id){
		$id = intval($id);
		$sql = "UPDATE USERS SET FIRST_CO = '1' WHERE id ='$id'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A5, Merci de contacter l\'administrateur.');
	}

    public function selectLogUser($mail){
		$mail = mysqli_real_escape_string($this->mysqli, $mail);
		$sql = "SELECT * FROM USERS WHERE EMAIL = '$mail'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A6, Merci de contacter l\'administrateur.');
		return mysqli_fetch_assoc($req);
	}

	public function selectPWD($mail)
	{
		$mail = mysqli_real_escape_string($this->mysqli, $mail);
		$sql = "SELECT PASSWORD FROM USERS WHERE EMAIL = '$mail'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A7, Merci de contacter l\'administrateur.');
		return mysqli_fetch_all($req);
	}    

	/**
	 * @param $id
	 * @return bool
	 */
	public function isPrivi($id){
		$id = intval($id);
		$sql = "SELECT IS_PRIVILEGIE FROM USERS WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A8, Merci de contacter l\'administrateur.');
		return boolval(mysqli_fetch_row($req)[0]);
	}

	public function getSocieteId($id){
		$id = intval($id);
		$sql = "SELECT SOCIETE_ID FROM USERS WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A9, Merci de contacter l\'administrateur.');
		return mysqli_fetch_row($req);
	}

	public function findSociete($id){
		$id = intval($id);
		$sql = "SELECT NOM FROM SOCIETE WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A10, Merci de contacter l\'administrateur.');
		return mysqli_fetch_row($req);
	}

    public function accompagnants($event){
		$event = mysqli_real_escape_string($this->mysqli, $event);
        $sql = "SELECT * FROM USERS WHERE ACCOMPAGNANT = '1' AND DROIT = '0' AND GROUPE = '$event'";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A11, Merci de contacter l\'administrateur.');
        return mysqli_num_rows($req);
    }
	
    public function selectById($id){
		$id = intval($id);
        $sql = 'SELECT * FROM USERS WHERE ID = "'.$id.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A12, Merci de contacter l\'administrateur.');
        return mysqli_fetch_assoc($req);
    }

    public function selectByMail($email){
		$email = mysqli_real_escape_string($this->mysqli, $email);
        $sql = 'SELECT * FROM USERS WHERE EMAIL = "'.$email.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A13, Merci de contacter l\'administrateur.');
        return mysqli_num_rows($req);
    }

    public function insertNewInvite($nom, $prenom, $hash_mdp, $email, $event){
        $sql = 'INSERT INTO USERS (NOM, PRENOM, PASSWORD, EMAIL, GROUPE, DROIT, IS_PRIVILEGIE, IS_VALID, SOCIETE_ID) 
				VALUES ("'.mysqli_real_escape_string($this->mysqli, $nom).'",
				"'.mysqli_real_escape_string($this->mysqli, $prenom).'",
				"'.$hash_mdp.'",
				"'.mysqli_real_escape_string($this->mysqli, $email).'",
				"'.$event.'","0","1","1","194")';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A14, Merci de contacter l\'administrateur.');
    }

	public function selectInfosListe($condition)
	{
		$sql = 'SELECT ID, CIVILITE, NOM, PRENOM, AGENCE, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, PARTICIPATION, TYPE_CHAMBRE, LAST_SAVE, REMARQUES, REMARQUES_ALI, REMARQUES_ACC, REMARQUES_ALI_ACC FROM USERS WHERE DROIT != 1 AND ID >= 100 ' . $condition . ' ORDER BY NOM ASC';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A15, Merci de contacter l\'administrateur.');
		return [mysqli_fetch_all($req), mysqli_num_rows($req)];
	}

	public function rechercheListe($nomcherche, $condition)
	{
		$nomcherche = mysqli_real_escape_string($this->mysqli, $nomcherche);
		$sql = "SELECT ID, CIVILITE, NOM, PRENOM, AGENCE, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, PARTICIPATION, TYPE_CHAMBRE, LAST_SAVE, REMARQUES, REMARQUES_ALI, REMARQUES_ACC, REMARQUES_ALI_ACC FROM USERS WHERE DROIT != 1 AND ID >= 100 " . $condition . " AND (NOM LIKE CONCAT('%', '$nomcherche', '%') OR PRENOM LIKE CONCAT('%', '$nomcherche', '%')) ORDER BY NOM ASC";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A16, Merci de contacter l\'administrateur.');
		return [mysqli_fetch_all($req), mysqli_num_rows($req)];
	}

    
	public function updateUserById3($id, $validation, $civilite, $nom, $prenom, $agence, $mail, $tel, $dateNaiss, $lieuNaiss, $nationalite, $numPassport, $dateEmission, $lieuEmission, $dateExpiration, $typeChambre,$remarquesAli, $civiliteAcc, $nomAcc, $prenomAcc, $mailAcc, $telAcc, $dateNaissAcc, $lieuNaissAcc, $nationaliteAcc, $numPassportAcc, $dateEmissionAcc, $lieuEmissionAcc, $dateExpirationAcc, $remarquesAcc, $remarquesAliAcc, $accompagnement, $conditions, $conditionsAcc,$remarquesRegime, $remarques, $participeEve,$participeDej, $confirmeReservation, $régimeAlimentaire,$modalitésdinscription)
	{
		$id = intval($id);
		$validation = mysqli_real_escape_string($this->mysqli, $validation);
		$civilite = mysqli_real_escape_string($this->mysqli, $civilite);
		$nom = mysqli_real_escape_string($this->mysqli, $nom);
		$prenom = mysqli_real_escape_string($this->mysqli, $prenom);
		$agence = mysqli_real_escape_string($this->mysqli, $agence);
		$mail = mysqli_real_escape_string($this->mysqli, $mail);
		$tel = mysqli_real_escape_string($this->mysqli, $tel);
		$dateNaiss = mysqli_real_escape_string($this->mysqli, $dateNaiss);
		$lieuNaiss = mysqli_real_escape_string($this->mysqli, $lieuNaiss);
		$nationalite = mysqli_real_escape_string($this->mysqli, $nationalite);
		$numPassport = mysqli_real_escape_string($this->mysqli, $numPassport);
		$dateEmission = mysqli_real_escape_string($this->mysqli, $dateEmission);
		$lieuEmission = mysqli_real_escape_string($this->mysqli, $lieuEmission);
		$dateExpiration = mysqli_real_escape_string($this->mysqli, $dateExpiration);
		$typeChambre = mysqli_real_escape_string($this->mysqli, $typeChambre);
		$remarquesAli = mysqli_real_escape_string($this->mysqli, $remarquesAli);
		$civiliteAcc = mysqli_real_escape_string($this->mysqli, $civiliteAcc);
		$nomAcc = mysqli_real_escape_string($this->mysqli, $nomAcc);
		$prenomAcc = mysqli_real_escape_string($this->mysqli, $prenomAcc);
		$mailAcc = mysqli_real_escape_string($this->mysqli, $mailAcc);
		$telAcc = mysqli_real_escape_string($this->mysqli, $telAcc);
		$dateNaissAcc = mysqli_real_escape_string($this->mysqli, $dateNaissAcc);
		$lieuNaissAcc = mysqli_real_escape_string($this->mysqli, $lieuNaissAcc);
		$nationaliteAcc = mysqli_real_escape_string($this->mysqli, $nationaliteAcc);
		$numPassportAcc = mysqli_real_escape_string($this->mysqli, $numPassportAcc);
		$dateEmissionAcc = mysqli_real_escape_string($this->mysqli, $dateEmissionAcc);
		$lieuEmissionAcc = mysqli_real_escape_string($this->mysqli, $lieuEmissionAcc);
		$dateExpirationAcc = mysqli_real_escape_string($this->mysqli, $dateExpirationAcc);
		$remarquesAcc = mysqli_real_escape_string($this->mysqli, $remarquesAcc);
		$remarquesAliAcc = mysqli_real_escape_string($this->mysqli, $remarquesAliAcc);
		$accompagnement = mysqli_real_escape_string($this->mysqli, $accompagnement);
		$conditions = mysqli_real_escape_string($this->mysqli, $conditions);
		$conditionsAcc = mysqli_real_escape_string($this->mysqli, $conditionsAcc);
		$remarquesRegime = mysqli_real_escape_string($this->mysqli, $remarquesRegime);
		$remarques = mysqli_real_escape_string($this->mysqli, $remarques);
		$participeEve= mysqli_real_escape_string($this->mysqli,$participeEve);
		$participeDej = mysqli_real_escape_string($this->mysqli,$participeDej);
		$confirmeReservation= mysqli_real_escape_string($this->mysqli, $confirmeReservation);
		$régimeAlimentaire = mysqli_real_escape_string($this->mysqli,$régimeAlimentaire);
		$modalitésdinscription = mysqli_real_escape_string($this->mysqli,$modalitésdinscription);

		$sql = "UPDATE `USERS` SET 
					PARTICIPATION = '$validation',
                    CIVILITE = '$civilite',
				    NOM = '$nom',
				    PRENOM = '$prenom',
				    AGENCE = '$agence',
				    EMAIL = '$mail',
				    TEL = '$tel',
				    DATE_NAISS = '$dateNaiss',
				    LIEU_NAISS = '$lieuNaiss',
				    NATIONALITE = '$nationalite',
				    NUM_PASSPORT = '$numPassport',
				    DATE_EMISSION = '$dateEmission',
				    LIEU_EMISSION = '$lieuEmission',
				    DATE_EXPIRATION = '$dateExpiration',
				    TYPE_CHAMBRE = '$typeChambre',
				    REMARQUES = '$remarques',
				    REMARQUES_ALI = '$remarquesAli',
				    CIVILITE_ACC = '$civiliteAcc',
				    NOM_ACC = '$nomAcc',
				    PRENOM_ACC = '$prenomAcc',
				    MAIL_ACC = '$mailAcc',
				    TEL_ACC = '$telAcc',
				    DATE_NAISS_ACC = '$dateNaissAcc',
				    LIEU_NAISS_ACC = '$lieuNaissAcc',
				    NATIONALITE_ACC = '$nationaliteAcc',
				    NUM_PASSPORT_ACC = '$numPassportAcc',
				    DATE_EMISSION_ACC = '$dateEmissionAcc',
				    LIEU_EMISSION_ACC = '$lieuEmissionAcc',
				    DATE_EXPIRATION_ACC = '$dateExpirationAcc',
				    REMARQUES_ACC = '$remarquesAcc',
				    REMARQUES_ALI_ACC = '$remarquesAliAcc',
					ACCOMPAGNEMENT = '$accompagnement',
                    CONDITIONS = '$conditions',
                    CONDITIONS_ACC = '$conditionsAcc',
					REMARQUESREGIME = '$remarquesRegime',
				    REMARQUES = '$remarques',
					PARTICIPEEVE = '$participeEve',
					PARTICIPEDEJ = '$participeDej',
					CONFIRMERESERVATION = '$confirmeReservation',
					REGIMEALIMENTAIRE = '$régimeAlimentaire',
					MODALITÉSDINSCRIPTION = '$modalitésdinscription',
					LAST_SAVE = CURRENT_TIMESTAMP 
					WHERE ID = $id";


		mysqli_query($this->mysqli, $sql) or die('Erreur 500-A17, Merci de contacter l\'administrateur.');
	}

	public function selectInfosProfil($id)
	{
		$id = intval($id);
		
		$sql = 'SELECT PARTICIPATION, UPLOAD_PHOTO, UPLOAD_PASSPORT, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC FROM USERS WHERE ID = ' . $id . '';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A18, Merci de contacter l\'administrateur.');
		return mysqli_fetch_all($req);
	}

	public function deleteValidation($id)
	{
		$id = intval($id);

		$sql = "UPDATE `USERS` SET PARTICIPATION = 0 WHERE ID = " . $id . "";

		mysqli_query($this->mysqli, $sql) or die('Erreur 500-A19, Merci de contacter l\'administrateur.');
	}

	public function updateIdentite($id, $identite){
        
        $id = intval($id);
        $identite = mysqli_real_escape_string($this->mysqli, $identite);


		$sql = "UPDATE `USERS` SET 
                   	 	UPLOAD_PASSPORT  = '$identite'
				    WHERE ID = '$id'";
        
        
		mysqli_query($this->mysqli, $sql) or die('Erreur 500-A20, Merci de contacter l\'administrateur.');
	}

	public function updateTrombi($id, $pass){
        
        $id = intval($id);
        $pass = mysqli_real_escape_string($this->mysqli, $pass);


		$sql = "UPDATE `USERS` SET 
                   	 	UPLOAD_PHOTO  = '$pass'
				    WHERE ID = '$id'";
        
        
		mysqli_query($this->mysqli, $sql) or die('Erreur 500-A21, Merci de contacter l\'administrateur.');
	}

	public function updateIdentiteAcc($id, $identite)
	{

		$id = intval($id);
		$identite = mysqli_real_escape_string($this->mysqli, $identite);


		$sql = "UPDATE `USERS` SET 
                   	 	UPLOAD_PASSPORT_ACC  = '$identite'
				    WHERE ID = '$id'";


		mysqli_query($this->mysqli, $sql) or die('Erreur 500-A22, Merci de contacter l\'administrateur.');
	}
	public function updateTrombiAcc($id, $pass)
	{

		$id = intval($id);
		$pass = mysqli_real_escape_string($this->mysqli, $pass);

		$sql = "UPDATE `USERS` SET 
                   	 	UPLOAD_PHOTO_ACC  = '$pass'
				    WHERE ID = '$id'";


		mysqli_query($this->mysqli, $sql) or die('Erreur 500-A23, Merci de contacter l\'administrateur.');
	}

	public function selectMailDoublon($id, $mail)
	{
		$id = intval($id);
		$mail = mysqli_real_escape_string($this->mysqli, $mail);

		$sql = 'SELECT ID FROM USERS WHERE EMAIL = "' . $mail . '" AND ID <> ' . $id . '';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur 500-A24, Merci de contacter l\'administrateur.');
		return mysqli_fetch_all($req);
	}
}