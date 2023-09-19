<?php

include 'connect-backoffice.php';
require_once './config/Database.php';
require_once './config/Config.php';

$db = Database::getMysqli();

$error = "";
$alphabetMin = 'abcdefghijklmnopqrstuvwxyz';
$alphabetMaj = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$number = '1234567890';
$special = '!@#$%&*_=+-';

$pass = array();

$alphaLength = strlen($alphabetMin) - 1;
for ($i = 0; $i < 4; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabetMin[$n];
}
$alphaLength = strlen($alphabetMaj) - 1;
for ($i = 0; $i < 4; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabetMaj[$n];
}
$alphaLength = strlen($number) - 1;
for ($i = 0; $i < 2; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $number[$n];
}
$alphaLength = strlen($special) - 1;
for ($i = 0; $i < 1; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $special[$n];
}

shuffle($pass);
$mdp = implode($pass);
$hash_mdp = password_hash($mdp, PASSWORD_ARGON2ID, ['memory_cost' => $memory, 'time_cost' => $timeCost, 'threads' => $threads]);
$new_hash_mdp = str_replace($hashAdd, "", $hash_mdp);

$id = $_GET["user"];

$sql2 = "UPDATE USERS SET PASSWORD= '$new_hash_mdp', FIRST_CO = 0 WHERE ID = '$id'";
$req2 = mysqli_query($db, $sql2) or die('Erreur 500-ER1, Merci de contacter l\'administrateur.');

$sql = "SELECT * FROM USERS WHERE ID = '" . $id . "'";
$req = mysqli_query($db, $sql) or die('Erreur 500-ER2, Merci de contacter l\'administrateur.');
while ($data = mysqli_fetch_assoc($req)) {
    $password = $data["PASSWORD"];
    $civ = ($data['CIVILITE'] == "Mr" ? 'Cher Monsieur' : 'Chère Madame');
    $nom = $data["NOM"];
    $prenom = $data["PRENOM"];
    $email = $data["EMAIL"];

    $objet = 'Voyage courtage national : Inscrivez-vous';
    $titre = "Voyage courtage national : Inscrivez-vous";
    $texte .= '<strong>' . $civ . ' ' . $nom . ',</strong><br><br>';
    $texte .= 'La date du départ approche... N\'oubliez pas de valider votre participation au Voyage courtage national d\'Abeille&nbsp;Assurances en Écosse <b><u>avant le 15 mai 2023</u></b> sur votre site dédié.
    <br><br>';
    $texte .= 'Voici votre identifiant et votre mot de passe :<br><br>';
    $texte .= 'Identifiant : <strong style="color:#4CA79F;">Votre adresse email</strong><br>';
    $texte .= 'Mot de passe provisoire à changer à votre première connexion : <strong style="color:#4CA79F;">' . $mdp . '</strong><br><br>';
    $texte .= '<strong>Pour accéder au site : <a href="https://voyages-abeille-assurances.fr" style="">Voyage courtage national</a></strong><br><br>';
    $texte .= 'Si vous rencontrez des difficultés à vous connecter, n\'hésitez pas à nous contacter par mail : courtage@voyages-abeille-assurances.fr<br>';
    $texte .= '<br>Bien cordialement,<br><br>L\'équipe Organisation.<br>';


    include('class/Email.php');

    $error = "L'invitation a été renvoyé, le mot de passe a été régénéré !";

    mysqli_free_result($req);
    mysqli_close($db);
    header("Location: liste.php");
}
