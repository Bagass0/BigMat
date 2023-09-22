<?php

require_once __DIR__ . '/class/Societe.php';

$entreprise = new Societe();

$isValid = $entreprise->isValidById($data['SOCIETE_ID']);


if (($data["FIRST_CO"] == 1) || ($data1["FIRST_CO"] == 1) or $data1['GROUPE'] === 'ADMIN' || $data['GROUPE'] === 'ADMIN') {

    if (($_SESSION['droit'] == 1) && ($_GET["idColaborateur"] != "")) { ?>
        <a href="profil.php"> <span id="welcome"><?php echo $data1['PRENOM'] . " " . $data1['NOM'] ?></span></a>
        <a href="deconnexion.php"> <span id="welcome">Déconnexion</span></a>    
    <?php } elseif ($_SESSION['id'] !== null) { ?>
        <?php if (($_GET["view"] != "") || ($_SESSION['droit'] != 1) && ($isValid[0] == 1)) {
        } 
        
        if ($_GET["event"] == "") {
            if ($_GET["idColaborateur"] == "") {
                if ($_SESSION['droit'] == 1) {
                    echo '<a href="profil.php" style="border-right: none;"><span id="welcome" class="headerAlign">' . $data1['PRENOM'] . " " . $data1['NOM'] . '</span></a>';
                } else {
                    echo '<a href="profil.php" style="border-right: none;"><span id="welcome" class="headerAlign">' . $data['PRENOM'] . " " . $data['NOM'] . '</span></a>';
                }
            } else {
                echo '<a href="profil.php" style="border-right: none;"><span id="welcome" class="headerAlign">' . $data1['PRENOM'] . " " . $data1['NOM'] . '</span></a>';
            }
        } else {
            if ($_GET["view"] == "admin") {
                echo '<a style="border-right: none;"><span id="welcome" class="headerAlign">Prénom NOM</span></a>';
            } else {
                echo '<a href="profil.php" style="border-right: none;"><span id="welcome" class="headerAlign">' . $data1['PRENOM'] . " " . $data1['NOM'] . '</span></a>';
            }
        }
        ?>
        <?php if ($_GET["event"] == "") {
            echo '<a href="deconnexion.php" id="" style="border-right: none;"><span id="welcome" class="headerAlign">Déconnexion</span></a>';
        } else {
            echo '<a href="./deconnexion.php" id="" style="border-right: none;"><span id="welcome" class="headerAlign">Déconnexion</span></a>';
        } ?>
    <?php } else { ?>

        <a href="profil.php" id="" style="border-right: none;"><span id="welcome" class="headerAlign">Inscrivez-vous</span></a>

    <?php }
} else {


    ?>


    <a href="profil.php" id="" style="border-right: none;"><span id="welcome" class="headerAlign">Inscrivez-vous</span></a>

<?php } ?>