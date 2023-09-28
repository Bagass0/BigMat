<?php
require_once './connect_societe.php';
?>

<header id="header">
  <div id="nav1" style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.1);" class="bgColorHeader">
    <a href="index.php" class="logo" style="width: auto;"></a>
    <nav id="nav" style="background-color: rgba(0, 0, 0, 0.4);">
      <div class="Navbar">
        <a href="index.php">
          <img src="images/logo.png" href="accueil.php">
        </a>  

        <div class="Box_nav_events">
          <?php include 'menu.php'; ?>
        </div>

        <div class="Box_nav_user">
          <?php include 'menu1.php'; ?>
        </div>

        <div class="bars_menu_burger">
          <i class="fas fa-bars fa-2xl" style="color: #fdfffc;  font-size: 30px;"></i>
			  </div>
        
      </div>
    </nav>
  </div> 
  <div class="menu-toggle">
      <div class="menu-toggle-active">
					<?php include 'menu1.php'; ?>
					<?php include 'menu.php' ; ?>
      </div>    
	</div>	 
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const barsMenuBurger = document.querySelector('.bars_menu_burger');
  const nav = document.querySelector('.menu-toggle');

  	barsMenuBurger.addEventListener('click', function() {
    nav.classList.toggle('menu-toggle-active');
  });
});
</script>
