<?php include 'connect_infos_pratiques.php';

require_once './class/User.php';
require_once './class/Activity.php';

$usr = new User();
$act = new Activity();

$data = $usr->findOneById($_SESSION['id']);

$fichierPHP = basename(__FILE__);

if ($dataGeneral["OPT_PRESSE"] != 1) {
	header("Location: accueil.php$eventurl");
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Les Bonnes Adresses - <?php echo $dataGeneral['NOM']; ?></title>
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
	</script>
</head>

<body class="bgPages">

	<?php include 'header.php' ?>

	<section id="two" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 5em; margin-bottom: -7em;">
		<h3 style="font-weight: 700; margin-left: 1.5em; font-size: 2em;"> Les Bonnes Adresses </h3>
	</section>

	<section id="one" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 0 !important">

		<div class="inner" style="max-width: 90%;">

			<div style="display: block" id="tabs">

				<ul>
					<li>
						<a href="#tabs-1" id="tabulation1">Musées</a>
					</li>
					<li>
						<a href="#tabs-2" id="tabulation2">Shopping</a>
					</li>
					<li>
						<a href="#tabs-3" id="tabulation3">Pubs / Clubs</a>
					</li>
				</ul>

				<div class="displayBlockAdresses" id="tabs-1">

					<div style="width: 100%; justify-content: center; padding-bottom: 3em;" class="adressesBoxBis">

						<h3 class="sourceSansPro" style="font-weight: 600; font-size: 24pt; text-align: center;">Musées</h3>

						<div class="adressesMainBoxBis">

							<?php

							$condition = 'EVENT_ID = 1';

							$datas = $act->selectInfosListe($condition);

							foreach ($datas as $data) {
							?>
								<div class="adressesBox" style="margin: 0;">

									<h3 class="sourceSansPro" style="font-weight: 600; font-size: 20pt; text-align: center;"><?php echo $data['THEME']; ?></h3>

									<p class="sourceSansPro" style="text-align: center; font-size: 14pt;">
										<?php echo $data['DESCRIPTION']; ?>
									</p>

									<hr>

									<p class="sourceSansPro" style="text-align: center; font-size: 13pt;">
										Adresse : <?php echo $data['SALLE']; ?>
										<br>
										<br>
										Horaires : <?php echo $data['HEURE']; ?>
									</p>

								</div>
							<?php
							}
							?>
						</div>

					</div>
				</div>

				<div class="displayBlockAdresses" id="tabs-2">

					<div style="width: 100%; justify-content: center; padding-bottom: 3em;" class="adressesBoxBis">

						<h3 class="sourceSansPro" style="font-weight: 600; font-size: 24pt; text-align: center;">Shopping - Souvenirs / Nourriture</h3>

						<div class="adressesMainBox">

							<?php

							$condition = 'EVENT_ID = 2';

							$datas = $act->selectInfosListe($condition);

							foreach ($datas as $data) {
							?>
								<div class="adressesBox" style="margin: 0;">

									<h3 class="sourceSansPro" style="font-weight: 600; font-size: 20pt; text-align: center;"><?php echo $data['THEME']; ?></h3>

									<p class="sourceSansPro" style="text-align: center; font-size: 14pt;">
										<?php echo $data['DESCRIPTION']; ?>
									</p>

									<hr>

									<p class="sourceSansPro" style="text-align: center; font-size: 13pt;">
										Adresse : <br><?php echo $data['SALLE']; ?>
										<br>
										<br>
										Horaires : <br><?php echo $data['HEURE']; ?>
									</p>

								</div>
							<?php
							}
							?>
						</div>
					</div>

					<div style="width: 100%; justify-content: center; padding-bottom: 3em;" class="adressesBoxBis">

						<h3 class="sourceSansPro" style="font-weight: 600; font-size: 24pt; text-align: center;">Shopping / Textile</h3>

						<div class="adressesMainBox">

							<?php

							$condition = 'EVENT_ID = 3';

							$datas = $act->selectInfosListe($condition);

							foreach ($datas as $data) {
							?>
								<div class="adressesBox" style="margin: 0;">

									<h3 class="sourceSansPro" style="font-weight: 600; font-size: 20pt; text-align: center;"><?php echo $data['THEME']; ?></h3>

									<p class="sourceSansPro" style="text-align: center; font-size: 14pt;">
										<?php echo $data['DESCRIPTION']; ?>
									</p>

									<hr>

									<p class="sourceSansPro" style="text-align: center; font-size: 13pt;">
										Adresse : <br><?php echo $data['SALLE']; ?>
										<br>
										<br>
										Horaires : <br><?php echo $data['HEURE']; ?>
									</p>

								</div>
							<?php
							}
							?>
						</div>
					</div>

				</div>

				<div class="displayBlockAdresses" id="tabs-3">

					<div style="width: 100%; justify-content: center; padding-bottom: 3em;" class="adressesBoxBis">

						<h3 class="sourceSansPro" style="font-weight: 600; font-size: 24pt; text-align: center;">Pubs / Clubs - OLD TOWN</h3>

						<div class="adressesMainBox">

							<?php

							$condition = 'EVENT_ID = 4';

							$datas = $act->selectInfosListe($condition);

							foreach ($datas as $data) {
							?>
								<div class="adressesBox" style="margin: 0;">

									<h3 class="sourceSansPro" style="font-weight: 600; font-size: 20pt; text-align: center;"><?php echo $data['THEME']; ?></h3>

									<p class="sourceSansPro" style="text-align: center; font-size: 14pt;">
										<?php echo $data['DESCRIPTION']; ?>
									</p>

									<hr>

									<p class="sourceSansPro" style="text-align: center; font-size: 13pt;">
										Adresse : <br><?php echo $data['SALLE']; ?>
										<br>
										<br>
										Horaires : <br><?php echo $data['HEURE']; ?>
									</p>

								</div>
							<?php
							}
							?>
						</div>
					</div>

					<div style="width: 100%; justify-content: center; padding-bottom: 3em;" class="adressesBoxBis">

						<h3 class="sourceSansPro" style="font-weight: 600; font-size: 24pt; text-align: center;">Pubs / Clubs - NEW TOWN</h3>

						<div class="adressesMainBox">

							<?php

							$condition = 'EVENT_ID = 5';

							$datas = $act->selectInfosListe($condition);

							foreach ($datas as $data) {
							?>
								<div class="adressesBox" style="margin: 0;">

									<h3 class="sourceSansPro" style="font-weight: 600; font-size: 20pt; text-align: center;"><?php echo $data['THEME']; ?></h3>

									<p class="sourceSansPro" style="text-align: center; font-size: 14pt;">
										<?php echo $data['DESCRIPTION']; ?>
									</p>

									<hr>

									<p class="sourceSansPro" style="text-align: center; font-size: 13pt;">
										Adresse : <br><?php echo $data['SALLE']; ?>
										<br>
										<br>
										Horaires : <br><?php echo $data['HEURE']; ?>
									</p>

								</div>
							<?php
							}
							?>
						</div>
					</div>

					<div style="width: 100%; justify-content: center; padding-bottom: 3em;" class="adressesBoxBis">

						<h3 class="sourceSansPro" style="font-weight: 600; font-size: 24pt; text-align: center;">Pubs / Clubs - Boîtes de nuit</h3>

						<div class="adressesMainBox">

							<?php

							$condition = 'EVENT_ID = 6';

							$datas = $act->selectInfosListe($condition);

							foreach ($datas as $data) {
							?>
								<div class="adressesBox" style="margin: 0;">

									<h3 class="sourceSansPro" style="font-weight: 600; font-size: 20pt; text-align: center;"><?php echo $data['THEME']; ?></h3>

									<p class="sourceSansPro" style="text-align: center; font-size: 14pt;">
										<?php echo $data['DESCRIPTION']; ?>
									</p>

									<hr>

									<p class="sourceSansPro" style="text-align: center; font-size: 13pt;">
										Adresse : <br><?php echo $data['SALLE']; ?>
										<br>
										<br>
										Horaires : <br><?php echo $data['HEURE']; ?>
									</p>

								</div>
							<?php
							}
							?>
						</div>
					</div>

				</div>

			</div>

		</div>
	</section>

	<?php include 'footer.php'; ?>

	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/flipclock.min.js"></script>
	<script type="text/javascript">
		var clock;

		$(document).ready(function() {

			var currentDate = new Date();
			var futureDate = new Date(2023, 04, 19);

			var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
			if (diff == 0 | diff < 0) {
				diff = 0;
			}

			clock = $('.clock').FlipClock(diff, {
				clockFace: 'DailyCounter',
				countdown: true
			});
		});
	</script>

</body>

</html>