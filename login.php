<?php

require_once './class/User.php';
require_once './class/Societe.php';
require_once './class/Event.php';
require_once './class/Fonctions.php';

$usr   = new User();
$societe = new Societe();
$evt = new Event();
$fct = new Fonctions();
$error = "";

if ($_GET["event"] == "") {
	$event = 1;
} else {
	$event = $_GET["event"];
}

$dataGeneral = $evt->findOneById($event);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['connexion'])) {
	session_start();
	$mail = $fct->cleanXSS($_POST["email"]);

	$dataPW = $usr->selectPWD($mail);
	$dataPWcheck = $dataPW[0];
	$pdwHash = "$hashAdd$dataPWcheck[0]";
	
	if (password_verify($fct->cleanXSS($_POST["connect"]), $pdwHash)) {
		$data = $usr->selectLogUser($mail);
		date_default_timezone_set('Europe/Paris');
		$event = $data["GROUPE"];
		$id = $data["ID"];
		$droit = $data["DROIT"];
		$first_co = $data["FIRST_CO"];
		$is_valid = $data["IS_VALID"];
		$is_principal = $data["IS_PRIVILEGIE"];

		$_SESSION["event"] = $event;
		$_SESSION["id"] = $id;
		$_SESSION["droit"] = $droit;
		$_SESSION["first_co"] = $first_co;
		$_SESSION["is_valid"] = $is_valid;
		$_SESSION['societe_id'] = $data['SOCIETE_ID'];

		$usr->updateConnexionById($id);

		if ($droit == 1) {
			header("Location: backoffice.php");
		} else {
			if ($is_valid == 1) {

				if ($is_principal == 1) {
					if ($first_co != 1) {
						header("Location: first-login.php");
					} else {
						header("Location: accueil.php");
					}
				} else {
					$soc = $societe->findOneById($data['SOCIETE_ID']);
					if ($soc["VALIDE"] != 1) {
						$error = "Votre société n'a pas validé sa fiche d'inscription";
					} else {
						if ($soc["VALIDE"] == 2) {
							$error = "Votre société a décliné sa participation";
						} else {
							if ($first_co != 1) {
								header("Location: first-login.php");
							} else {
								header("Location: accueil.php");
							}
						}

					}
				}
			} 

			else {
				$error = "Votre compte n'est pas validé. Contactez le webmaster du site!";
			}
		}
	} else {
		$error = "La combinaison identifiant / mot de passe est incorrecte !";
	}
}


?>
<!DOCTYPE HTML>
<html style="height:100%;">

<head>
	<title>Connexion - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main-login.css" />
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

</head>

<body class="bgLogin">

	<section id="banner" style="background-image: url('images/bg_black.jpg'); height:100%;">
		<div id="page_connect" class="boxLogin">
			<!-- <p style="background-color: #FFD400; color: #000; width: fit-content; margin-left: auto; margin-right: auto; padding: 0 0.5em 0 0.5em; font-weight: 700;">
				Voyage courtage national
			</p> -->
			<div id="connexion">
				<form action="login.php" method="post" id="connect_form">
					<input type="text" name="email" id="email" value="" placeholder="Email" class="12u$" style="margin-bottom:20px; color:#1e2336;">
					<input type="password" name="connect" id="connect" value="" placeholder="Mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;">
					<div class="12u$">
						<input type="checkbox" class="checkbox" id="checkbox" style="margin-bottom:20px; color:#1e2336;">
						<label for="checkbox" class="checkbox" onclick="affichageMDP()">Afficher le mot de passe</label>
					</div>
					<input type="submit" value="Connexion" class="special" style="background: linear-gradient(to right, #FFD400, #FFD400); color: #000; font-weight: 700;" name="connexion">
				</form>
			</div>
			<p><a href="forget.php" style="color: #000;">Mot de passe oublié ?</a></p>
			<?php if ($error != "") {
				echo "<p style='background:#ff0000; color:#000;'>" . $error . "</p>";
			} ?>
		</div>
	</section>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

	<script>
		function affichageMDP() {
			var x = document.getElementById("connect");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

</body>

</html>