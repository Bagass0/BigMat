<?php include 'connect_programme.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

$fichierPHP = basename(__FILE__);

if ($dataGeneral["OPT_PROGRAMME"] != 1) {
	header("Location: accueil.php$eventurl");
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Programme - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=SOURCESANSPRO:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

</head>

<body class="bgPages">

	<?php include 'header.php' ?>
<!--
	<section id="two" class="wrapper align-left" style="border-radius: 0px; padding-top: 5em; margin-top: 5em; margin-bottom: -7em;">
		<h3 style="font-weight: 700; margin-left: 1.5em; font-size: 2em;"> <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "13 au 16 juin 2023" : "14 au 17 juin 2023"); ?> </h3>
	</section>
-->
	
	<section id="one" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 0 !important">

		<div class="inner" style="max-width: 100%; margin-top: -3em;">

			<div class="displayProgramme">

				<?php if ($data['GROUPE_VOYAGE'] == 1) { ?>

					<div class="programmeBox">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 1&nbsp;--></mark> Mercredi 21 Septembre 2022</h3>
							<br>
							<!--
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									12H00<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Rendez-vous à l’aéroport Paris Roissy CDG – Terminal 2B en zone d’enregistrement<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;">
									14H00<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Décollage du vol EU 3126 de PARIS CDG<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									14H50<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Arrivée à l’aéroport de GLASGOW<br>
								</p>
							</div>
							<br>
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Transfert vers le Loch Lomond et visite guidée du charmant petit village de Luss<br>
								<br>
								Check-in à l’hôtel Cameron House et installation en chambre<br>
								<br>
								Dîner écossais dans une ambiance cosy au Club House<br>
							</p>-->
							<div class="programme">
								- Déjeuner à l'hôtel <br>
								- Conseil de surveilance<br>
								- Le Dijeuner à l'hôtel<br>
								- Nuit à l'hôtel Barriere Lille<br>
							</div>
						</div>

						<img src="images/Groupe 1 photo programme.png" class="programmeImg">

					</div>

					<div class="programmeBox reverseFlex">

						<img src="images/photo-2-programme.jpg" class="programmeImg imgDisplayNone1" style="border-radius: 0.7em 0 0 0.7em !important;">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 2&nbsp;--></mark> Jeudi 22 Septembre 2022</h3>
							<br>
							<!--
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Matinée consacrée à la découverte du Loch Lomond en petits groupes<br>
								<br>
								Déjeuner au Boat House avec vue sur le Lac<br>
								<br>
								Activités libres pour profiter de l’environnement exceptionnel du Cameron House<br>
								<br>
								Transfert vers Édimbourg en fin d’après-midi et check-in à l’hôtel Radisson<br>
								<br>
								Dîner au restaurant avec vue panoramique sur Édimbourg<br>

							</p>-->
							<div class="programme" >
								- Petit-déjeuner à l'hotel <br>
								- Conseil de surveilance<br>
								- La pause-café magic_quotes_runtime<br>
								- Cocktail déjeunatoire<br>
								- Réunion<br>
								- La pause-café PM<br>
								- Transfert aller/retour en bus pour la Soirée<br>
								- Visite guidée du Louvre Lens<br>
								- Diner et soirée au louvre Lens privatisé<br><br>

								Nuit à l'hôtel Barrière Lile<br>

							</div>
						</div>

						<img src="images/Groupe 2 photo programme.png" class="programmeImg imgDisplayNone2">

					</div>

					<div class="programmeBox">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 3&nbsp;--></mark> Vendredi 23 Septembre 2022</h3>
							<br>
							<!--
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Matinée consacrée à la visite guidée du centre historique d’Édimbourg et à la rencontre avec les artisans locaux<br>
								<br>
								Visite de la distillerie Holyrood<br>
								<br>
								Déjeuner traditionnel autour du Fish & Chips<br>
								<br>
								Réunion de travail à l’hôtel pour les courtiers et visite du Château d’Édimbourg pour les accompagnants<br>
								<br>
								Soirée de Gala commune<br>
							</p> -->
							<div class="programme" >
								- Petit-déjeuner à l'hôtel<br>
								- Réunion<br>
								- La pause-café matin<br>
								- Déjeuner<br>
								- La pause-café PM<br>
								- Réunion<br>
								- Visite guidée de Lile avec dégustation<br>
								- Transfert alier / retour en bus pour la soirée<br>
								- Dj<br><br>
								Nuit à l'hôtel Barrière Lile<br>
							</div>
						</div>

						<img src="images/Groupe Photo Accueil.png" class="programmeImg">

					</div>

					<div class="programmeBox  reverseFlex">

						

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 4&nbsp;--></mark> Samedi 24 Septembre 2022</h3>
							<br>
							<!--
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Promenade vers Arthur’s Seat, le point de vue panoramique sur la ville d’Édimbourg<br>
							</p>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									12H00<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Transfert vers l’aéroport d’Édimbourg<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									14H25<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Décollage du vol TO 7925 d’EDIMBOURG<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									17H25<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Arrivée à l’aéroport de <b class="sourceSansPro">PARIS ORLY</b><br>
								</p>
							</div>
							<br>
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Transfert retour en bus vers l’aéroport de Paris Roissy Charles de Gaulle pour ceux qui le souhaitent<br>
							</p>-->

							<div class="programme" >
							- Petit-déjeuner à l'hôtel <br>
							- Check out<br>
						</div>
						</div>
						

						<img src="images/AdobeStock_174715464.jpeg" class="programmeImg imgDisplayNone2">

					</div>

				<?php } else { ?>

					<div class="programmeBox">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 1&nbsp;--></mark> Mercredi 21 Septembre 2022</h3>
							<br> <!--
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									12H00<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Rendez-vous à l’aéroport Paris Roissy CDG – Terminal 2B en zone d’enregistrement<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;">
									14H00<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Décollage du vol EU 3126 de PARIS CDG<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									14H50<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Arrivée à l’aéroport de GLASGOW<br>
								</p>
							</div>
							<br>
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Transfert vers le Loch Lomond et visite guidée du charmant petit village de Luss<br>
								<br>
								Check-in à l’hôtel Cameron House et installation en chambre<br>
								<br>
								Dîner écossais dans une ambiance cosy au Club House<br>
							</p>-->
							<div class="programme" >
								- Déjeuner à l'hôtel <br>
								- Conseil de surveilance<br>
								- Le Dijeuner à l'hôtel<br>
								- Nuit à l'hôtel Barriere Lille<br>
							</div>
						</div>

						<img src="images/Groupe 1 photo programme.png" class="programmeImg">

					</div>

					<div class="programmeBox reverseFlex">

						<img src="images/photo-2-programme.jpg" class="programmeImg imgDisplayNone1" style="border-radius: 0.7em 0 0 0.7em !important;">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 2&nbsp;--></mark>Jeudi 22 Septembre 2022</h3>
							<br>
							<!--
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Matinée consacrée à la découverte du Loch Lomond en petits groupes ou golf pour ceux qui le souhaitent<br>
								<br>
								Déjeuner au Boat House avec vue sur le Lac<br>
								<br>
								Transfert vers Édimbourg en début d’après-midi et check-in à l’hôtel Radisson<br>
								<br>
								Réunion de travail à l’hôtel pour les courtiers et visite du Château d’Édimbourg pour les accompagnants<br>
								<br>
								Soirée de Gala commune<br>
							</p>-->
							<div class="programme" >
								- Petit-déjeuner à l'hotel <br>
								- Conseil de surveilance<br>
								- La pause-café magic_quotes_runtime<br>
								- Cocktail déjeunatoire<br>
								- Réunion<br>
								- La pause-café PM<br>
								- Transfert aller/retour en bus pour la Soirée<br>
								- Visite guidée du Louvre Lens<br>
								- Diner et soirée au louvre Lens privatisé<br><br>

								Nuit à l'hôtel Barrière Lile<br>

							</div>
						</div>

						<img src="images/Groupe 2 photo programme.png" class="programmeImg imgDisplayNone2">

					</div>

					<div class="programmeBox">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 3&nbsp;--></mark>Vendredi 23 Septembre 2022</h3>
							<br>
							<!--
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Promenade vers Arthur’s Seat, le point de vue panoramique sur la ville d’Édimbourg<br>
								<br>
								Visite de la distillerie Holyrood<br>
								<br>
								Déjeuner traditionnel autour du Fish & Chips<br>
								<br>
								Après-midi consacrée à la visite guidée du centre historique d’Édimbourg et à la rencontre avec les artisans locaux<br>
								<br>
								Dîner au restaurant avec vue panoramique sur Édimbourg<br>
							</p>-->

						</div>

						<img src="images/Groupe Photo Accueil.png" class="programmeImg">

					</div>

					<div class="programmeBox  reverseFlex">

						<img src="images/photo-4-programme.jpg" class="programmeImg imgDisplayNone1" style="border-radius: 0.7em 0 0 0.7em !important;">

						<div class="displayPicto programmeText">
							<h3 class="programmeTitre displayPicto"><mark style="background-color: #FFD400;"><!--&nbsp;JOUR 4&nbsp;--></mark> Samedi 24 Septembre 2022</h3>
							<br> <!--
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									10H30<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Transfert vers l’aéroport d’Édimbourg<br>
								</p>
							</div>
							<br>
							<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
								Collation à emporter<br>
							</p>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									13H00<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Décollage du vol EU 3241 d’EDIMBOURG<br>
								</p>
							</div>
							<br>
							<div class="horairesProgramme">
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left; font-weight: 700;;">
									15H55<br>
								</p>
								<p class="sizeProgrammeP" style="margin: 0 1em 0 1em; text-align: left;">
									Arrivée à l’aéroport de <b class="sourceSansPro">PARIS ROISSY CDG</b><br>
								</p>
							</div>-->
							<div class="programme" >
							- Petit-déjeuner à l'hôtel <br>
							- Check out<br>
						</div>
						</div>

						<img src="images/AdobeStock_174715464.jpeg" class="programmeImg imgDisplayNone2">

					</div>

				<?php } ?>

			</div>
		</div>
	</section>

	<?php include 'footer.php'; ?>

	<script src="assets/js/jquery.min.js"></script>
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