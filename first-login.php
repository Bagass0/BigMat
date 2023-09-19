<?php
session_start();
require_once './class/User.php';
require_once './class/Model.php';
require_once './class/Fonctions.php';
require_once './class/Event.php';

$evt = new Event();
$fct = new Fonctions();

if ($_GET["event"] == "") {
	$event = 1;
} else {
	$event = $_GET["event"];
}

$usr   = new User();
$error = "";

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['confirm'])) {
	session_start();

	$newpassword = password_hash($_POST['npwd'], PASSWORD_ARGON2ID, ['memory_cost' => $memory, 'time_cost' => $timeCost, 'threads' => $threads]);
	$newpasswordHash = str_replace($hashAdd, "", $newpassword);

	$id = $_SESSION["id"];
	$oldpass = $usr->selectPassById($id);

	if (password_verify($_POST['cpwd'], $newpassword)) {

		$longueurmdp = iconv_strlen($_POST['npwd']);
		if ($longueurmdp != 40) {

			if ($newpassword != $oldpass[0]) {
				$data1 = $usr->updateUsersByNewPass($newpasswordHash, $id);
				$data2 = $usr->updateFirstcoById($id);
				$data = $usr->findOneById($id);
				$civ = ($data['CIVILITE'] == "Mr" ? 'Cher Monsieur' : 'Chère Madame');

				$email = $data['EMAIL'];
				$objet = 'Voyage courtage national : Modification de votre mot de passe';
				$titre = "Voyage courtage national : Modification de votre mot de passe";
				$texte = '<strong>' . $civ . ' ' . $data['NOM'] . ',</strong><br><br>';
				$texte .= 'Votre mot de passe a bien été modifié.<br><br>';
				$texte .= 'Si vous n\'êtes pas à l\'origine de cette modification ou que vous rencontrez des difficultés à vous connecter, contactez-nous par mail : courtage@voyages-abeille-assurances.frr<br><br>Bien cordialement,<br><br>L\'équipe Organisation.<br>';

				include('class/Email.php');

				header("Location: accueil.php");
			} else {
				$error = "Le mot de passe doit être différent de l'ancien. ";
			}
		} else {
			$error = "Le mot de passe est trop petit. ";
		}
	} else {
		$error = "Les mots de passe ne sont pas identiques. ";
	}
}
?>

<!DOCTYPE HTML>
<html style="height:100%;">

<head>
	<title>Changer le mot de passe - <?php echo $dataGeneral['NOM']; ?></title>
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
			<p style="background-color: #FFD400; color: #000; width: fit-content; margin-left: auto; margin-right: auto; padding: 0 0.5em 0 0.5em; font-weight: 700;">
				Voyage courtage national
			</p>
			<h1 style="color: white;text-shadow: 0 0 10px black;">Changer le mot de passe</h1>
			<p style="color: #000; width: fit-content; margin: 0 3em 0 3em; padding: 0 0.5em 0 0.5em; font-weight: 500; font-size: 9pt; text-align: justify;">
				Ce dernier doit avoir 8 caractères de longueur minimum ainsi que comporter au moins une minuscule, une majuscule, un chiffre et un caractère spécial.
			</p>
			<br>
			<div id="confirm">
				<form action="first-login.php" method="post" id="connect_form">
					<input autocomplete="off" type="password" name="npwd" id="npwd" value="" placeholder="Nouveau mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$">
					<input autocomplete="off" type="password" name="cpwd" id="cpwd" value="" placeholder="Retaper mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$">
					<div class="12u$">
						<input type="checkbox" class="checkbox" id="checkbox" style="margin-bottom:20px; color:#1e2336;">
						<label for="checkbox" class="checkbox" onclick="affichageMDP()">Afficher le mot de passe</label>
					</div>
					<input type="submit" value="Confirmer" class="special" style="background: linear-gradient(to right, #FFD400, #FFD400); color: #000; font-weight: 700;" name="confirm">
				</form>
			</div>

			<?php if ($error != "") {
				echo "<p style='background:#FFD400; color:#000;'>" . $error . "</p>";
			} ?>
		</div>
	</section>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

	<script>
		function affichageMDP() {
			var x = document.getElementById("npwd");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
			var x = document.getElementById("cpwd");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

	<script>
		var input = document.getElementById('npwd');

		input.oninvalid = function(event) {
			event.target.setCustomValidity('Veuillez modifier le mot de passe pour correspondre au format requis (minuscule, majuscule, chiffre, caratère spécial)');
		}
		input.oninput = function(event) {
			event.target.setCustomValidity('');
		}
	</script>

	<script>
		var input = document.getElementById('cpwd');

		input.oninvalid = function(event) {
			event.target.setCustomValidity('Veuillez modifier le mot de passe pour correspondre au format requis (minuscule, majuscule, chiffre, caratère spécial)');
		}
		input.oninput = function(event) {
			event.target.setCustomValidity('');
		}
	</script>

</body>

</html>