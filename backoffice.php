<?php

include 'connect-backoffice.php';
require_once './class/User.php';
require_once './class/Event.php';

$usr = new User();
$evt = new Event();

$error = "";

$data1 = $usr->findOneById($_SESSION['id']);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])) {
    $nom = $fct->cleanXSS($_POST['nom']);
    if ($nom != '') {

        $data = $evt->add($nom, $data1["ID"]);

        echo "<style>#ajout{display:none;}</style>";

        $error = "L'événement a bien été ajouté.";
        $color = "#28a745";
        $valid = "0";

        $nom = "";
    } else {
        $error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
        $color = "#FF0000";
        $valid = "0";
        echo "<style>#ajout{display:block;} #add{display:none;}</style>";
        if ($nom == '') {
            echo "<style>#nom{border-color:#ff0000;}</style>";
        }
    }
} else {
    echo "<style>#ajout{display:none;}</style>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Gestion des événement - <?php echo $dataGeneral['NOM']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/flipclock.css">
    <link rel="icon" href="images/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <style>
        .fa,
        .fas {
            margin: 15px 10px;
        }

        tr {
            text-align: left;
        }

        .fa-envelope,
        .fa-industry,
        .fa-cog,
        .fa-trash {
            margin: 4px 10px !important;
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

    <section id="one" class="wrapper align-center" style="margin-top: 140px;">
        <div class="inner">

            <div class="row uniform">

                <div class="9u 12u$(small)" style="width: 100%">

                    <h2 id="content">Gestion des événements</h2>

                    <?php if (($error != "") && ($valid == "0")) { ?>
                        <div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                            <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                        </div>
                    <?php } ?>

                    <span class="button special" id="add" style="display:none;">Ajouter un événement</span>

                    <form method="post" action="backoffice.php" id="ajout">

                        <div class="row uniform">

                            <div class="12u$ 12u$(small) cacheajout">
                                <h4 style="width:100%; color:#9a9a9a;">Ajouter un événement</h4>
                            </div>

                        </div>

                        <div class="row uniform">

                            <div class="12u$ 12u$(xsmall) cacheajout">
                                <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" placeholder="Nom de l'événement">
                            </div>

                            <div class="6u 12u$(small) cacheajout">
                                <span class="button special" id="annuler">ANNULER</span>
                            </div>
                            <div class="6u 12u$(small) cacheajout">
                                <input type="submit" value="Valider" class="special" name="valider">
                            </div>

                        </div>

                    </form>

                    <hr>

                    <table style="margin-top:30px;">
                        <thead>
                            <tr>
                                <th style="width:200px;">Nom de l'événement</th>
                                <th class="mobile_no" style="width:140px;">Créé le</th>
                                <th class="mobile_no" style="width:140px;">Par</th>
                                <th class="mobile_no">Description</th>
                                <th class="mobile_no" style="width:140px;">Dates</th>
                                <th style="width: 175px; text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $datas = $evt->selectEvents();

                            foreach ($datas as $data) {

                                $data2 = $usr->findNomPrenom($data[3]);

                                $description = "";
                                if ($data[4] != "") {
                                    if (strlen($data[4]) > 100) {
                                        $description = substr($data[4], 0, 100) . '...';
                                    } else {
                                        $description = $data[4];
                                    }
                                }
                                $date = "";
                                if (($data[5] != "") && ($data[6] != "")) {
                                    $date_in = explode("-", $data[5]);
                                    $date_in = $date_in[2] . '/' . $date_in[1] . '/' . $date_in[0];
                                    $date_out = explode("-", $data[6]);
                                    $date_out = $date_out[2] . '/' . $date_out[1] . '/' . $date_out[0];
                                    $date = "Du " . $date_in . " au " . $date_out;
                                }
                                if (($data[5] != "") && ($data[6] == "")) {
                                    $date_in = explode("-", $data[5]);
                                    $date_in = $date_in[2] . '/' . $date_in[1] . '/' . $date_in[0];
                                    $date = $date_in;
                                }
                                if (($data[6] != "") && ($data[5] == "")) {
                                    $date_out = explode("-", $data[6]);
                                    $date_out = $date_out[2] . '/' . $date_out[1] . '/' . $date_out[0];
                                    $date = $date_out;
                                }
                                if (($data[7] == 1) || ($data[9] == 1) || ($data[10] == 1) || ($data[11] == 1) || ($data[13] == 1) || ($data[14] == 1)) {
                                    $view = 1;
                                } else {
                                    $view = 0;
                                }
                                echo '<tr><th style="color:#4CA79F;">' . $data[1] . '</th><th class="mobile_no">' . $data[2] . '</th><th class="mobile_no">' . $data2['PRENOM'] . ' ' . $data2['NOM'] . '</th><th class="mobile_no">' . $description . '</th><th class="mobile_no">' . $date . '</th><th style="text-align: right; width: 170px;">';
                                if ($view == 1) {
                                    echo '<a data-fancybox data-type="iframe" data-src="accueil.php?event=' . $data[0] . '&view=admin" href="javascript:;" style="text-decoration:none;" title="Voir le site"><i class="fas fa-eye"></i></a>';
                                }
                                if ($data[14] == 1) {
                                    echo '<a href="liste.php?event=' . $data[0] . '" style="text-decoration:none;" title="Gestion des participants"><i class="fas fa-address-book"></i></a>';
                                }

                                if ($data1['STATUT'] != 1) {
                                    echo '<a href="settings.php?event=' . $data[0] . '" style="text-decoration:none;" title="Paramètres"><i class="fas fa-cog"></i></a><a href="duplicate.php?event=' . $data[0] . '" style="text-decoration:none; display:none;" title="Copier"><i class="fas fa-clone"></i></a><a href="delete.php?event=' . $data[0] . '" class="confirm" style="text-decoration:none; display:none;" title="Supprimer"><i class="fas fa-trash"></i></a></th></tr>';
                                }
                            }
                            mysqli_free_result($req);
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </section>

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#add").click(function() {
                $("#ajout").css("display", "block");
                $("#add").css("display", "none");
            });

            $("#annuler").click(function() {
                $("#ajout").css("display", "none");
                $("#add").css("display", "inline-block");
                $("#messagein").css("display", "none");
                $("#nom").css("border-color", "#dbdbdb");
                $("#nom").val("");
            });

            $('.confirm').click(function(e) {
                e.preventDefault();
                if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cet événement ? Cette action est irréversible et toutes les données seront perdues !")) {
                    location.href = this.href;
                }
            });

        });
    </script>

</body>

</html>