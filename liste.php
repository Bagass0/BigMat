<?php

include 'connect-backoffice.php';
require_once './class/Event.php';
require_once './class/User.php';

$event = $_GET['event'];
require_once './config/Database.php';
$db = Database::getMysqli();

$usr = new User();
$errors = [];
$obli = 0;
$error = "";
$alphabetMin = 'abcdefghijklmnopqrstuvwxyz';
$alphabetMaj = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$number = '1234567890';
$special = '!@#$%&*_=+-';

$data1 = $usr->selectByID($_SESSION['id']);
$data = $usr->findOneById($_SESSION['id']);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])) {
	session_start();
	$nom = $fct->cleanXSS($_POST['nom']);
	$prenom = $fct->cleanXSS($_POST['prenom']);
	$email = $fct->cleanXSS($_POST['email']);

	if ($nom != '' && $prenom != '' && $email != '') {

		$data5 = $usr->selectByMail($email);

		if ($data5 != 0) {
			array_push($errors, "Cet e-mail est déjà inscrit !");
			$color = "#FF0000";
			$obli = 1;
			echo "<style>#ajout{display:block;} #add{display:none;}</style>";
			echo '<style>input[name="email"] {border-color: #FF0000 !important;}</style>';
		} else {

			$usr->insertNewInvite($nom, $prenom, '0', $email, $event);

			$email = $fct->cleanXSS($_POST['email']);

			array_push($errors, "Le contact a bien été ajouté !");
			$color = "#093";

			echo "<style>#ajout{display:none;}</style>";

			$nom = "";
			$prenom = "";
			$email = "";
		}
	} else {
		array_push($errors, "Tous les champs n'ont pas été remplis !");
		$color = "#FF0000";
		$valid = "0";
		echo "<style>#ajout{display:block;} #add{display:none;}</style>";

		if ($fct->cleanXSS($_POST['nom'] == "")) {
			echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';
		}
		if ($fct->cleanXSS($_POST['prenom'] == "")) {
			echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';
		}
		if ($fct->cleanXSS($_POST['email'] == "")) {
			echo '<style>input[name="email"] {border-color: #FF0000 !important;}</style>';
		}
	}
} else {
	echo "<style>#ajout{display:none;}</style>";
}


?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Gestion des inscrits - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/onglets.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
		$(function() {
			$("#tabs").tabs({
				collapsible: true
			});
		});
		$(function() {
			$("#tabs-Total").tabs({
				collapsible: true
			});
		});
		$(function() {
			$("#tabs-Groupe-1").tabs({
				collapsible: true
			});
		});
		$(function() {
			$("#tabs-Groupe-2").tabs({
				collapsible: true
			});
		});
	</script>

	<style>
		.fa,
		.fas {
			margin: 15px 10px;
		}

		tr {
			text-align: left;
		}

		.fa-envelope,
		.fa-industry,
		.fa-cog,
		.fa-bookmark,
		.fa-trash {
			margin: 4px 10px !important;
		}


		.mobile_right {
			text-align: right;
			width: 100px;
		}

		.fa-minus {
			color: #ccc;
		}

		.fa-minus,
		.fa-check,
		.fa-times {
			margin: 15px 0 !important;
		}

		b {
			font-weight: 500 !important;
		}
	</style>

</head>

<body>
	
	<header id="header" style="height: fit-content; position: fixed;">
		<div id="nav1" style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.5);" class="bgColorHeader">
			<a href="index.php" class="logo" style="width: auto;"></a>
			<nav id="nav">
				<div class="inner marginTop" style="max-width: 100%;">
					<a style="border-right: none; padding: 0; margin: 0;" href="index.php"><img src="images/logo-header.jpg" style="width: 17em; margin: 1em" class="displayHeader2"></a>
					<?php include 'menu.php'; ?>
					<div class="inner displayHeader" style="display: flex; max-width: 100%; max-width: 100%;">
						<?php include 'menu1.php'; ?>
					</div>
				</div>
			</nav>
		</div>
		<div style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.5);" class="bgColorHeader">
			<div class="inner marginTop" style="display: flex; max-width: 100%;">
				<a class="displayBlockHeader" style="width: auto; display: flex; border-right: none; text-align: left">
					<img src="images/logo-header.jpg" style="width: 17em; margin: 1em; display: none;" class="displayHeader">
					<p style="margin: 0;"><mark style="background-color: #FFD400; color: #000; margin-left: 5.5em;" class="marginHeader">&nbsp;Voyage courtage national&nbsp;</mark></p>
				</a>
				<a href="#navPanel" class="navPanelToggle" style="border-right: none;"><span class="fa fa-bars" style="margin-right: 1em;"></span></a>
			</div>
		</div>
	</header>

	<section id="one" class="wrapper align-center" style="margin-top: 140px;">
		<div class="inner">
			<div class="row uniform">
				<div class="9u 12u$(small)" style="width: 100%">
					<h2 id="content" style="color:#004b96;">Gestion des inscrits</h2>

					<?php if (sizeof($errors) > 0) : ?>
						<div class="box" style="border-color:<?php echo $color; ?>;">
							<p style="color:<?php echo $color; ?>;">
								<?php foreach ($errors as $error) : ?>
									<?= $error ?>
									<br />
								<?php endforeach;
								$errors = []; ?>
							</p>
						</div>
					<?php endif; ?>

					<hr>

					<span class="button special" id="add">Ajouter un invité</span>
						<form method="post" action="liste.php?event=<?php echo $event ?>" id="ajout">

							<div class="row uniform">
								<div class="12u$ 12u$(small) cacheajout">
									<h4 style="width:100%; color:#9a9a9a;">Ajouter un invité</h4>
								</div>
							</div>

							<?php $error = "";
							if (($error != "") && ($valid == "0")) { ?>
								<div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
									<p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
								</div>
							<?php } ?>

							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<select id="civilite" name="civilite">
										<option class="civ1" value="">Civilité</option>
										<option class="civ2" value="M.">M.</option>
										<option class="civ3" value="Mme">Mme</option>
									</select>
								</div>

								<div class="12u$ 12u$(xsmall) cacheajout">
									<input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" placeholder="Nom de l'invité">
								</div>

								<div class="12u$ 12u$(xsmall) cacheajout">
									<input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" placeholder="Prénom de l'invité">
								</div>

								<div class="12u$ 12u$(xsmall) cacheajout">
									<input type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="E-mail de l'invité">
								</div>

								<div class="6u 12u$(small) cacheajout">
									<span class="button special" id="annuler">ANNULER</span>
								</div>

								<div class="6u 12u$(small) cacheajout">
									<input type="submit" value="Valider" class="special" name="valider">
								</div>

							</div>
						</form>

					<div>
						<ul style="border: 0;">

						</ul>
						<div>
							<table>
								<tr>
									<th><a href="zip.php"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter tous les passeports</a></th>
									<th><a href="zip2.php"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter tous les trombinoscope</a></th>
								</tr>
							</table>

						</div>

						<div>
							<table>

								<tr>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;"> &nbsp;

										</h3>
										<p style="text-align:center;"><b><strong style="font-weight: bold">Connexion</strong></b></p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql = 'SELECT ID FROM USERS WHERE DROIT != 1 AND FIRST_CO = 1 AND ID >= 100';
											$req = mysqli_query($db, $sql) or die('Erreur 500-LBO1, Merci de contacter l\'administrateur.');
											$d = mysqli_num_rows($req);
											echo ($d);
											?>
										</h3>
										<p style="text-align:center">Connectés</p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql = 'SELECT ID FROM USERS WHERE DROIT != 1 AND FIRST_CO = 0 AND ID >= 100';
											$req = mysqli_query($db, $sql) or die('Erreur 500-LBO2, Merci de contacter l\'administrateur.');
											$d = mysqli_num_rows($req);
											echo ($d);
											?>
										</h3>
										<p style="text-align:center">Non Connectés</p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql = 'SELECT ID FROM USERS WHERE DROIT != 1 AND ID >= 100';
											$req = mysqli_query($db, $sql) or die('Erreur 500-LBO3, Merci de contacter l\'administrateur.');
											$d = mysqli_num_rows($req);
											echo ($d);
											?>
										</h3>
										<p style="text-align:center">Total</p>
									</td>

								</tr>

								<tr>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;"> &nbsp;

										</h3>
										<p style="text-align:center;"><b><strong style="font-weight: bold">Participation</strong></b></p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql1 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND PARTICIPATION = 1 AND ID >= 100';
											$req1 = mysqli_query($db, $sql1) or die('Erreur 500-LBO4, Merci de contacter l\'administrateur.');
											$d1 = mysqli_num_rows($req1);
											echo ($d1);
											?>
										</h3>
										<p style="text-align:center">Validés</p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql1 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND PARTICIPATION = 0 AND ID >= 100 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "")';
											$req1 = mysqli_query($db, $sql1) or die('Erreur 500-LBO5, Merci de contacter l\'administrateur.');
											$d1 = mysqli_num_rows($req1);
											echo ($d1);
											?>
										</h3>
										<p style="text-align:center">Sauvegardés</p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql1 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND PARTICIPATION = 0 AND ID >= 100 AND (LAST_SAVE IS NULL OR LAST_SAVE = "")';
											$req1 = mysqli_query($db, $sql1) or die('Erreur 500-LBO6, Merci de contacter l\'administrateur.');
											$d1 = mysqli_num_rows($req1);
											echo ($d1);
											?>
										</h3>
										<p style="text-align:center">Sans Réponse</p>
									</td>

								</tr>

								<tr>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;"> &nbsp;

										</h3>
										<p style="text-align:center;"><b><strong style="font-weight: bold">Participants</strong></b></p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql1 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND PARTICIPATION = 1 AND ID >= 100';
											$req1 = mysqli_query($db, $sql1) or die('Erreur 500-LBO7, Merci de contacter l\'administrateur.');
											$d1 = mysqli_num_rows($req1);
											echo ($d1);
											?>
										</h3>
										<p style="text-align:center">Inscrits</p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql1 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND MAIL_ACC IS NOT NULL AND MAIL_ACC != "" AND PARTICIPATION = 1 AND TYPE_CHAMBRE != "Single" AND ID >= 100';
											$req1 = mysqli_query($db, $sql1) or die('Erreur 500-LBO8, Merci de contacter l\'administrateur.');
											$d1 = mysqli_num_rows($req1);
											echo ($d1);
											?>
										</h3>
										<p style="text-align:center">Accompagnants</p>
									</td>

									<td>
										<h3 style="margin-bottom: 0; color:#4CA79F !important; text-align:center;">
											<?php
											$sql1 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND PARTICIPATION = 1 AND ID >= 100';
											$req1 = mysqli_query($db, $sql1) or die('Erreur 500-LBO9, Merci de contacter l\'administrateur.');
											$d1 = mysqli_num_rows($req1);
											$sql2 = 'SELECT ID FROM USERS WHERE DROIT != 1 AND MAIL_ACC IS NOT NULL AND MAIL_ACC != "" AND PARTICIPATION = 1 AND TYPE_CHAMBRE != "Single" AND ID >= 100';
											$req2 = mysqli_query($db, $sql2) or die('Erreur 500-LBO10, Merci de contacter l\'administrateur.');
											$d2 = mysqli_num_rows($req2);
											echo ($d1+$d2);
											?>
										</h3>
										<p style="text-align:center">Total</p>
									</td>

								</tr>

								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th><span class="actions" onclick="listingOnglet()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter toutes données</span></th>
									<th>&nbsp;</th>
								</tr>

							</table>

						</div>

						<div class="row" style="display: inline-block;">

							<form method="post" action="liste.php?event=<?php echo $event ?>" id="recherche" style="width: 100%;">

								<?php $nomcherche = $fct->cleanXSS($_POST['nomcherche']); ?>


								<div class="row">

									<div class="col-sm">
										<h4 style="width:100%; color:#9a9a9a;">Rechercher un invité</h4>
										<input type="text" name="nomcherche" id="nom" value="<?php echo $nomcherche ?>" placeholder="Nom de l'invité">
									</div>

									<div class="col-sm">
										<input type="submit" style="margin-top: 3.2em;" value="Rechercher" class="special" name="Rechercher">
									</div>


									<?php $error = "";
									if ($error != "") { ?>
										<div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
											<p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
										</div>
									<?php } ?>

								</div>

								<br>
								<em style="font-size:8pt; text-align:left;">Recherche par Nom / Prenom</em><br>

							</form>

						</div>
					</div>

					<hr>

					<div id="tabs">
						<ul>
							<li>
								<a href="#tabs-Total" id="tabulationTotal">Total</a>
							</li>
							<li>
								<a href="#tabs-Groupe-1" id="tabulationGroupe1">Groupe 1</a>
							</li>
							<li>
								<a href="#tabs-Groupe-2" id="tabulationGroupe2">Groupe 2</a>
							</li>
						</ul>

						<div id="tabs-Total">
							<ul>
								<li>
									<a href="#tabs-0-1" id="tabulation0-1">Total</a>
								</li>
								<li>
									<a href="#tabs-0-2" id="tabulation0-2">Validé</a>
								</li>
								<li>
									<a href="#tabs-0-3" id="tabulation0-3">Sauvegardé</a>
								</li>
								<li>
									<a href="#tabs-0-4" id="tabulation0-4">Sans Réponse</a>
								</li>
								<li>
									<a href="#tabs-0-5" id="tabulation0-5">Double</a>
								</li>
								<li>
									<a href="#tabs-0-6" id="tabulation0-6">Twin</a>
								</li>
								<li>
									<a href="#tabs-0-7" id="tabulation0-7">Single</a>
								</li>
								<li>
									<a href="#tabs-0-8" id="tabulation0-8">Remarques</a>
								</li>
								<li>
									<a href="#tabs-0-9" id="tabulation0-9">Remarques Alimentaires</a>
								</li>
								<li>
									<a href="#tabs-0-10" id="tabulation0-10">Connectés</a>
								</li>
								<li>
									<a href="#tabs-0-11" id="tabulation0-11">Non Connectés</a>
								</li>
							</ul>

							<div id="tabs-0-1">

								<br>
								<span class="actions" onclick="listingOnglet0_1()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = '';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-2">

								<br>
								<span class="actions" onclick="listingOnglet0_2()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="delete-validation.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm4" style="text-decoration:none;" title="Validation"><i class="fas fa-bookmark"></i></a>';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-3">

								<br>
								<span class="actions" onclick="listingOnglet0_3()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 0 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "")';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-4">

								<br>
								<span class="actions" onclick="listingOnglet0_4()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 0 AND (LAST_SAVE IS NULL OR LAST_SAVE = "")';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-5">

								<br>
								<span class="actions" onclick="listingOnglet0_5()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Double"';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-6">

								<br>
								<span class="actions" onclick="listingOnglet0_6()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Twin"';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-7">
								<br>
								<span class="actions" onclick="listingOnglet0_7()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Single"';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-8">

								<br>
								<span class="actions" onclick="listingOnglet0_8()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND ((REMARQUES != "" AND REMARQUES IS NOT NULL) OR (REMARQUES_ACC != "" AND REMARQUES_ACC IS NOT NULL))';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Partenaire</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Remarques
										echo '<th style="text-align: left;"><b>' . $data[11] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Remarques Partenaire
										echo '<th style="text-align: left;"><b>' . $data[13] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-9">

								<br>
								<span class="actions" onclick="listingOnglet0_9()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND ((REMARQUES_ALI != "" AND REMARQUES_ALI IS NOT NULL) OR (REMARQUES_ALI_ACC != "" AND REMARQUES_ALI_ACC IS NOT NULL))';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Alimentaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Alimentaire Partenaire</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Remarques Alimentaire
										echo '<th style="text-align: left;"><b>' . $data[12] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Remarques Alimentaire Partenaire
										echo '<th style="text-align: left;"><b>' . $data[14] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-10">
								<br>
								<span class="actions" onclick="listingOnglet0_10()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND FIRST_CO = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-0-11">
								<br>
								<span class="actions" onclick="listingOnglet0_11()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND FIRST_CO = 0';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<ul class="actions" style="float:right;">
								<li><a class="button special" href="backoffice.php" style="margin-top: 20px;">RETOUR</a></li>
							</ul>
						</div>

						<div id="tabs-Groupe-1">
							<ul>
								<li>
									<a href="#tabs-1-1" id="tabulation1-1">Total</a>
								</li>
								<li>
									<a href="#tabs-1-2" id="tabulation1-2">Validé</a>
								</li>
								<li>
									<a href="#tabs-1-3" id="tabulation1-3">Sauvegardé</a>
								</li>
								<li>
									<a href="#tabs-1-4" id="tabulation1-4">Sans Réponse</a>
								</li>
								<li>
									<a href="#tabs-1-5" id="tabulation1-5">Double</a>
								</li>
								<li>
									<a href="#tabs-1-6" id="tabulation1-6">Twin</a>
								</li>
								<li>
									<a href="#tabs-1-7" id="tabulation1-7">Single</a>
								</li>
								<li>
									<a href="#tabs-1-8" id="tabulation1-8">Remarques</a>
								</li>
								<li>
									<a href="#tabs-1-9" id="tabulation1-9">Remarques Alimentaires</a>
								</li>
								<li>
									<a href="#tabs-1-10" id="tabulation1-10">Connectés</a>
								</li>
								<li>
									<a href="#tabs-1-11" id="tabulation1-11">Non Connectés</a>
								</li>
							</ul>

							<div id="tabs-1-1">

								<br>
								<span class="actions" onclick="listingOnglet1_1()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-2">

								<br>
								<span class="actions" onclick="listingOnglet1_2()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 1 AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="delete-validation.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm4" style="text-decoration:none;" title="Validation"><i class="fas fa-bookmark"></i></a>';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-3">

								<br>
								<span class="actions" onclick="listingOnglet1_3()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 0 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "") AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-4">

								<br>
								<span class="actions" onclick="listingOnglet1_4()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 0 AND (LAST_SAVE IS NULL OR LAST_SAVE = "") AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-5">

								<br>
								<span class="actions" onclick="listingOnglet1_5()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Double" AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-6">

								<br>
								<span class="actions" onclick="listingOnglet1_6()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Twin" AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-7">
								<br>
								<span class="actions" onclick="listingOnglet1_7()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Single" AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-8">

								<br>
								<span class="actions" onclick="listingOnglet1_8()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND ((REMARQUES != "" AND REMARQUES IS NOT NULL) OR (REMARQUES_ACC != "" AND REMARQUES_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Partenaire</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Remarques
										echo '<th style="text-align: left;"><b>' . $data[11] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Remarques Partenaire
										echo '<th style="text-align: left;"><b>' . $data[13] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-9">

								<br>
								<span class="actions" onclick="listingOnglet1_9()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND ((REMARQUES_ALI != "" AND REMARQUES_ALI IS NOT NULL) OR (REMARQUES_ALI_ACC != "" AND REMARQUES_ALI_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Alimentaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Alimentaire Partenaire</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Remarques Alimentaire
										echo '<th style="text-align: left;"><b>' . $data[12] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Remarques Alimentaire Partenaire
										echo '<th style="text-align: left;"><b>' . $data[14] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-10">
								<br>
								<span class="actions" onclick="listingOnglet1_10()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND FIRST_CO = 1 AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-1-11">
								<br>
								<span class="actions" onclick="listingOnglet1_11()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND FIRST_CO = 0 AND GROUPE_VOYAGE = 1';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<ul class="actions" style="float:right;">
								<li><a class="button special" href="backoffice.php" style="margin-top: 20px;">RETOUR</a></li>
							</ul>
						</div>

						<div id="tabs-Groupe-2">
							<ul>
								<li>
									<a href="#tabs-2-1" id="tabulation2-1">Total</a>
								</li>
								<li>
									<a href="#tabs-2-2" id="tabulation2-2">Validé</a>
								</li>
								<li>
									<a href="#tabs-2-3" id="tabulation2-3">Sauvegardé</a>
								</li>
								<li>
									<a href="#tabs-2-4" id="tabulation2-4">Sans Réponse</a>
								</li>
								<li>
									<a href="#tabs-2-5" id="tabulation2-5">Double</a>
								</li>
								<li>
									<a href="#tabs-2-6" id="tabulation2-6">Twin</a>
								</li>
								<li>
									<a href="#tabs-2-7" id="tabulation2-7">Single</a>
								</li>
								<li>
									<a href="#tabs-2-8" id="tabulation2-8">Remarques</a>
								</li>
								<li>
									<a href="#tabs-2-9" id="tabulation2-9">Remarques Alimentaires</a>
								</li>
								<li>
									<a href="#tabs-2-10" id="tabulation2-10">Connectés</a>
								</li>
								<li>
									<a href="#tabs-2-11" id="tabulation2-11">Non Connectés</a>
								</li>
							</ul>

							<div id="tabs-2-1">

								<br>
								<span class="actions" onclick="listingOnglet2_1()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-2">

								<br>
								<span class="actions" onclick="listingOnglet2_2()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 1 AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="delete-validation.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm4" style="text-decoration:none;" title="Validation"><i class="fas fa-bookmark"></i></a>';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-3">

								<br>
								<span class="actions" onclick="listingOnglet2_3()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 0 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "") AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-4">

								<br>
								<span class="actions" onclick="listingOnglet2_4()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND PARTICIPATION = 0 AND (LAST_SAVE IS NULL OR LAST_SAVE = "") AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Type de Chambre</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Type de Chambre
										echo '<th style="text-align: left;"><b>' . $data[9] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-5">

								<br>
								<span class="actions" onclick="listingOnglet2_5()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Double" AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-6">

								<br>
								<span class="actions" onclick="listingOnglet2_6()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Twin" AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-7">
								<br>
								<span class="actions" onclick="listingOnglet2_7()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND TYPE_CHAMBRE = "Single" AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Validation</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										if ($data[8] == 1) {
											$validation == "Validé";
										} else if ($data[10] !== NULL && $data[10] != "") {
											$validation == "Sauvegardé";
										} else {
											$validation == "Sans Réponse";
										}

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Validation
										echo '<th style="text-align: left;"><b>' . $validation . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-8">

								<br>
								<span class="actions" onclick="listingOnglet2_8()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND ((REMARQUES != "" AND REMARQUES IS NOT NULL) OR (REMARQUES_ACC != "" AND REMARQUES_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Partenaire</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Remarques
										echo '<th style="text-align: left;"><b>' . $data[11] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Remarques Partenaire
										echo '<th style="text-align: left;"><b>' . $data[13] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-9">

								<br>
								<span class="actions" onclick="listingOnglet2_9()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND ((REMARQUES_ALI != "" AND REMARQUES_ALI IS NOT NULL) OR (REMARQUES_ALI_ACC != "" AND REMARQUES_ALI_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Alimentaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Partenaire</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Remarques Alimentaire Partenaire</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {
										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Remarques Alimentaire
										echo '<th style="text-align: left;"><b>' . $data[12] . '</b></th>';
										// Partenaire
										echo '<th style="text-align: left;"><b>' . $data[5] . ' ' . $data[6] . ' ' . $data[7] . '</b></th>';
										// Remarques Alimentaire Partenaire
										echo '<th style="text-align: left;"><b>' . $data[14] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th class="mobile_no"></th>
									<th class="mobile_no"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-10">
								<br>
								<span class="actions" onclick="listingOnglet2_10()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND FIRST_CO = 1 AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<div id="tabs-2-11">
								<br>
								<span class="actions" onclick="listingOnglet2_11()" style="cursor:pointer; color:#000;"><i class="fas fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>

								<table style="margin-top:30px;">

									<?php
									$condition = 'AND FIRST_CO = 0 AND GROUPE_VOYAGE = 2';
									?>

									<tr>
										<th class="mobile_no" style="width: 1em"></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Civ Nom Prénom</strong></b></th>
										<th style="text-align: left;"><b><strong style="font-weight: bold">Agence</strong></b></th>
										<th>&nbsp;</th>
									</tr>
									<?php

									$list = $usr->selectInfosListe($condition);

									if ($nomcherche != "") {
										$list = $usr->rechercheListe($nomcherche, $condition);
									}

									$datas = $list[0];
									$participation = $list[1];

									$i = 1;

									foreach ($datas as $data) {

										echo '<tr>';
										echo '<th class="mobile_no" style="width: 1em"></th>';
										// Civilité, Nom, Prénom
										echo '<th style="text-align: left;"><b>' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</b></th>';
										// Agence
										echo '<th style="text-align: left;"><b>' . $data[4] . '</b></th>';

										echo '<th style="text-align: right; width: 160px;">';
										echo '<a href="relance.php?user=' . $data[0] . '" class="confirm2" style="text-decoration:none;" title="Renvoyer"><i class="fas fa-envelope"></i></a>';
										echo '<a href="profil.php?idColaborateur=' . $data[0] . '&event=' . $event . '" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
										echo '<a href="delete-profil.php?user=' . $data[0] . '&event=' . $event . '&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
										echo '</th>';

										echo '</tr>';
									}
									?>
									<th class="mobile_no" style="width: 1em"></th>
									<th style="text-align: left;">Total :</th>
									<th style="text-align: left;"><b><?php echo $participation; ?></b></th>
									<th></th>
								</table>

							</div>

							<ul class="actions" style="float:right;">
								<li><a class="button special" href="backoffice.php" style="margin-top: 20px;">RETOUR</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$("#add").click(function() {
				$("#ajout").css("display", "block");
				$("#add").css("display", "none");
			});

			$("#annuler").click(function() {
				$("#ajout").css("display", "none");
				$("#add").css("display", "inline-block");
				$("#messagein").css("display", "none");
				$("#nom").css("border-color", "#dbdbdb");
				$("#nom").val("");
			});

			$('.confirm').click(function(e) {
				e.preventDefault();
				if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette fiche principale? Cette action est irréversible et la société ainsi que tous les collaborateurs seront supprimés.")) {
					location.href = this.href;
				}
			});

			$('.confirm4').click(function(e) {
				e.preventDefault();
				if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer la validation ?")) {
					location.href = this.href;
				}
			});

			$('.confirm3').click(function(e) {
				e.preventDefault();
				if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette fiche? Cette action est irréversible et toutes les données seront perdues !")) {
					location.href = this.href;
				}
			});

			$('.confirm2').click(function(e) {
				e.preventDefault();
				if (window.confirm("Attention, êtes-vous sûr(e) de vouloir renvoyer le mail d'invitation ?")) {
					location.href = this.href;
				}
			});

		});
	</script>

	<script type="text/javascript">
		var clock;

		function listingOnglet() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet';
			window.open(url)
		}

		function listingOnglet0_1() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_1';
			window.open(url)
		}

		function listingOnglet0_2() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_2';
			window.open(url)
		}

		function listingOnglet0_3() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_3';
			window.open(url)
		}

		function listingOnglet0_4() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_4';
			window.open(url)
		}

		function listingOnglet0_5() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_5';
			window.open(url)
		}

		function listingOnglet0_6() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_6';
			window.open(url)
		}

		function listingOnglet0_7() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_7';
			window.open(url)
		}

		function listingOnglet0_8() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_8';
			window.open(url)
		}

		function listingOnglet0_9() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_9';
			window.open(url)
		}

		function listingOnglet0_10() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_10';
			window.open(url)
		}

		function listingOnglet0_11() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet0_11';
			window.open(url)
		}

		function listingOnglet1_1() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_1';
			window.open(url)
		}

		function listingOnglet1_2() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_2';
			window.open(url)
		}

		function listingOnglet1_3() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_3';
			window.open(url)
		}

		function listingOnglet1_4() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_4';
			window.open(url)
		}

		function listingOnglet1_5() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_5';
			window.open(url)
		}

		function listingOnglet1_6() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_6';
			window.open(url)
		}

		function listingOnglet1_7() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_7';
			window.open(url)
		}

		function listingOnglet1_8() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_8';
			window.open(url)
		}

		function listingOnglet1_9() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_9';
			window.open(url)
		}

		function listingOnglet1_10() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_10';
			window.open(url)
		}

		function listingOnglet1_11() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet1_11';
			window.open(url)
		}

		function listingOnglet2_1() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_1';
			window.open(url)
		}

		function listingOnglet2_2() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_2';
			window.open(url)
		}

		function listingOnglet2_3() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_3';
			window.open(url)
		}

		function listingOnglet2_4() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_4';
			window.open(url)
		}

		function listingOnglet2_5() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_5';
			window.open(url)
		}

		function listingOnglet2_6() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_6';
			window.open(url)
		}

		function listingOnglet2_7() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_7';
			window.open(url)
		}

		function listingOnglet2_8() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_8';
			window.open(url)
		}

		function listingOnglet2_9() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_9';
			window.open(url)
		}

		function listingOnglet2_10() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_10';
			window.open(url)
		}

		function listingOnglet2_11() {
			let url = 'https://voyages-abeille-assurances.fr/exportByOnglet.php?export=onglet2_11';
			window.open(url)
		}

		$(document).ready(function() {

			$("#add").click(function() {
				$("#ajout").css("display", "block");
				$("#add").css("display", "none");
			});

			$("#fermervalid").click(function() {
				$("#messageok").css("display", "none");
			});

			$("#annuler").click(function() {
				$("#ajout").css("display", "none");
				$("#add").css("display", "inline-block");
				$("#messagein").css("display", "none");
				$("#monsieur2").css("color", "#9a9a9a");
				$("#madame2").css("color", "#9a9a9a");
				$("#mademoiselle2").css("color", "#9a9a9a");
				$("#monsieur").prop('checked', false);
				$("#madame").prop('checked', false);
				$("#mademoiselle").prop('checked', false);
				$("#nom").css("border-color", "#dbdbdb");
				$("#nom").val("");
				$("#prenom").css("border-color", "#dbdbdb");
				$("#prenom").val("");
				$("#email").css("border-color", "#dbdbdb");
				$("#email").val("");
				$("#societe").css("border-color", "#dbdbdb");
				$("#societe").val("");
				$("#code").css("border-color", "#dbdbdb");
				$("#code").val("");
			});

		});
	</script>

</body>

</html>