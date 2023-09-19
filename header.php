<?php
require_once './connect_societe.php';
?>

<header id="header" style="height: fit-content; position: fixed;">
	<div id="nav1" style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.5);" class="bgColorHeader">
		<a href="index.php" class="logo" style="width: auto;"></a>
		<nav id="nav">
			<div class="inner marginTop" style="max-width: 100%;">
				<a style="border-right: none; padding: 0; margin: 0;" href="index.php"><img src="images/logo-header.jpg" style="width: 10em; margin: 0.5em" class="displayHeader2"></a>
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
				<img src="images/logo-header.jpg" style="width: 10em; margin: 1em; display: none;" class="displayHeader">
				<p style="margin: 0;"><mark style="background-color: #FFD400; color: #000; margin-left: 5.5em;" class="marginHeader">&nbsp;Voyage courtage national&nbsp;</mark></p>
			</a>
			<a href="#navPanel" class="navPanelToggle" style="border-right: none;"><span class="fa fa-bars" style="margin-right: 1em;"></span></a>
		</div>
	</div>
</header>