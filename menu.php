<?php if (($_SESSION['droit'] == 1) && ($_GET["view"] != "admin")) { ?>
    <a href="backoffice.php">Gestion des événements</a>
<?php } else { ?>
    <?php $class = ($fichierPHP == "accueil.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_ACCUEIL'] == 1) {
        echo '<a class="' . $class . '" href="accueil.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Accueil</p></a>';
    } ?>
    <?php $class = ($fichierPHP == "actualites.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_ACTUALITES'] == 1) {
        echo '<a class="' . $class . '" href="actualites.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Actualités</p></a>';
    } ?>
    <?php $class = ($fichierPHP == "programme.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_PROGRAMME'] == 1) {
        echo '<a class="' . $class . '" href="programme.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Programme</p></a>';
    } ?>
    <?php $class = ($fichierPHP == "information.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_INFOSPRATIQUES'] == 1) {
        echo '<a class="' . $class . '" href="information.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Informations<br>pratiques</p></a>';
    } ?>
    <?php $class = ($fichierPHP == "mesures.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_HEBERGEMENT'] == 1) {
        echo '<a class="' . $class . '" href="mesures.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Mesures<br>sanitaires</p></a>';
    } ?>
    <?php $class = ($fichierPHP == "adresses.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_PRESSE'] == 1) {
        echo '<a class="' . $class . '" href="adresses.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Bonnes<br>adresses</p></a>';
    } ?>
    <?php $class = ($fichierPHP == "contactez-nous.php" ? 'menuHeaderU' : 'menuHeader');
    if ($dataGeneral['OPT_CONTACT'] == 1) {
        echo '<a class="' . $class . '" href="contactez-nous.php';
        if ($_GET["event"] != "") {
            echo "?event=" . $_GET["event"] . "&view=admin";
        }
        echo '"><p class="headerP">Contact</p></a>';
    } ?>
<?php } ?>