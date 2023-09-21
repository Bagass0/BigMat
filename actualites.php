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
    <title>Documents - <?php echo $dataGeneral['NOM']; ?></title>
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

<body class="body_accueil">
    <?php include 'header.php' ?>

    <div id="Container_docs">
        <div id="ContainerTitre">
            <h1>Documents</h1>
        </div>
        <div id="ContainerDownload">
            <div id="DOC_1">
                <a href='documents/doc1.pdf' download>
                    <i class="fas fa-download" style="color: #9d969d;"></i>Document 1
                </a>
            </div>  
            <div id="DOC_2">  
                <a href='documents/doc2.pdf' download>
                    <i class="fas fa-download" style="color: #9d969d;"></i>Document 2
                </a>
            </div>    
        </div>    
    </div>    

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

    <?php include 'footer.php' ?>    
</body>

</html>