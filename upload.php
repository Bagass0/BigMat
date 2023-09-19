<?php
require_once './class/User.php';
require_once './connect_societe.php';

$usr = new User();


if ($_GET["idColaborateur"] == "") {
    $id = $_SESSION['id'];
} else {
    $id = $_GET["idColaborateur"];
}
if ($_SESSION['event'] !== "ADMIN") {
    if (!empty($_GET['idColaborateur'])) {
        $redirect = 1;
        if ($usr->isPrivi($_SESSION['id']) == false) {
            header("Location: societe.php");
            exit();
        }
        if ($usr->getSocieteId($_SESSION['id'])[0] !== $usr->getSocieteId($_GET['idColaborateur'])[0]) {
            header("Location: societe.php");
            exit();
        }
        $data = $usr->findOneById($_GET['idColaborateur']);
        $data1 = $usr->findOneById($_SESSION['id']);
    } else {
        $data = $usr->findOneById($_SESSION['id']);
    }
} else {
    $data = $usr->findOneById($_GET['idColaborateur']);
    $data1 = $usr->findOneById($_SESSION['id']);
}

$data = $usr->findNomPrenom($id);

$nomOrigine = $_FILES['file']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("jpeg", "jpg", "png", "pdf", "JPEG", "JPG", "PNG", "PDF");
$nomDestination = strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . "." . $extensionFichier);

if (in_array($extensionFichier, $extensionsAutorisees)) {
	$dossierimage = "pdf";
	if (!file_exists($dossierimage)) {
		mkdir($dossierimage, 0777, true);
	}

	$repertoireDestination = dirname(__FILE__) . "/" . $dossierimage . "/";


	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".jpeg"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".jpg"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".png"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".pdf"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".JPEG"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".JPG"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".PNG"));
	unlink(dirname(__FILE__) . "/" . $dossierimage . "/" . strtolower($id . "-" . $data['NOM'] .  "-" . $data['PRENOM']  . ".PDF"));


	error_reporting(E_ALL & ~E_DEPRECATED);
	ini_set("display_errors", 0);
	$statut = 0;
	$reponse = "";

	if (0 < $_FILES['file']['error']) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		$reponse = "error";
	
	} else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $repertoireDestination . $nomDestination)) {
			$usr->updateIdentite($id, $nomDestination);
				$reponse = "ok";
		}
	}
}else {
	$reponse = "Erreur extension";
}

echo $reponse;