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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

</head>

<body class="bgLogin">

	<section id="banner" style="background-image: url('images/img.jpg'); height:100%;">
	<div><img src="images/logo.png" style="height:60px; width:15%;"></div>
	<div id="background-color" style="background: rgba(0, 0, 0, 0.3); width: 100%; height: 50%; display: flex; justify-content: center; align-items: center;">
			<div id="page_connect" class="page_connect">
				<!-- <p style="background-color: #FFD400; color: #000; width: fit-content; margin-left: auto; margin-right: auto; padding: 0 0.5em 0 0.5em; font-weight: 700;">
					Voyage courtage national
				</p> -->
				<div id="connexion">
					<form action="login.php" method="post" id="connect_form">
						<div class="input-container">
							<span class="icon-envelope"><i class="fa-solid fa-envelope"></i></span>
							<input type="text" name="email" id="email" value="" placeholder="Email" class="12u$" style="margin-bottom:20px; color:#1e2336;">
						</div>
						<div class="input-container">
							<span class="icon"><i class="fa-solid fa-lock" ></i></span>
							<input type="password" name="connect" id="connect" value="" placeholder="Mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;">
						</div>
						<!--
						<div class="12u$">
							<input type="checkbox" class="checkbox" id="checkbox" style="margin-bottom:20px; color:#1e2336;">
							<label for="checkbox" class="checkbox" onclick="affichageMDP()">Afficher le mot de passe</label>
						</div>-->
						<input type="submit" value="Connexion" class="special" style="background: linear-gradient(to right, #F97613,#F97613); color: #ffffff; font-weight: 700;" name="connexion">
					</form>
				</div>
				<p><a href="forget.php" style="color: #ffffff; font-family:system-ui; font-weight:bold;">Mot de passe oublié ?</a></p>
				<?php if ($error != "") {
					echo "<p style='background:#ff0000; color:#000;'>" . $error . "</p>";
				} ?>
			</div>
		</div>
	</section>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

	<script>
		// cette partie là pour le afficher le mot de passe
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