<?php 

include 'connect-backoffice.php';

require_once './class/User.php';
require_once './class/Event.php';

$usr = new User();
$evt = new Event();

$event = $_GET["event"];
$error = "";

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])) {
    if ($_POST['form1'] == "form1") {
        $nom = $fct->cleanXSS($_POST['nom']);
        $date_in = $fct->cleanXSS($_POST['date_in']);
        $date_out = $fct->cleanXSS($_POST['date_out']);
        $description = $fct->cleanXSS($_POST['description']);
        if ($nom != '') {

            date_default_timezone_set('Europe/Paris');

            $data = $evt->updateEvent($nom, $description, $date_in, $date_out, $event);

            $error = "Les paramètres ont bien été mis à jour.";
            $color = "#28a745";
            $valid = "0";
        } else {
            $error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
            $color = "#FF0000";
            $valid = "0";
            if ($nom == '') {
                echo "<style>#nom{border-color:#ff0000;}</style>";
            }
        }
    }
    if ($_POST['form2'] == "form2") {

        $inscriptionok = 1;

        if (($_POST["settings_activites"] == 1) || ($_POST["settings_hebergement2"] == 1) || ($_POST["settings_transport"] == 1)) {
            if ($_POST["settings_inscription"] == 1) {
                $inscriptionok = 1;
            } else {
                $inscriptionok = 0;
            }
        }

        if ($inscriptionok != 0) {
            date_default_timezone_set('Europe/Paris');

            if ($_POST["settings_accueil"] != "") {
                $settings_accueil = $fct->cleanXSS($_POST["settings_accueil"]);
            } else {
                $settings_accueil = 0;
            }
            if ($_POST["settings_actualites"] != "") {
                $settings_actualites = $fct->cleanXSS($_POST["settings_actualites"]);
            } else {
                $settings_actualites = 0;
            }
            if ($_POST["settings_programme"] != "") {
                $settings_programme = $fct->cleanXSS($_POST["settings_programme"]);
            } else {
                $settings_programme = 0;
            }
            if ($_POST["settings_hebergement"] != "") {
                $settings_hebergement = $fct->cleanXSS($_POST["settings_hebergement"]);
            } else {
                $settings_hebergement = 0;
            }
            if ($_POST["settings_infospratiques"] != "") {
                $settings_infospratiques = $fct->cleanXSS($_POST["settings_infospratiques"]);
            } else {
                $settings_infospratiques = 0;
            }
            if ($_POST["settings_presse"] != "") {
                $settings_presse = $fct->cleanXSS($_POST["settings_presse"]);
            } else {
                $settings_presse = 0;
            }
            if ($_POST["settings_contact"] != "") {
                $settings_contact = $fct->cleanXSS($_POST["settings_contact"]);
            } else {
                $settings_contact = 0;
            }
            if ($_POST["settings_inscription"] != "") {
                $settings_inscription = $fct->cleanXSS($_POST["settings_inscription"]);
            } else {
                $settings_inscription = 0;
            }
            if ($_POST["settings_activites"] != "") {
                $settings_activites = $fct->cleanXSS($_POST["settings_activites"]);
            } else {
                $settings_activites = 0;
            }
            if ($_POST["settings_hebergement2"] != "") {
                $settings_hebergement2 = $fct->cleanXSS($_POST["settings_hebergement2"]);
            } else {
                $settings_hebergement2 = 0;
            }
            if ($_POST["settings_transport"] != "") {
                $settings_transport = $fct->cleanXSS($_POST["settings_transport"]);
            } else {
                $settings_transport = 0;
            }

            $data = $evt->updateOptions($settings_accueil, $settings_actualites, $settings_programme, $settings_hebergement, $settings_infospratiques, $settings_presse, $settings_contact, $settings_inscription, $settings_activites, $settings_hebergement2, $settings_transport, $event);

            $error = "Les paramètres ont bien été mis à jour.";
            $color = "#28a745";
            $valid = "0";
        } else {
            $error = "Attention, vous devez sélectionner la page inscription avant de choisir les options activités, hébergement, room et transport.";
            $color = "#FF0000";
            $valid = "0";
            echo "<style>.settings_inscription:before{border-color:#ff0000;}</style>";
        }
    }
}
$data = $evt->findOneById($event);
$data1 = $usr->findOneById($_SESSION['id']);


if ($data1['STATUT'] == 1) {
    header('Location: backoffice.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Paramètres - <?php echo $data['NOM'] ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/flipclock.css">
    <link rel="icon" href="images/favicon.ico" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <style>
        table table tr {
            background: #fff !important;
            border: 0;
        }

        table table {
            margin-top: 10px !important;
            margin-bottom: 0 !important;
        }

        table table tr td {
            padding: 0px 0px 2px 40px;
        }

        #date_in,
        #date_out {
            padding-left: 70px;
        }

        .date_debut_fin {
            position: absolute;
            margin-left: 1em;
            height: 45px;
            line-height: 45px;
            color: #bbb !important;
            opacity: 1.0;
        }

        @media screen and (min-width: 1681px) {

            #date_in,
            #date_out {
                padding-left: 90px;
            }

            .date_debut_fin {
                height: 52px;
                line-height: 52px;
            }

        }
    </style>
</head>

<body>

    <header id="header" style="height: fit-content; position: fixed;">
        <div id="nav1" style="box-shadow: 0 0.5em 0.7em -0.5em rgba(0, 0, 0, 0.5);" class="bgColorHeader">
            <a href="index.php" class="logo" style="width: auto;"></a>
            <nav id="nav">
                <div class="inner marginTop" style="max-width: 100%;">
                    <a style="border-right: none; padding: 0; margin: 0;" href="index.php"><img src="images/logo-header.jpg" style="width: 17em; margin: 1em" class="displayHeader2"></a>
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
                    <img src="images/logo-header.jpg" style="width: 17em; margin: 1em; display: none;" class="displayHeader">
                    <p style="margin: 0;"><mark style="background-color: #FFD400; color: #000; margin-left: 5.5em;" class="marginHeader">&nbsp;Voyage courtage national&nbsp;</mark></p>
                </a>
                <a href="#navPanel" class="navPanelToggle" style="border-right: none;"><span class="fa fa-bars" style="margin-right: 1em;"></span></a>
            </div>
        </div>
    </header>

    <section id="one" class="wrapper align-center" style="margin-top: 40px;">
        <div class="inner">

            <div class="row uniform">

                <div class="9u 12u$(small)" style="width: 100%">

                    <h2 id="content" style="color:#f99f1b;">Paramètres - <?php echo $data['NOM'] ?></h2>

                    <?php if (($error != "") && ($valid == "0")) { ?>
                        <div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                            <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                        </div>
                    <?php } ?>

                    <table style="margin-top:30px;">
                        <thead>
                            <tr>
                                <th>Paramètres</th>
                            </tr>
                        </thead>
                    </table>

                    <form method="post" action="settings.php?event=<?php echo $data['ID']; ?>" enctype="multipart/form-data">
                        <input type="hidden" id="form1" name="form1" class="form1" value="form1">
                        <div class="row uniform">
                            <div class="12u$ 12u$(xsmall)">
                                <input type="text" name="nom" id="nom" value="<?php echo $data['NOM']; ?>" placeholder="Titre de l'événement">
                            </div>
                            <div class="6u 12u$(xsmall)" style="text-align: left;"><span class="date_debut_fin">Début :</span>
                                <input type="date" name="date_in" id="date_in" value="<?php echo $data['DATE_IN']; ?>">
                            </div>
                            <div class="6u$ 12u$(xsmall)" style="text-align: left;"><span class="date_debut_fin">Fin :</span>
                                <input type="date" name="date_out" id="date_out" value="<?php echo $data['DATE_OUT']; ?>">
                            </div>
                            <div class="12u$">
                                <textarea name="description" id="description" placeholder="Description de l'événement" rows="6"><?php echo $data['DESCRIPTION']; ?></textarea>
                            </div>
                            <div class="12u$">
                                <ul class="actions" style="float:left;">
                                    <li><input type="submit" value="Valider les paramètres" class="special" name="valider"></li>
                                </ul>
                                <ul class="actions" style="float:right;">
                                    <li><a class="button special" href="backoffice.php">RETOUR</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="settings.php?event=<?php echo $data['ID']; ?>" enctype="multipart/form-data">
                        <input type="hidden" id="form2" name="form2" class="form2" value="form2">
                        <table style="margin-top:30px; margin-bottom: 1.5em;">
                            <thead>
                                <tr>
                                    <th>Contenu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input id="settings_accueil" name="settings_accueil" class="settings_accueil" type="checkbox" value="1" <?php if ($data["OPT_ACCUEIL"] == "1") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>><label for="settings_accueil" class="settings_accueil" style="margin-bottom: 0;">Page accueil</label>
                                        <?php if ($data['OPT_ACCUEIL'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-accueil.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="settings_actualites" name="settings_actualites" class="settings_actualites" type="checkbox" value="1" <?php if ($data["OPT_ACTUALITES"] == "1") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>><label for="settings_actualites" class="settings_actualites" style="margin-bottom: 0;">Page actualités</label>
                                        <?php if ($data['OPT_ACTUALITES'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-actualites.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="settings_programme" name="settings_programme" class="settings_programme" type="checkbox" value="1" <?php if ($data["OPT_PROGRAMME"] == "1") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>><label for="settings_programme" class="settings_programme" style="margin-bottom: 0;">Page programme</label>
                                        <?php if ($data['OPT_PROGRAMME'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-programme.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="settings_hebergement" name="settings_hebergement" class="settings_hebergement" type="checkbox" value="1" <?php if ($data["OPT_HEBERGEMENT"] == "1") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>><label for="settings_hebergement" class="settings_hebergement" style="margin-bottom: 0;">Page à propos</label>
                                        <?php if ($data['OPT_HEBERGEMENT'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-hebergement.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="settings_infospratiques" name="settings_infospratiques" class="settings_infospratiques" type="checkbox" value="1" <?php if ($data["OPT_INFOSPRATIQUES"] == "1") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?>><label for="settings_infospratiques" class="settings_infospratiques" style="margin-bottom: 0;">Page infos pratiques</label>
                                        <?php if ($data['OPT_INFOSPRATIQUES'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-information.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="settings_presse" name="settings_presse" class="settings_presse" type="checkbox" value="1" <?php if ($data["OPT_PRESSE"] == "1") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>><label for="settings_presse" class="settings_presse" style="margin-bottom: 0;">Page espace presse</label>
                                        <?php if ($data['OPT_PRESSE'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-espace-presse.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="settings_contact" name="settings_contact" class="settings_contact" type="checkbox" value="1" <?php if ($data["OPT_CONTACT"] == "1") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>><label for="settings_contact" class="settings_contact" style="margin-bottom: 0;">Page contactez-nous</label>
                                        <?php if ($data['OPT_CONTACT'] == 1) { ?><div style="float: right; height: 26px;"></div><?php echo'<a href="settings-contact.php?event='.$data['ID'].'" style="text-decoration:none; float: right;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td>
                                        <input id="settings_inscription" name="settings_inscription" class="settings_inscription" type="checkbox" value="1" <?php if ($data["OPT_INSCRIPTION"] == "1") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>><label for="settings_inscription" class="settings_inscription" style="margin-bottom: 0;">Page inscription</label>
                                        <?php if ($data['OPT_INSCRIPTION'] == 1) { ?><div style="float: right; height: 26px;"></div><?php } ?>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input id="settings_activites" name="settings_activites" class="settings_activites" type="checkbox" value="1" <?php if ($data["OPT_ACTIVITES"] == "1") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?>><label for="settings_activites" class="settings_activites" style="margin-bottom: 0;">Activités</label>
                                                    </td>
                                                    <?php if ($data['OPT_ACTIVITES'] == 1) { ?><td style="text-align: right;">

                                                        </td><?php } ?>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input id="settings_hebergement2" name="settings_hebergement2" class="settings_hebergement2" type="checkbox" value="1" <?php if ($data["OPT_HEBERGEMENT2"] == "1") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>><label for="settings_hebergement2" class="settings_hebergement2" style="margin-bottom: 0;">Hébergement</label>
                                                    </td>
                                                    <?php if ($data['OPT_HEBERGEMENT2'] == 1) { ?><td style="text-align: right;">

                                                        </td><?php } ?>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input id="settings_transport" name="settings_transport" class="settings_transport" type="checkbox" value="1" <?php if ($data["OPT_TRANSPORT"] == "1") {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?>><label for="settings_transport" class="settings_transport" style="margin-bottom: 0;">Transport</label>
                                                    </td>
                                                    <?php if ($data['OPT_TRANSPORT'] == 1) { ?><td style="text-align: right;">

                                                        </td><?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="12u$">
                            <ul class="actions" style="float:left;">
                                <li><input type="submit" value="Valider le contenu" class="special" name="valider"></li>
                            </ul>
                            <ul class="actions" style="float:right;">
                                <li><a class="button special" href="backoffice.php">RETOUR</a></li>
                            </ul>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </section>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>

</body>

</html>