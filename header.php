<?php
require_once './connect_societe.php';
?>

	<header id="header">
		<div id="nav1" style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.1);" class="bgColorHeader">
			<a href="index.php" class="logo" style="width: auto;"></a>
			<nav id="nav" style="background-color: rgba(0, 0, 0, 0.4);">
				<div class="Navbar">
					<img src="images/logo.png">

					<div class="Box_nav_events">
						<a href="index.php">
							<?php include 'menu.php'; ?>
						</a>
					</div>

					<div class="Box_nav_user">
						<?php include 'menu1.php'; ?>
					</div>
				</div>
			</nav>
		</div>
	</header>