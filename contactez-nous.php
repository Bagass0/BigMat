<?php

include 'connect_contact.php';

require_once './class/User.php';
require_once './class/Fonctions.php';

$usr = new User();
$fct = new Fonctions();
$error = "";

$fichierPHP = basename(__FILE__);

if ($_SESSION["id"] != "") {
	$data = $usr->findOneById($_SESSION['id']);
	$societe_infos = $usr->findSociete($_SESSION['societe_id']);
	$data2 = $usr->findOneById($dataGeneral['PAR']);
}


if ($data["FIRST_CO"] == 0) {
	$data = "";
	$societe_infos = "";
}

if ($dataGeneral["OPT_CONTACT"] != 1) {
	header("Location: accueil.php$eventurl");
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])) {

	$name = $fct->cleanXSS($_POST['name']);
	$agence = $fct->cleanXSS($_POST['agence']);
	$mobile = $fct->cleanXSS($_POST['mobile']);
	$emailC = $fct->cleanXSS($_POST['emailC']);
	$category = $fct->cleanXSS($_POST['category']);
	$message = $fct->cleanXSS($_POST['message']);

	if (($name != "") && ($agence != "") && ($mobile != "") && ($emailC != "") && ($category != "") && ($message != "")) {


		if ($dataEvt['MAIL_CONTACT'] != "") {
			$destinataire = $dataEvt['MAIL_CONTACT'];
		} else {
			$destinataire = $data2['EMAIL'];
		}

		$objet    = "Voyage courtage national : Contact (" . $category . ")";

		$email = $destinataire;
		$objet = $objet;
		$titre = $objet;
		$texte = '<strong>Un nouveau message depuis le formulaire de contact a été envoyé :</strong><br><br>';
		$texte .= '<strong>Nom : </strong>' . $name . '<br><strong>Agence Aviva : </strong>' . $agence . '<br><strong>Mobile : </strong>' . $mobile . '<br><strong>E-mail : </strong>' . $emailC . '<br><br>';
		$texte .= '<strong>Sujet : </strong>' . $category . '<br><br>' . $message . '<strong>';

		include('class/Email.php');

		$error = "Votre message a bien été envoyé, vous recevrez une réponse prochainement.";
		$color = "#093";

		$category = "";
		$message = "";
	} else {

		$error = "Attention, merci de remplir tous les champs.";
		$color = "#FF0000";

		if ($name == "") {
			echo '<style>input[name="name"] {border-color: #FF0000 !important;}</style>';
		}
		if ($societe == "") {
			echo '<style>input[name="societe"] {border-color: #FF0000 !important;}</style>';
		}
		if ($mobile == "") {
			echo '<style>input[name="mobile"] {border-color: #FF0000 !important;}</style>';
		}
		if ($emailC == "") {
			echo '<style>input[name="emailC"] {border-color: #FF0000 !important;}</style>';
		}
		if ($category == "") {
			echo '<style>input[name="category"] {border-color: #FF0000 !important;}</style>';
		}
		if ($message == "") {
			echo '<style>textarea[name="message"] {border-color: #FF0000 !important;}</style>';
		}
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Contact - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
</head>

<body class="body_flex">

	<?php include 'header.php' ?>
	<section id="Page_contact" class="wrapper align-left">
		<div id="Form_contact" style="max-width: 90%;">
			<h1>Contact</h1>
			<?php if ($error != "") { ?>
				<div class="box" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
					<p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
				</div>
			<?php
				unset($error);
			} ?>
			<div>
			</div>
			<form method="post">
				<div class="row uniform">
					<div class="6u 12u$(xsmall)">

						<input type="text" name="name" class="inputContact" id="name" value="<?php if (isset($name)) {
																									echo $name;
																								} else {
																									if (($data['NOM'] == "") || ($data['PRENOM'] == "")) {
																									} else {
																										echo $data['PRENOM'] . " " . $data['NOM'];
																									}
																								} ?>" placeholder="Nom">
					</div>
					<div class="6u$ 12u$(xsmall)">
						<input type="text" name="agence" class="inputContact" id="agence" value="<?php if (isset($agence)) {
																										echo $agence;
																									} else {
																										echo $data['AGENCE'];
																									} ?>" placeholder="Votre Cabinet de Courtage">
					</div>
					<div class="6u 12u$(xsmall)">
						<input type="text" name="mobile" class="inputContact" id="mobile" value="<?php if (isset($mobile)) {
																										echo $mobile;
																									} else {
																										echo $data['TEL'];
																									} ?>" placeholder="Téléphone">
					</div>
					<div class="6u$ 12u$(xsmall)">
						<input type="email" name="emailC" class="inputContact" id="emailC" value="<?php if (isset($mail)) {
																									echo $mail;
																								} else {
																									echo $data['EMAIL'];
																								} ?>" placeholder="E-mail">
					</div>
					
					<div class="12u$ 12u$(xsmall)">
						<input type="text" name="category" class="inputContact" id="category" value="<?php if (isset($category)) {
																											echo $category;
																										} ?>" placeholder="Sujet">
					</div>
					
					<div class="12u$">
						<textarea style="resize: none;" name="message" id="message" class="inputContact" placeholder="Votre message" rows="6"><?php if (isset($message)) {
																																					echo $message;
																																				} ?></textarea>
					</div>
					
					<div class="12u$">
						<ul id="ContainerSubmit">
							<input type="submit" id="BoutonEnvoyer" value="Envoyer" name="valider">
						</ul>
					</div>
				</div>
			</form>
																																	
		</div>																																	
	</section>

	<div style="font-size: 16px;"><?php include 'footer.php'; ?></div>


</body>

</html>