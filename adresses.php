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

<body class="bgPages1">

	<?php include 'header.php' ?>

	
		<div id="Container_plan">
			<div class="Plan-text">
				<h1  style="color:#737070;">Plan d'accés</h1>
			</div>

		
				<iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d1320557.0156560491!2d1.371386826217826!3d49.72561785433974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e3!4m3!3m2!1d48.8282041!2d2.2411771!4m5!1s0x47c32a06f3deb899%3A0x9b50d169b2e8f78f!2sH%C3%B4tel%20Barri%C3%A8re%20Lille%2C%20777%20bis%20Pont%20de%20Flandres%2C%2059777%20Lille!3m2!1d50.636948499999995!2d3.0772608999999997!5e0!3m2!1sfr!2sfr!4v1695299690319!5m2!1sfr!2sfr" width="600" height="450" style="border:0;  margin-bottom: 36px; width: 1800px;  " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			
		</div>
	

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