<?php

include 'connect_hebergement.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

$fichierPHP = basename(__FILE__);

if ($dataGeneral["OPT_HEBERGEMENT"] != 1) {
	header("Location: accueil.php$eventurl");
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Mesures Sanitaires - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="assets/css/gallery.theme.css">
	<link rel="stylesheet" href="assets/css/gallery.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

</head>

<body class="bgPages">

	<?php include 'header.php' ?>

	<section id="two" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 5em; margin-bottom: -7em;">
		<h3 style="font-weight: 700; margin-left: 1.5em; font-size: 2em;"> Mesures Sanitaires </h3>
	</section>

	<section id="one" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 0 !important">

		<div class="inner">

			<p style="margin: 0 1em 0 1em; text-align: left; font-family: 'Source Sans Pro', sans-serif">
				*Conditions dʼentrée mises à jour au 05/04/2022<br>
				<br>
				<b style="background-color: #FFD400; font-family: 'Montserrat',	sans-serif">&nbsp;ENTRÉE SUR LE TERRITOIRE MALTAIS DEPUIS LA FRANCE&nbsp;</b><br>
				<br>
				Les mesures applicables dépendent du pays de provenance dans les 14 jours qui précèdent le voyage à Malte (et non de la nationalité du voyageur).<br>
				<br>
				Les voyageurs qui entrent à Malte depuis la France doivent :<br>
				<br>
				<i class="fas fa-circle" style="color: #FFD400; font-size: 10pt;"></i>&nbsp;<b>Présenter un pass sanitaire valide :</b><br>
				<br>
				- soit un schéma vaccinal complet* reconnu par lʼEMA : *complet = 14 jours après la dernière injection et pour un maximum de 270 jours<br>
				- soit une preuve de guérison (test PCR positif datant d’au moins 14 jours et de moins de 180 jours & test PCR négatif de moins de 72 heures);<br>
				<em class="em14" style="font-size: 10pt;">&nbsp;&nbsp;&nbsp;un test antigénique positif n’est pas un certificat de guérison valable pour circuler en Europe<br></em>
				- soit le résultat d’un test négatif (antigénique de moins de 24 heures ou PCR de moins de 72 heures)<br>
				<br>
				Les autorités maltaises prévoient également la réalisation de tests aléatoires dans les aéroports, y compris pour les voyageurs déjà vaccinés et testés avant lʼembarquement.<br>
				<br>
				<i class="fas fa-circle" style="color: #FFD400; font-size: 10pt;"></i>&nbsp;<b>Remplir un formulaire de traçabilité :</b><br>
				<br>
				Le Passenger Locator Form (dPLF) est accessible sur le portail en ligne <a href="https://app.euplf.eu/#/" target="_blank" style="color: #000;">https://app.euplf.eu/</a> (sélectionnez la langue dans le coin en haut à droite).<br>
				<br>
				Le port du masque chirurgical est obligatoire dans l’avion et à l’aéroport.<br>
				<br>
				<b style="background-color: #FFD400; font-family: 'Montserrat',	sans-serif">&nbsp;RETOUR SUR LE TERRITOIRE FRANÇAIS DEPUIS MALTE&nbsp;</b><br>
				<br>
				<i class="fas fa-circle" style="color: #FFD400; font-size: 10pt;"></i>&nbsp;<b>Présenter un pass sanitaire valide :</b><br>
				<br>
				Les voyageurs ne disposant pas dʼun justificatif attestant dʼun schéma vaccinal complet ou dʼun certificat de rétablissement à la Covid-19 devront présenter, au retour en France, le résultat négatif dʼun test (PCR ou antigénique) de moins de 48 heures.<br>
				<br>
				Les autorités françaises prévoient également la réalisation de tests aléatoires dans les aéroports, y compris pour les voyageurs non vaccinés et testés avant lʼembarquement.<br>
				<br>
				<i class="fas fa-circle" style="color: #FFD400; font-size: 10pt;"></i>&nbsp;<b>Remplir un formulaire de traçabilité :</b><br>
				<br>
				Le Passenger Locator Form (dPLF) est accessible sur le portail en ligne <a href="https://app.euplf.eu/#/" target="_blank" style="color: #000;">https://app.euplf.eu/</a> (sélectionnez la langue dans le coin en haut à droite).<br>
				<br>
				<br>
			</p>

		</div>
	</section>

	<?php include 'footer.php'; ?>

	<script src="assets/js/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/flipclock.min.js"></script>
	<script>
		var displayContent = function(event, a, b) {
			var output = document.getElementsByClassName('out-' + a + '-' + b);
			output[0].innerHTML = event.target.files[0].name;
		}
	</script>
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