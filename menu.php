<?php if (($_SESSION['droit'] == 1) && ($_GET["view"] != "admin")) { ?>
    <a href="backoffice.php">Gestion des événements</a>
<?php } else { ?>
    <?php $class = ($fichierPHP == "accueil.php" ? 'active' : 'no_active');
    if ($dataGeneral['OPT_ACCUEIL'] == 1) {
        echo '<a class="' . $class . '" href="accueil.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><span class="'. $class .'">Accueil</span></a>';
    } ?>

<?php $class = ($fichierPHP == "programme.php" ? 'active' : 'no_active');
    if ($dataGeneral['OPT_PROGRAMME'] == 1) {
        echo '<a class=". $class ." href="programme.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><span class=" '. $class .' ">Programme</span></a>';
    } ?>

<?php 
$class = ($fichierPHP == "actualites.php" ? 'active' : 'no_active');
if ($dataGeneral['OPT_ACTUALITES'] == 1) {
     echo '<a class="' . $class . '" href="actualites.php';
    if ($_GET["event"] != "") {
        echo "?event=" . $_GET["event"] . "&view=admin";
    }
            echo '"><span class=" '. $class .' ">Documents</span></a>';
} 
?>
    <?php $class = ($fichierPHP == "information.php" ? 'active' : 'no_active');
    if ($dataGeneral['OPT_INFOSPRATIQUES'] == 1) {
        echo '<a class="' . $class . '" href="information.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><span class=" '. $class .' ">Galerie</span></a>';
    } ?>
    <?php $class = ($fichierPHP == "mesures.php" ? 'active' : 'no_active');
    if ($dataGeneral['OPT_HEBERGEMENT'] == 1) {
        echo '<a class="' . $class . '" href="mesures.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><span class=" '. $class .' ">Mesures<br>sanitaires</span></a>';
    } ?>
    <?php $class = ($fichierPHP == "adresses.php" ? 'active' : 'no_active');
    if ($dataGeneral['OPT_PRESSE'] == 1) {
        echo '<a class="' . $class . '" href="adresses.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><span class=" '. $class .' ">Plan d\'accés</span></a>';
    } ?>
    <?php $class = ($fichierPHP == "contactez-nous.php" ? 'active' : 'no_active');
    if ($dataGeneral['OPT_CONTACT'] == 1) {
        echo '<a class="' . $class . '" href="contactez-nous.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><span class=" '. $class .' ">Contact</span></a>';
    } ?>
<?php } ?>