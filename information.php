<?php include 'connect_infos_pratiques.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

$fichierPHP = basename(__FILE__);

if ($dataGeneral["OPT_INFOSPRATIQUES"] != 1) {
	header("Location: accueil.php$eventurl");
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Informations pratiques - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<link rel="stylesheet" href="assets/css/gallery1.css">
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
</head>

<body class="bgPages">

	<?php include 'header.php' ?>
<!--
	<section id="two" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 5em; margin-bottom: -7em;">
		<h3 style="font-weight: 700; margin-left: 1.5em; font-size: 2em;"> Informations Pratiques </h3>
	</section> -->

	<section id="one" class="wrapper align-left" style="border-radius: 1em; padding-top: 2em; margin-top: 0 !important">
		<div class="container-galerie">
			<h1>Galerie</h1>
			<div class="gallery1">
				<div class="gallery-item1">
					<img src="images/AdobeStock_114264196.jpeg" alt="Image 1">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_174715464.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_182533495.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_321492549.jpeg" alt="Image 2">
				</div>
			</div>
			<div class="gallery1">
				<div class="gallery-item1">
					<img src="images/AdobeStock_404555511.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_4287791.jpg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_45903314.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_488373627.jpeg" alt="Image 2">
				</div>
			</div>
			<div class="gallery1">
				<div class="gallery-item1">
					<img src="images/AdobeStock_56136013.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_7624965.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_95087697.jpeg" alt="Image 2">
				</div>
				<div class="gallery-item1">
					<img src="images/AdobeStock_7624965.jpeg" alt="Image 2">
				</div>
			</div>
		</div>
	<!--
		<div class="inner" style="max-width: 90%;">

			<div style="display: block">

				<div class="displayBlockInfo">

					<div style="width: 100%;" class="informationBox">

						<div style="display: flex;" class="displayPicto">
							<img src="images/formalites.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto">FORMALITÉS</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							<u>Conditions dʼentrée sur le territoire Écossais :</u><br>
							<br>
							Pour se rendre en Écosse, les ressortissants de l’Union Européenne doivent être en possession d’un <b class="sourceSansPro">passeport en cours de validité</b>, valable au moins <b class="sourceSansPro">jusquʼau <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "17" : "18"); ?> juin 2023</b>.<br>
							<br>
							<br>
							<u>Formalités sanitaires :</u><br>
							<br>
							Les dernières restrictions sanitaires portant sur les déplacements vers le Royaume-Uni ont été levées. Depuis mars 2022, il n’est plus nécessaire de justifier d’un schéma vaccinal complet ou de présenter le résultat d’un test négatif, ni de compléter le « passenger locator form ».
						</p>

					</div>

				</div>

				<div class="displayBlockInfo">

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/climat.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">CLIMAT</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							<b class="sourceSansPro">En juin</b>, le climat est généralement ensoleillé en Écosse. La température durant la journée oscille entre <b class="sourceSansPro">15 et 20°C.</b><br>
							<br>
							Les journées y sont plus longues qu’en France : mi-juin le soleil se couche entre 21h30 – 22h00.<br>
						</p>

					</div>

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/decalage-horaire.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">DÉCALAGE HORAIRE</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							Décalage horaire avec la France : -1h00<br>
							Quand il est 12h00 en France, il est 11h00 en Écosse.
							<br>
						</p>

					</div>

				</div>

				<div class="displayBlockInfo">

					<div style="width: 100%;" class="informationBox">

						<div style="display: flex;" class="displayPicto">
							<img src="images/transport.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto">PLAN DE TRANSPORT</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							• Aller - <b class="sourceSansPro" style="background-color: #FFD400;"> <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "Mardi 13 juin 2023" : "Mercredi 14 juin 2023"); ?> </b><br>
							PARIS ROISSY CDG / GLASGOW – 14H00 / 14H50* - EasyJet 3126<br>
							• Retour - <b class="sourceSansPro" style="background-color: #FFD400;"> <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "Vendredi 16 juin 2023" : "Samedi 17 juin 2023"); ?> </b><br>
							EDIMBOURG / <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "PARIS ORLY - 14H25 / 17H25*  - Transavia 7925" : "PARIS ROISSY CDG - 13H00 / 15H55*  - EasyJet 3241"); ?><br>
							*Horaires à ce jour, sous réserve de modification par la compagnie aérienne<br>
							<br>
							- 1 petit bagage à main par personne, qui doit pouvoir être rangé sous le siège devant vous. Max 45 x 36 x 20 cm (poignées et roues comprises)<br>
							- 1 bagage en soute par personne : <b class="sourceSansPro">20KG maximum</b> & dimensions totales moins de 158 cm (longueur + largeur + hauteur)<br>
							<br>
							Votre convocation aéroport, vous précisant l’heure et le lieu exact de votre rendez-vous, vous sera envoyée par <u class="sourceSansPro">email 7 jours avant le départ</u>.<br>
							<br>
							Vous retrouverez votre accompagnateur à l’aéroport PARIS ROISSY CDG le jour du départ à <b class="sourceSansPro">12h00</b>.
							Celui-ci vous accueillera en zone d’enregistrement et vous remettra votre carte d’embarquement.<br>

						</p>

					</div>
				</div>

				<div class="displayBlockInfo">

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/valise.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">VALISE</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							D’une manière générale, pour les visites et excursions, privilégiez des vêtements confortables et des chaussures plates (type baskets ou de randonnée).<br>
							<br>
							N’oubliez pas : chapeau ou casquette, lunettes de soleil, crème solaire, maillots de bain (des serviettes vous seront fournies à l’hôtel).<br>
							<br>
							Pour les dîners, nous vous conseillons des tenues de ville et une tenue plus élégante pour le diner de gala (casual chic).<br>
							<br>
							Nous vous conseillons également de prévoir une veste pour l’avion et les soirées qui peuvent être plus fraîches.<br>

						</p>

					</div>

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/shopping.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">SHOPPING</h3>
						</div>

						<p class="sourceSansPro">
								Après un voyage inoubliable en Écosse, vous aurez surement envie de rapporter des souvenirs.<br>
								<br>
								Voici quelques suggestions :<br>
								- Un Kilt (tenue traditionnelle) ou un Tartan écossais (sorte d’écharpe)<br>
								- Le Sgian-Dubh (petit couteau traditionnel)<br>
								- Le vin Cairn O’Mohr<br>
								- Du Whisky
							</p>

					</div>

				</div>

				<div class="displayBlockInfo">

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/monnaie.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">MONNAIE</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							La livre sterling est la monnaie officielle de l’Écosse.<br>
							<br>
							Les cartes de paiement Visa, MasterCard et Amex sont largement acceptées, nous vous conseillons néanmoins de prévoir un peu d’espèces pour vos achats dans les petits commerces qui n’acceptent pas les cartes.<br>
						</p>

					</div>

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/langue.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">LANGUE</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							En Écosse, on parle avant tout l’anglais.<br>
							La deuxième langue officielle est le gaélique écossais.<br>
						</p>

					</div>

				</div>

				<div class="displayBlockInfo">

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/assurance.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">ASSURANCE</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							Pendant tout le voyage, vous êtes assurées par Abeille&nbsp;Assurances pour l’assistance médicale, le rapatriement et vos bagages.<br>
						</p>

					</div>

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/electricite.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">ÉLECTRICITÉ</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							Courant 230V ; prise de type britannique à 3 fiches<br>
							<br>
							Il y a des prises USB et françaises à l'hôtel Radisson Blu, mais pas au Cameron House, il faut donc penser à <b class="sourceSansPro">prévoir un adaptateur UE > UK</b>.<br>
						</p>

					</div>

				</div>

				<div class="displayBlockInfo">

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/telephone.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">TÉLÉPHONE</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							Malgré le Brexit, les opérateurs européens se sont engagés à ne pas imposer de frais d'itinérance (roaming) à leurs clients voyageant au Royaume-Uni.<br>
							On peut donc passer des appels depuis son portable, utiliser la 3, 4 et 5G vers la France comme à l'intérieur de l'Écosse sans surcoût.<br>
							<br>
							Nous vous recommandons toutefois de vous rapprocher de votre opérateur avant le départ.<br>
							<br>
							Le WIFI est également disponible gratuitement dans vos hôtels.<br>
						</p>

					</div>

					<div class="informationBox widthBlockInfo">

						<div style="display: flex;" class="displayPicto displayPicto2">
							<img src="images/hebergement.png" style="padding: 0 1em 0 1em; height: fit-content;">
							<h3 class="informationTitre displayPicto displayPicto2">VOS HÉBERGEMENTS</h3>
						</div>

						<p class="sourceSansPro" style="margin: 0 1em 0 1em; text-align: left;">
							<b class="sourceSansPro" style="font-weight: 600;">HÔTEL CAMERON HOUSE 5* - GLASGOW</b><br>
							Du <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "13 au 14" : "14 au 15"); ?> juin – 1 nuit<br>
							Loch Lomond, Alexandria G83 8QZ<br>
							Tél : +44 138 931 2210<br>
							<br>
							<b class="sourceSansPro" style="font-weight: 600;">HÔTEL RADISSON BLU 4* - EDIMBOURG</b><br>
							Du <?php //echo $infoGroupe = ($data['GROUPE_VOYAGE'] == 1 ? "14 au 16" : "15 au 17"); ?> juin – 2 nuits<br>
							The Royal Mile, 80 High St, Edinburgh EH1 1TH<br>
							Tél : +44 131 557 9797<br>
						</p>

					</div>

				</div>

			</div>

		</div>-->
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