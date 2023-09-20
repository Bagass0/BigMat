<?php
require_once './connect_societe.php';
?>

<div class="Conteneur55">
	<header id="header">
		<div id="nav1" style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.1);" class="bgColorHeader">
			<a href="index.php" class="logo" style="width: auto;"></a>
			<nav id="nav" style="background-color: rgba(0, 0, 0, 0.4);">
				<div class="inner marginTop" style="max-width: 100%;">
					<a style="padding: 0; margin: 0;" href="index.php"><img src="images/logo.png" style="width: 10em; margin: 0.5em" class="displayHeader2"></a>
					<?php include 'menu.php'; ?>
					<div class="inner displayHeader" style="display: flex; max-width: 100%; max-width: 100%;">
						<?php include 'menu1.php'; ?>
					</div>
				</div>
			</nav>
		</div>
	</header>

</div>	