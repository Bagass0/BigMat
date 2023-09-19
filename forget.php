<?php
require_once './class/User.php';
require_once './class/Event.php';

$evt = new Event();

if ($_GET["event"] == "") {
	$event = 1;
} else {
	$event = $_GET["event"];
}

$dataGeneral = $evt->findOneById($event);

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

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['forget'])) {
	session_start();
	
	$id = $_SESSION["id"];

	require_once 'config/Database.php';
	$db = Database::getMysqli();
	$forget = mysqli_real_escape_string($db, $fct->cleanXSS($_POST["forgetmdp"]));
	$sql = mysqli_query($db, "SELECT ID FROM USERS WHERE EMAIL = '$forget'");

	$sql1 = "UPDATE USERS SET FIRST_CO = '0' WHERE EMAIL ='$forget'";
	$req1 = mysqli_query($db, $sql1) or die('Erreur 500-FO1, Merci de contacter l\'administrateur.');

	$sql2 = "UPDATE USERS SET PASSWORD= '$new_hash_mdp' WHERE EMAIL = '$forget'";
	$req2 = mysqli_query($db, $sql2) or die('Erreur 500-FO2, Merci de contacter l\'administrateur.');


	if (mysqli_num_rows($sql) >= 1) {
		$sql = "SELECT * FROM USERS WHERE email = '" . $forget . "'";
		$req = mysqli_query($db, $sql) or die('Erreur 500-FO3, Merci de contacter l\'administrateur.');
		while ($data = mysqli_fetch_assoc($req)) {
			$civ = ($data['CIVILITE'] == "Mr" ? 'Cher Monsieur' : 'Chère Madame');
			$password = $data["PASSWORD"];
			$nom = $data["NOM"];
			$prenom = $data["PRENOM"];
			$email = $data["EMAIL"];

			$email = $data["EMAIL"];
			$objet = 'Voyage courtage national : Réinitialisation de votre mot de passe';
			$titre = "Voyage courtage national : Réinitialisation de votre mot de passe'";
			$texte .= '<strong>' . $civ . ' ' . $nom . ',</strong><br><br>Vous avez demandé à réinitialiser votre mot de passe.<br>Voici un nouveau mot de passe : <strong style="color:#4CA79F;">' . $mdp . '</strong><br><br>';
			$texte .= 'Vous pouvez vous connecter dès à présent afin de valider votre inscription et découvrir le&nbsp;programme&nbsp; <br><br><div style="width: 100%; display: flex; align-items: center; justify-content: center;"><a href="https://voyages-abeille-assurances.fr/" style=""><button class="" style="color: #000; background-color: #FFD400;">Je me connecte</button></a></div><br><br>Si vous rencontrez des difficultés à vous connecter, n\'hésitez pas à nous contacter par mail : courtage@voyages-abeille-assurances.fr<br>';
			$texte .= '<br>Bien cordialement,<br><br>L\'équipe Organisation.<br>';

			include('class/Email.php');
			$color = "#FFD400";
			$error = "Votre mot de passe vient d'être envoyé sur votre e-mail.";
		}
		mysqli_free_result($req);
	} else {
		$color = "#ff0000";
		$error = "Votre e-mail n'est pas enregistré dans la base de données.";
	}
	
	mysqli_close($db);
}
?>
<!DOCTYPE HTML>
<html style="height:100%;">

<head>
	<title>Mot de passe oublié ? - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main-login.css" />
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

</head>

<body class="bgLogin">

	<section id="banner" style="background-image: url('images/bg_black.jpg'); height:100%;">
		<div id="page_connect" class="boxLogin">
			<!-- <p style="background-color: #FFD400; color: #000; width: fit-content; margin-left: auto; margin-right: auto; padding: 0 0.5em 0 0.5em; font-weight: 700;">
				Voyage courtage national
			</p> -->
			<h1 style="color: #000;">Mot de passe oublié ?</h1>
			<div id="connexion">
				<form action="forget.php" method="post" id="forget_form">
					<input type="text" name="forgetmdp" id="forgetmdp" value="" placeholder="Votre e-mail" class="12u$" style="margin-bottom:20px; color:#1e2336;">
					<input type="submit" value="Renvoyer mon mot de passe" class="special" name="forget" style="background: linear-gradient(to right, #FFD400, #FFD400); color: #000; font-weight: 700;">
				</form>
			</div>
			<p><a href="login.php" style="color: #000;">Retourner sur la page de connexion</a></p>
			<?php if ($error != "") {
				echo "<p style='background:" . $color . "; color:#000;'>" . $error . "</p>";
			} ?>
		</div>
	</section>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>