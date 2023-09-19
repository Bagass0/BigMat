<?php include 'connect.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>RGPD - <?php echo $dataGeneral['NOM']; ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/flipclock.css">
	<link rel="icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">

</head>

<body>

	<?php include 'header.php' ?>

	<section id="one" class="wrapper align-center" style="margin-bottom: 100px; margin-top: 3.3em;">
		<div class="inner">

			<div class="row uniform">

				<div class="9u 12u$(small)" style="width: 100%">

					<h2 id="content" style="color:#f99f1b; font-size: 38px; line-height: 38px;">Données personnelles</h2>

					<p>
						Les informations recueillies sur ce site sont enregistrées dans un fichier informatisé par AREP-Exigences pour la gestion des inscriptions pour le compte d'Abeille&nbsp;Assurances.<br>
						Ces informations peuvent servir à la gestion des événements et des appels à projets d'Abeille&nbsp;Assurances. Elles ne seront pas cédées à d’autres organismes.<br>

						Conformément à la loi « informatique et libertés », vous pouvez exercer votre droit d'accès aux données vous concernant et les faire rectifier en contactant : le service digital et événementiel d'AREP-Exigences au 01 85 74 00 00 ou rgpd@arep.co.com<br>

						Nous vous informons de l’existence de la liste d'opposition au démarchage téléphonique « Bloctel », sur laquelle vous pouvez vous inscrire ici :
						<a href="https://conso.bloctel.fr" target="_blank">https://conso.bloctel.fr</a>
					</p>

				</div>

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