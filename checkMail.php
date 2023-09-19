<?php
require_once './class/User.php';

$usr = new User();

$dataDBUser = $usr->findOneById($id);

$checkInfoModif = FALSE;

$civ = ($fct->cleanXSS($_POST['civilite']) == "Mr" ? 'Cher Monsieur' : 'Chère Madame');

$dateVoyage = ($data['GROUPE_VOYAGE'] == 1 ? "du mardi 13 au vendredi 16 juin 2023" : "du mercredi 14 au samedi 17 juin 2023");

$objet = 'Voyage courtage national : Confirmation de votre inscription';
$titre = "Voyage courtage national : Confirmation de votre inscription";

$email = $fct->cleanXSS($_POST['mail']);

$texte = "";
$texte .= "\r\n";
$texte .= '<strong style="color:#000;">' . $civ . ' ' . $fct->cleanXSS($_POST['nom']) . ',</strong><br><br>';

$texte .= 'Nous avons bien pris en compte votre inscription pour le Voyage courtage national d\'<strong style="color:#000;">Abeille&nbsp;Assurances</strong> qui se tiendra <strong style="color:#000;">'. $dateVoyage .'</strong> en <strong style="color:#000;">Écosse</strong>.<br><br>';

$texte .= 'Nous vous communiquerons plus d\'informations concernant votre voyage ultérieurement.<br><br>Si vous rencontrez des difficultés à vous connecter, n\'hésitez pas à nous contacter par mail : courtage@voyages-abeille-assurances.fr<br>';

$texte .= '<br>Bien cordialement,<br><br>L\'équipe Organisation.<br>';


include('class/Email.php');

$form = "ok";