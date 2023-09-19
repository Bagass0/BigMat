<?php include 'connect_accueil.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

$fichierPHP = basename(__FILE__);

$NB_BLOCS = $dataEvt['NB_BLOCS'];
$NB_SLIDES = $dataEvt['NB_SLIDES'];

if ($_GET["event"] != "") {
    $eventurl = "?event=" . $_GET['groupe'];
}

if ($dataGeneral["OPT_ACCUEIL"] != 1) {
    if ($dataGeneral["OPT_ACTUALITES"] != 1) {
        if ($dataGeneral["OPT_INSCRIPTION"] != 1) {
            if ($dataGeneral["OPT_PROGRAMME"] != 1) {
                if ($dataGeneral["OPT_HEBERGEMENT"] != 1) {
                    if ($dataGeneral["OPT_INFOSPRATIQUES"] != 1) {
                        if ($dataGeneral["OPT_PRESSE"] != 1) {
                            if ($dataGeneral["OPT_CONTACT"] != 1) {
                            } else {
                                header("Location: contactez-nous.php$eventurl");
                            }
                        } else {
                            header("Location: espace-presse.php$eventurl");
                        }
                    } else {
                        header("Location: information.php$eventurl");
                    }
                } else {
                    header("Location: hebergement.php$eventurl");
                }
            } else {
                header("Location: programme.php$eventurl");
            }
        } else {
            header("Location: inscription.php$eventurl");
        }
    } else {
        header("Location: actualites.php$eventurl");
    }
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Accueil - <?php echo $dataGeneral['NOM']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/flipclock.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets/css/gallery.theme.css">
    <link rel="stylesheet" href="assets/css/gallery.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <style>
        .container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
        }

        .video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <?php include 'header.php' ?>

    <section id="one" class="wrapper align-left bgAccueil" style="padding-top: 5em; margin: -0.6em 0 0 0 !important; max-width: 100%">

        <div class="inner marginAcceuil" style="width: 30em; margin: 0 12em 0 12em;">

            <div>
                <div style="display: block" style="margin: 1em">
                    <div style="display: flex; margin-bottom: 1em;">
                        <img src="images/imgEdito.png" style="margin-right: 3em; width: 9em; height: 7.7em;" class="">
                        <h3 style="font-size: 32px; font-weight: 700; text-align: left; align-self: flex-end;">Édito</h3>
                    </div>
                    <p class="sourceSansPro">
                        Cher Partenaire,<br>
                        <br>
                        Grâce à votre travail et votre fidélité, vous faites partie des lauréats de notre séminaire national.<br>
                        Bravo pour cette belle performance et recevez nos félicitations et nos sincères remerciements pour votre confiance.<br>
                        L’équipe d’Abeille&nbsp;Assurances sera mobilisée pour vous faire vivre la véritable Écosse à travers des moments d’échanges professionnels enrichissants et de rencontres qui rendront votre séjour convivial et chaleureux.<br>
                        Je suis très heureux de pouvoir vous retrouver ou vous rencontrer pour partager les valeurs et l’histoire riche de l’Écosse.<br>
                        <br>
                        Bien cordialement.<br>
                        <br>
                        Renaud Célié<br>
                        Directeur Général Délégué<br>
                        Développement, Service aux clients, Transformation Digitale & IT<br>
                        <br>
                        <br>
                        <b>Nous vous remercions de valider votre participation et de télécharger tous les documents demandés avant le 15/05/23</b>
                    </p>
                    <br>
                    <p style="text-align:center;">
                        <button class="buttonAccueil" onclick="location.href='profil.php';">Inscription</button>
                    </p><br>
                </div>
            </div>
        </div>
    </section>

    <section id="ten" class="wrapper align-center bloclock" style="max-width: 100%; border-top: solid;">

        <div class="inner">

            <div class="clock"></div>

            <h1 class="clockTitre">
                Avant la clôture des inscriptions
            </h1>

        </div>

    </section>

    <?php include 'footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/flipclock.min.js"></script>
    <script type="text/javascript">
        var clock;

        $(document).ready(function() {

            var currentDate = new Date();
            var futureDate = new Date(2023, 04, 15);

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