<?php

require_once './connect_societe.php';
require_once './class/User.php';

$checkNav = true;

$ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
    $checkNav = false;
}

$usr = new User();
$redirect = 0;

if ($_GET["event"] == "") {
    $event = $_SESSION["event"];
} else {
    $event = $_GET["event"];
}

$eventurl = "?event=\".$event";

$errors = [];


if ($_SESSION['droit'] != 1) {
    $id = $_SESSION['id'];
} else {
    if ($_GET['idColaborateur'] == "") {
        $id = $_SESSION['id'];
    } else {
        $id = $_GET["idColaborateur"];
    }
}

$data = $usr->findOneById($id);
$data1 = $usr->findOneById($_SESSION['id']);

$save = "Non";
$dataProfil = $usr->selectInfosProfil($id);
$InfosProfil = $dataProfil[0];
$participation = $InfosProfil[0];
$carteIdentite = ($InfosProfil[2] != "" ? "vous avez déjà téléchargé votre votre passeport" : "");
$photoProfil = ($InfosProfil[1] != "" ? "vous avez déjà téléchargé votre photo" : "");
$carteIdentiteAcc = ($InfosProfil[4] != "" ? "vous avez déjà téléchargé votre votre passeport" : "");
$photoProfilAcc = ($InfosProfil[3] != "" ? "vous avez déjà téléchargé votre photo" : "");

$filenameTrombi = "trombinoscope/" . $InfosProfil[1];
$filenameTrombiAcc = "trombinoscope/" . $InfosProfil[4];
$filenameCni = "pdf/" . $InfosProfil[2];
$filenameCniAcc = "pdf/" . $InfosProfil[3];

$filesizeTrombi = filesize($filenameTrombi);
$filesizeTrombiAcc = filesize($filenameTrombiAcc);
$filesizeCni = filesize($filenameCni);
$filesizeCniAcc = filesize($filenameCniAcc);

$formattedSizeTrombi = $fct->formatSizeUnits($filesizeTrombi);
$formattedSizeTrombiAcc = $fct->formatSizeUnits($filesizeTrombiAcc);
$formattedSizeCni = $fct->formatSizeUnits($filesizeCni);
$formattedSizeCniAcc = $fct->formatSizeUnits($filesizeCniAcc);

if ($participation == 1 && $_SESSION['droit'] == 0) {
    $readonly = "readonly";
    $disable = "disabled";
    $disable2 = "disabled";
    $checkbox = 'onclick="return false;"';
    $trombi = '';
    $passport = '';
    $trombiAcc = '';
    $passportAcc = '';
} else if ($participation == 1 && $_SESSION['droit'] == 1) {
    $readonly = "";
    $disable = "";
    $disable2 = "disabled";
    $checkbox = '';
    $trombi = 'onclick="document.getElementById(\'uploadTrombi\').click()"';
    $passport = 'onclick="document.getElementById(\'sortpicture\').click()"';
    $trombiAcc = 'onclick="document.getElementById(\'uploadTrombiAcc\').click()"';
    $passportAcc = 'onclick="document.getElementById(\'sortpictureAcc\').click()"';
} else {
    $readonly = "";
    $disable = "";
    $disable2 = "";
    $checkbox = '';
    $trombi = 'onclick="document.getElementById(\'uploadTrombi\').click()"';
    $passport = 'onclick="document.getElementById(\'sortpicture\').click()"';
    $trombiAcc = 'onclick="document.getElementById(\'uploadTrombiAcc\').click()"';
    $passportAcc = 'onclick="document.getElementById(\'sortpictureAcc\').click()"';
}

$redirect = 2;
$societe_infos = $societe->findOneById($_SESSION['societe_id']);
$dataGeneral = $evt->findOneById($event);

if ($_SESSION['event'] == "ADMIN") {

    $societe_infos = $societe->findOneById($data['SOCIETE_ID']);
}

if ($_GET['form'] == "Ok") {

    $color = "#093";
    array_push($errors, "Merci " . $data['PRENOM'] . " " . $data['NOM'] . ", vos informations ont bien été validées.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $fct->cleanXSS($_POST['nom']);
    $civilite = $fct->cleanXSS($_POST['civilite']);
    $prenom = $fct->cleanXSS($_POST['prenom']);
    $agence = $fct->cleanXSS($_POST['agence']);
    $mail = $fct->cleanXSS($_POST['mail']);
    $tel = $fct->cleanXSS($_POST['tel']);
    $dateNaiss = $fct->cleanXSS($_POST['dateNaiss']);
    $lieuNaiss = $fct->cleanXSS($_POST['lieuNaiss']);
    $nationalite = $fct->cleanXSS($_POST['nationalite']);
    $numPassport = $fct->cleanXSS($_POST['numPassport']);
    $dateEmission = $fct->cleanXSS($_POST['dateEmission']);
    $lieuEmission = $fct->cleanXSS($_POST['lieuEmission']);
    $dateExpiration = $fct->cleanXSS($_POST['dateExpiration']);
    $typeChambre = $fct->cleanXSS($_POST['typeChambre']);
    $remarques = $fct->cleanXSS($_POST['remarques']);
    $remarquesAli = $fct->cleanXSS($_POST['remarquesAli']);
    $civiliteAcc = $fct->cleanXSS($_POST['civiliteAcc']);
    $nomAcc = $fct->cleanXSS($_POST['nomAcc']);
    $prenomAcc = $fct->cleanXSS($_POST['prenomAcc']);
    $mailAcc = $fct->cleanXSS($_POST['mailAcc']);
    $telAcc = $fct->cleanXSS($_POST['telAcc']);
    $dateNaissAcc = $fct->cleanXSS($_POST['dateNaissAcc']);
    $lieuNaissAcc = $fct->cleanXSS($_POST['lieuNaissAcc']);
    $nationaliteAcc = $fct->cleanXSS($_POST['nationaliteAcc']);
    $numPassportAcc = $fct->cleanXSS($_POST['numPassportAcc']);
    $dateEmissionAcc = $fct->cleanXSS($_POST['dateEmissionAcc']);
    $lieuEmissionAcc = $fct->cleanXSS($_POST['lieuEmissionAcc']);
    $dateExpirationAcc = $fct->cleanXSS($_POST['dateExpirationAcc']);
    $remarquesAcc = $fct->cleanXSS($_POST['remarquesAcc']);
    $remarquesAliAcc = $fct->cleanXSS($_POST['remarquesAliAcc']);
    $conditions = $fct->cleanXSS($_POST['conditions']);
    $conditionsAcc = $fct->cleanXSS($_POST['conditionsAcc']);
    $remarquesRegime = $fct->cleanXSS($_POST['remarquesRegime']);
    $remarques = $fct->cleanXSS($_POST['remarques']);
    $participeEve = $fct->cleanXSS($_POST['participeEve']);
    $participeDej = $fct->cleanXSS($_POST['participeDej']);
    $confirmeReservation = $fct->cleanXSS($_POST['confirmeReservation']);
    $régimeAlimentaire = $fct->cleanXSS($_POST['régimeAlimentaire']);
    $modalitésdinscription = $fct->cleanXSS($_POST['modalitésdinscription ']);




    if ($_POST['form'] == "profile") {

        if (isset($_POST['btnSauvegarder'])) {

            $validation = "0";
        } else if (isset($_POST['btnValider'])) {

            $validation = "1";
        } else {

            $color = "#FF0000";
            array_push($errors, "Une erreur est survenue, veuillez réessayer ultérieurement. Merci.");
        }

        if ($checkNav == false) {

            $color = "#FF0000";
            array_push($errors, "Vous ne pouvez pas enregistrer les modifications, la version de votre navigateur est obsolète, veuillez choisir un navigateur plus récent.");
        } else {

            if ($_POST['mail'] == "") {

                echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';

                $color = "#FF0000";
                array_push($errors, "Une adresse email doit être inscrite !");
            }

            if ($validation == "1") {

                if (($civilite == "") or ($nom == "") or ($prenom == "") or ($agence == "") or ($tel == "") or ($dateNaiss == "") or ($lieuNaiss == "") or ($nationalite == "") or ($numPassport == "") or ($dateEmission == "") or ($lieuEmission == "") or ($dateExpiration == "") or($remarquesRegime=="") or ($remarques =="") or ($participeEve== "") or ($participeDej=="") or ($confirmeReservation=="") or ( $régimeAlimentaire=="") or ($modalitésdinscription=="" )) {

                    $iserror = 1;

                    if ($civilite == "") {
                        echo '<style>input[name="civilite"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($nom == "") {
                        echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($prenom == "") {
                        echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($agence == "") {
                        echo '<style>input[name="agence"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($tel == "") {
                        echo '<style>input[name="tel"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($dateNaiss == "") {
                        echo '<style>input[name="dateNaiss"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($lieuNaiss == "") {
                        echo '<style>input[name="lieuNaiss"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($nationalite == "") {
                        echo '<style>input[name="nationalite"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($numPassport == "") {
                        echo '<style>input[name="numPassport"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($dateEmission == "") {
                        echo '<style>input[name="dateEmission"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($lieuEmission == "") {
                        echo '<style>input[name="lieuEmission"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($dateExpiration == "") {
                        echo '<style>input[name="dateExpiration"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($remarquesRegime == "") {
                        echo '<style>input[name="remarquesRegime"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($remarques== "") {
                        echo '<style>input[name="remarques"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    
                    if ($participeEve== "") {
                        echo '<style>input[name="participeEve"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($participeDej== "") {
                        echo '<style>input[name="participeDej"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($confirmeReservation == "") {
                        echo '<style>input[name="confirmeReservation"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($régimeAlimentaire == "") {
                        echo '<style>input[name="régimeAlimentaire"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($modalitésdinscription == "") {
                        echo '<style>input[name="modalitésdinscription"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                }

                if (($data['SINGLE'] == "Non") and (($typeChambre == "") or ($civiliteAcc == "") or ($nomAcc == "") or ($prenomAcc == "") or ($mailAcc == "") or ($telAcc == "") or ($dateNaissAcc == "") or ($lieuNaissAcc == "") or ($nationaliteAcc == "") or ($numPassportAcc == "") or ($dateEmissionAcc == "") or ($lieuEmissionAcc == "") or ($dateExpirationAcc == ""))) {

                    $iserror = 1;
                    
                    if ($typeChambre == "") {
                        echo '<style>input[name="typeChambre"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($civiliteAcc == "") {
                        echo '<style>input[name="civiliteAcc"] + label:before  {border-color: #FF0000 !important;}</style>';
                    }
                    if ($nomAcc == "") {
                        echo '<style>input[name="nomAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($prenomAcc == "") {
                        echo '<style>input[name="prenomAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($mailAcc == "") {
                        echo '<style>input[name="mailAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($telAcc == "") {
                        echo '<style>input[name="telAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($dateNaissAcc == "") {
                        echo '<style>input[name="dateNaissAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($lieuNaissAcc == "") {
                        echo '<style>input[name="lieuNaissAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($nationaliteAcc == "") {
                        echo '<style>input[name="nationaliteAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($numPassportAcc == "") {
                        echo '<style>input[name="numPassportAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($dateEmissionAcc == "") {
                        echo '<style>input[name="dateEmissionAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($lieuEmissionAcc == "") {
                        echo '<style>input[name="lieuEmissionAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                    if ($dateExpirationAcc == "") {
                        echo '<style>input[name="dateExpirationAcc"] {border-color: #FF0000 !important;}</style>';
                    }
                }

                if (($data['UPLOAD_PHOTO'] == "" || $data['UPLOAD_PHOTO'] === NULL)) {
                    $iserror = 1;
                    $color = "#FF6767";
                    array_push($errors, "Vous devez télécharger votre photo !");
                    echo '<style>label[name="divFil-trombi"] {text-decoration: underline 2px red; !important;}</style>';
                }

                if (($data['UPLOAD_PASSPORT'] == "" || $data['UPLOAD_PASSPORT'] === NULL)) {
                    $iserror = 1;
                    $color = "#FF6767";
                    array_push($errors, "Vous devez télécharger votre passport ou CNI !");
                    echo '<style>label[name="divFil-identite"] {text-decoration: underline 2px red; !important;}</style>';
                }

                if (($data['SINGLE'] == "Non") and ($data['UPLOAD_PHOTO_ACC'] == "" || $data['UPLOAD_PHOTO_ACC'] === NULL)) {
                    $iserror = 1;
                    $color = "#FF6767";
                    array_push($errors, "Vous devez télécharger la photo de votre accompagnant !");
                    echo '<style>label[name="divFil-trombi-acc"] {text-decoration: underline 2px red;!important;}</style>';
                }

                if (($data['SINGLE'] == "Non") and ($data['UPLOAD_PASSPORT_ACC'] == "" || $data['UPLOAD_PASSPORT_ACC'] === NULL)) {
                    $iserror = 1;
                    $color = "#FF6767";
                    array_push($errors, "Vous devez télécharger le passport ou CNI de votre accompagnant !");
                    echo '<style>label[name="divFil-identite-acc"] {text-decoration: underline 2px red;!important;}</style>';
                }

                if ($iserror == 1) {
                    $color = "#FF0000";
                    array_push($errors, "Tous les champs obligatoires n'ont pas été remplis !<br>Pour valider l'inscription vous devez tous les compléter.");
                }
            }

            $checkMail = $usr->selectMailDoublon($id, $mail);

            $checkMailProfil = $checkMail[0];

            if ($checkMailProfil[0] !== NULL) {
                $color = "#FF0000";
                array_push($errors, "Cet adresse mail est déjà utilisé par un autre utilisateur.");
                echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';
            }

            if (sizeof($errors) == 0) {

                $accompagnement = 0;

                if ($data['SINGLE'] == "Oui") {
                    $typeChambre = "Single";
                }

                $usr->updateUserById3($id, $validation, $civilite, $nom, $prenom, $agence, $mail, $tel, $dateNaiss, $lieuNaiss, $nationalite, $numPassport, $dateEmission, $lieuEmission, $dateExpiration, $typeChambre, $remarques, $remarquesAli, $civiliteAcc, $nomAcc, $prenomAcc, $mailAcc, $telAcc, $dateNaissAcc, $lieuNaissAcc, $nationaliteAcc, $numPassportAcc, $dateEmissionAcc, $lieuEmissionAcc, $dateExpirationAcc, $remarquesAcc, $remarquesAliAcc, $accompagnement, $conditions, $conditionsAcc,
                $remarquesRegime,$remarques, $participeEve,$participeDej, $confirmeReservation, $régimeAlimentaire,$modalitésdinscription);

                if ($validation == "1") {
                    include('checkMail.php');
                }

                $color = "#093";
                array_push($errors, "Merci " . $prenom . " " . $nom . ", vos informations ont bien été sauvegardées.");

                if ($validation == "1") {
                    header("Refresh:0; url=profil.php?form=Ok");
                }
            }

            $data['CIVILITE'] = $civilite;
            $data['NOM'] = $nom;
            $data['PRENOM'] = $prenom;
            $data['AGENCE'] = $agence;
            $data['EMAIL'] = $mail;
            $data['TEL'] = $tel;
            $data['DATE_NAISS'] = $dateNaiss;
            $data['LIEU_NAISS'] = $lieuNaiss;
            $data['NATIONALITE'] = $nationalite;
            $data['NUM_PASSPORT'] = $numPassport;
            $data['DATE_EMISSION'] = $dateEmission;
            $data['LIEU_EMISSION'] = $lieuEmission;
            $data['DATE_EXPIRATION'] = $dateExpiration;
            $data['TYPE_CHAMBRE'] = $typeChambre;
            $data['REMARQUES'] = $remarques;
            $data['REMARQUES_ALI'] = $remarquesAli;
            $data['CIVILITE_ACC'] = $civiliteAcc;
            $data['NOM_ACC'] = $nomAcc;
            $data['PRENOM_ACC'] = $prenomAcc;
            $data['MAIL_ACC'] = $mailAcc;
            $data['TEL_ACC'] = $telAcc;
            $data['DATE_NAISS_ACC'] = $dateNaissAcc;
            $data['LIEU_NAISS_ACC'] = $lieuNaissAcc;
            $data['NATIONALITE_ACC'] = $nationaliteAcc;
            $data['NUM_PASSPORT_ACC'] = $numPassportAcc;
            $data['DATE_EMISSION_ACC'] = $dateEmissionAcc;
            $data['LIEU_EMISSION_ACC'] = $lieuEmissionAcc;
            $data['DATE_EXPIRATION_ACC'] = $dateExpirationAcc;
            $data['REMARQUES_ACC'] = $remarquesAcc;
            $data['REMARQUES_ALI_ACC'] = $remarquesAliAcc;
            $data['CONDITIONS'] = $conditions;
            $data['CONDITIONS_ACC'] = $conditionsAcc;
            $data['REMARQUEREGIME'] = $remarquesRegime;
            $data['REMARQUES'] = $remarques;
            $data['PARTICIPEEVE'] = $participeEve;
            $data['PARTICIPEDEJ'] = $participeDej;
            $data['CONFIRMERESERVATION'] = $confirmeReservation;
            $data['REGIMEALIMENTAIRE'] = $régimeAlimentaire;
            $data['MODALITÉSDINSCRIPTION'] = $modalitésdinscription; 
        }
    }
}
?>


<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>Inscription - <?php echo $dataGeneral['NOM']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/flipclock.css">
    <link rel="icon" href="images/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets/css/gallery.theme.css">
    <link rel="stylesheet" href="assets/css/gallery.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
</head>

<body class="bgPages">

    <?php include 'header.php' ?>

    <section id="one" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 0 !important">

        <div class="inner">

            <?php if ($checkNav == false) : ?>
                <div class="box" style="border-color:#FF0000;">
                    <p style="color:#FF0000; text-align:center;">
                        La version de votre navigateur est obsolète, veuillez choisir un navigateur plus récent.
                    </p>
                </div>
            <?php endif; ?>

            <?php if (sizeof($errors) > 0) : ?>
                <div class="box" style="border-color:<?php echo $color; ?>;">
                    <p style="color:<?php echo $color; ?>;">
                        <?php
                        foreach ($errors as $error) :
                        ?><?= $error ?>
                        <br />
                    <?php endforeach;
                        $errors = [];
                    ?>
                    </p>
                </div>
            <?php endif; ?>

            <div class="row uniform" style="margin-right: 2em; float: right;">
                <div class="12u$">
                    <ul class="actions" style="text-align: center; display: flex;"><br>
                        <?php if ($_SESSION['droit'] == 1) { ?>
                            <li><a href="liste.php?event=<?php echo $_GET['event']; ?>" class="button special" style="margin-top: 1em;padding: 0 2em;font-size: 11px;">Retour</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <form method="post" action="profil.php<?php if ($_GET["idColaborateur"] != "") {
                                                        if ($_SESSION['droit'] == 1) {
                                                            echo "?idColaborateur=" . $_GET["idColaborateur"] . "&event=" . $_GET["event"];
                                                        } else {
                                                            echo "?idColaborateur=" . $_GET["idColaborateur"];
                                                        }
                                                    } ?>">
                <div class="row uniform"  >
                    <div class="12u$ 12u$(xsmall) inscription" style="display: flex; justify-content:center; align-items:center; margin-bottom: 3em;">
                        <h1  style="font-size: 30pt; color: grey;  font-weight: 500; width: 11em; text-align:center; margin-top: 1px;">Inscription</h1>
                    </div>

                    <div class="12u$ 12u$(xsmall)" style="display: flex; margin-bottom: 3em;">
                        <h3 style="font-size: 20pt; font-weight: 700; width: 11em; text-align:left; margin-right: 1em; align-self: center; margin: 0;">Identité</h3>
                    </div>

                    <div class="2u 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em;">
                        <input <?php echo ($disable) ?> type="radio" name="civilite" id="mr" value="Mr" <?php if ($data['CIVILITE'] == "Mr") {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                        <label class="labelProfil" for="mr">Mr*</label>
                    </div>
                    <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em;">
                        <input <?php echo ($disable) ?> type="radio" name="civilite" id="mme" value="Mme" <?php if ($data['CIVILITE'] == "Mme") {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                        <label class="labelProfil" for="mme">Mme*</label>
                    </div>


                    <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="nom" style="width: 4em;" class="labelProfil"></label>
                        <input placeholder="Nom*"  style="width: calc(100% - 4em);" <?php echo ($readonly) ?> type="text" name="nom" class="inputProfil" id="nom" value="<?= $data['NOM'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="prenom" style="width: 6em;" class="labelProfil"></label>
                        <input placeholder="Prénom* " style="width: calc(100% - 0em);" <?php echo ($readonly) ?> type="text" name="prenom" class="inputProfil" id="prenom" value="<?= $data['PRENOM'] ?>">
                    </div>

                    <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="mail" style="width: 4em;" class="labelProfil"></label>
                        <input placeholder="Email*" style="width: calc(100% - 4em);" <?php echo ($readonly) ?> type="email" name="mail" class="inputProfil" id="mail" value="<?= $data['EMAIL'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="tel" style="width: 12em;" class="labelProfil"> </label>
                        <input placeholder="Numéro de Portable* " style="width: calc(100% - 0em);" <?php echo ($readonly) ?> type="tel" name="tel" class="inputProfil" id="tel" value="<?= $data['TEL'] ?>">
                    </div>
                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%;">
                        <label for="agence" style="width: 13em;" class="labelProfil"></label>
                        <input   placeholder="Entreprise*" style="width: calc(100% - 0em);" <?php echo ($readonly) ?> type="text" name="agence" class="inputProfil" id="agence" value="<?= $data['AGENCE'] ?>">
                    </div>


                     <!-- il y a un bug sur les radios -->   
                    <!--first radio  continuer à faire des modifications -->                                                                                               
                    <div class="2u 12u$(xsmall) divProfil" style="width: calc(100% - 6em); ">   
                        <div for="conditions" class="conditions labelProfil" style="width: auto;">
                            <h5 style="align-self: end; width: auto; width: calc(100% - 6em);margin: 0; color:grey; font-weight: 500 !important; font-size:16px; font-family: 'Source Sans Pro',sans-serif !important;">Je participe à l'évenement AG et séminaire des dirigeants de Septembre 2022.</h5><br>
                        </div>
                      
                        <div class="2u 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; display: inline-block; ">
                            <input <?php echo ($disable) ?> type="radio" name="participeEve" id="oui" value="Oui" <?php if ($data['PARTICIPEEVE'] == "Oui") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="labelProfil" for="oui">Oui*</label>
                        </div>
                        <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; display: inline-block;">
                            <input <?php echo ($disable) ?> type="radio" name="participeEve" id="non" value="Non" <?php if ($data['PARTICIPEEVE'] == "Non") {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="labelProfil" for="non">Non*</label>
                        </div>
                    </div> <br>
                    <!--second radio  continuer à faire des modifications-->  

                    <div class="2u 12u$(xsmall) divProfil" style="width: calc(100% - 6em);">   
                        <div for="conditions" class="conditions labelProfil" style="width: auto;">
                            <h5 style="align-self: end; width: auto; width: calc(100% - 6em);margin: 0; color:grey;  font-weight: 500 !important; font-size:16px; font-family: 'Source Sans Pro',sans-serif !important;">Je participe au déjeuner di jeudi 22 Septembre 2022.</h5><br>
                        </div>

                        <div class="2u 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; display: inline-block;">
                            <input <?php echo ($disable) ?> type="radio" name="participeDej" id="Oui" value="Oui" <?php if ($data['PARTICIEDEJ'] == "Oui") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="labelProfil" for="Oui">Oui*</label>
                        </div>
                        <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; display: inline-block;">
                            <input <?php echo ($disable) ?> type="radio" name="participeDej" id="Non" value="Non" <?php if ($data['PARTICIPEDEJ'] == "Non") {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="labelProfil" for="Non">Non*</label>
                        </div>
                    </div> <br>

                 <!--third radio  continuer à faire des modifications-->  

                 <div class="2u 12u$(xsmall) divProfil" style="width: calc(100% - 6em);">   
                        <div for="conditions" class="conditions labelProfil" style="width: auto;">
                            <h5 style="align-self: end; width: auto; width: calc(100% - 6em);margin: 0; color:grey;  font-weight: 500 !important; font-size:16px; font-family: 'Source Sans Pro',sans-serif !important;">Je confirme ma réservation de chambre pour les nuits du Jeudi 22 et du Vendredi 23 Septembre 2022. </h5><br>
                        </div>

                        <div class="2u 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; display: inline-block;">
                            <input <?php echo ($disable) ?> type="radio" name="confirmeReservation" id="oUi" value="Oui" <?php if ($data['CONFIRMERESERVATION'] == "Oui") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="labelProfil" for="oUi">Oui*</label>
                        </div>
                        <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; display: inline-block;">
                            <input <?php echo ($disable) ?> type="radio" name="confirmeReservation" id="nOn" value="Non" <?php if ($data['CONFIRMERESERVATION'] == "Non") {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="labelProfil" for="nOn">Non*</label>
                        </div>
                    </div> <br>


                     <!--fourth radio  continuer à faire des modifications-->  

                 <div class="2u 12u$(xsmall) divProfil" style="width: calc(100% - 6em);">   
                        <div for="conditions" class="conditions labelProfil" style="width: auto;">
                            <h5 style="align-self: end; width: auto; width: calc(100% - 6em);margin: 0; color:grey; font-weight: 500 !important; font-size:16px; font-family: 'Source Sans Pro',sans-serif !important;">Si vous avez un régime alimentaire particulier merci de le préciser. </h5><br>
                        </div>


                         <!--continuer le responsive-->

                        <div class="2u 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; ">
                            <input <?php echo ($disable) ?> type="radio" name="régimeAlimentaire" id="pas-de-regime-particulier" value="Pas-de-regime-particulier" <?php if ($data['REGIMEALIMENTAIRE'] == "pas-de-regime-particulier") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="labelProfil" for="pas-de-regime-particulier">Pas de régime particulier</label>
                        </div>
                        <div class="container" style="display: flex; ">
                            <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; padding-right: 130px; ">
                                <input <?php echo ($disable) ?> type="radio" name="régimeAlimentaire" id="végétarien" value="Végétarien" <?php if ($data['REGIMEALIMENTAIRE'] == "Végétarien") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="labelProfil" for="végétarien">Végétarien</label>
                            </div>
                            <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; padding-right: 130px; ">
                                <input <?php echo ($disable) ?> type="radio" name="régimeAlimentaire" id="sans-gluten" value="Sans-gluten" <?php if ($data['REGIMEALIMENTAIRE'] == "Sans-gluten") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="labelProfil" for="sans-gluten">Sans gluten</label>
                            </div>
                            <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em;">
                                <input <?php echo ($disable) ?> type="radio" name="régimeAlimentaire" id="autre" value="Autre" <?php if ($data['REGIMEALIMENTAIRE'] == "Autre") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="labelProfil" for="autre">Autre</label>
                            </div>
                        </div>
                        <div style="display: flex;">
                            <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em; padding-right: 135px;">
                                <input <?php echo ($disable) ?> type="radio" name="régimeAlimentaire" id="sans-porc" value="Sans-porc" <?php if ($data['REGIMEALIMENTAIRE'] == "Sans-porc") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="labelProfil" for="sans-porc">Sans porc</label>
                            </div>
                            
                            <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em;">
                                <input <?php echo ($disable) ?> type="radio" name="régimeAlimentaire" id="sans-crustacé" value="Sans-crustacé" <?php if ($data['REGIMEALIMENTAIRE'] == "Sans-crustacé") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="labelProfil" for="sans-crustacé">Sans crustacé</label>
                            </div>
                        </div>
                        
                      
                    </div> <br>

                   
                    

                    <div class="12u$ 12u$(xsmall) divProfil" style="display: block;">
                        <label for="remarquesRegime" style="width: 100%;" class="labelProfil"></label>
                        <textarea <?php echo ($readonly) ?> placeholder="Remarques" class="inputProfil" id="remarquesRegime" name="remarques" style="height: 9px;  line-height: 6px; !important; resize: none; "><?= $data['REMARQUEREGIME'] ?></textarea>
                    </div>
                    
                    <div class="12u$ 12u$(xsmall) divProfil" style="display: block;">
                        <label for="remarques" style="width: 100%; color:grey; " class="labelProfil">Avez-vous des remarques?</label>
                        <textarea <?php echo ($readonly) ?> placeholder="Remarques"  class="inputProfil" id="remarques" name="remarques" style="height: 6em !important; line-height: 6px; resize: none; "><?= $data['REMARQUES'] ?></textarea>
                    </div>

                    <br>

                    <em class="em14" style="font-size: 9pt;color:grey; margin-bottom:-40px;  font-family: 'Arial', sans-serif;">

                        <h3 style=" color:grey; font: weight 6px; font-size:13px; color:grey;" >Modalités d'inscription</h3><br>
                        Vos données personnelles sont traitées par Abeille Vie afin d'organiser le voyage courtage national 2023 sur la base de son intérêt légitime à gérer son réseau d’apporteurs. Les données relatives aux particularités alimentaires sont traitées sur la base de votre consentement.<br>
                        <br>
                        Vos données sont conservées pour la durée du voyage. Les destinataires de vos données sont les personnels d’Abeille Vie ou des entités d'Abeille&nbsp;Assurances auxquelles ils appartiennent, ses prestataires ou partenaires, y compris les agences organisatrices du voyage.<br>
                        <br>
                        Vous disposez des droits d'accès, de rectification, d'effacement, de portabilité des données, d'opposition et de limitation du traitement. Vous pouvez retirer votre consentement au traitement de vos données relatives aux particularités alimentaires à tout moment.<br>
                        Ces droits peuvent être exercés auprès du délégué à la protection des données, en précisant dans l’objet de la demande « Voyage courtage national 2023 »,à l’adresse : dpo.france@abeille-assurances.fr.<br>
                        Vous disposez également du droit d'introduire une réclamation auprès de la CNIL.<br> <br><br>

                        <div class="2u 12u$(xsmall) divProfil" style="width: calc(100% - 6em);">   
                       
                            <div class="2u 12u$(xsmall) divProfil" style="width: auto; padding-right: 55px;font-size:14px; margin-left: 0.5em;display: inline-block;">
                                <input <?php echo ($disable) ?> type="radio" name="modalitésdinscription" id="jaccepte" value="Jaccepte" <?php if ($data['MODALITÉSDINSCRIPTION'] == "Jaccepte") {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                <label class="labelProfil" for="jaccepte">J'accepte</label>
                            </div>
                            <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; font-size:14px; margin-left: 0.5em; display: inline-block;">
                                <input <?php echo ($disable) ?> type="radio" name="modalitésdinscription" id="naccepte-pas" value="Naccepte-Pas" <?php if ($data['MODALITÉSDINSCRIPTION'] == "Naccepte-Pas") {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <label class="labelProfil" for="naccepte-pas">Je n'accepte pas</label>
                            </div>
                        </div> <br>
                    </em>

                </div><br>

                <div class="12u$">
                    <input type="hidden" name="form" value="profile">
                    <input type="hidden" name="id_societe" value="<?= $societe_infos['ID'] ?>">
                    <input type="hidden" name="id" value="<?= $data['ID'] ?>">
                    <ul style="text-align: left; margin: 0 auto 0 auto; max-width: 90%;" class="actions displayBtnProfil">

                        <li style="float: left;">
                            <input <?php echo ($disable2) ?> id="btnValider" name="btnValider" style="background: #FF8C00; margin-bottom:100px;color:aliceblue; font-size:medium;" type="submit" value="Envoyer" class="special">
                            <label for="btnValider" class="labelProfil" style="margin-left: 1em;"></label>
                        </li>
                        <?php if ($_SESSION['droit'] == 1) { ?>
                            <li style="float:right;"><a href="liste.php?event=<?php echo $_GET['event']; ?>" class="button special">Retour</a></li>
                        <?php } ?>
                        <?php if (($_GET['idColaborateur'] != "") && ($_SESSION['droit'] == 0)) { ?>
                            <li style="float:right;"><a href="societe.php" class="button special">Retour</a></li>
                        <?php } ?>
                    </ul>
                </div>

            </form>
        </div>
    </section>

    <div style="margin-top: 5em;">
        <?php include "footer.php" ?>
    </div>

    <script src="./assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="./assets/js/skel.min.js"></script>
    <script src="./assets/js/util.js"></script>
    <script src="./assets/js/main.js"></script>

    <script>
        var displayContent = function(event, a, b) {
            var output = document.getElementsByClassName('out-' + a + '-' + b);
            output[0].innerHTML = event.target.files[0].name;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            radioValue1 = $("input[name='ifSingle']:checked").val();
            if (radioValue1 == "Non") {
                $(".displayPartenaire").css("display", "block");
                $(".displaySingle").css("display", "none");
            } else if (radioValue1 == "Oui") {
                $(".displayPartenaire").css("display", "none");
                $(".displaySingle").css("display", "block");
            }

            radioValue = $("input[name='ifSingle']:checked").val();
            if (radioValue == "Oui") {
                $(".ifSingle").css("display", "none");
            } else {
                $(".ifSingle").css("display", "block");
            }
        });
    </script>

    <script type="text/javascript">
        // Conditions
        $(document).ready(function() {

            radioValue1 = $("textarea[name='remarquesAli']").val();
            if (radioValue1 == "") {
                $(".displayConditions").css("display", "none");
            } else if (radioValue1 == "Oui") {
                $(".displayConditions").css("display", "block");
            }

            radioValue1 = $("textarea[name='remarquesAliAcc']").val();
            if (radioValue1 == "") {
                $(".displayConditionsAcc").css("display", "none");
            } else {
                $(".displayConditionsAcc").css("display", "block");
            }
        });

        function conditionsCheck() {

            radioValue1 = $("textarea[name='remarquesAli']").val();
            if (radioValue1 == "") {
                $(".displayConditions").css("display", "none");
            } else {
                $(".displayConditions").css("display", "block");
            }
        }

        function conditionsAccCheck() {

            radioValue1 = $("textarea[name='remarquesAliAcc']").val();
            if (radioValue1 == "") {
                $(".displayConditionsAcc").css("display", "none");
            } else {
                $(".displayConditionsAcc").css("display", "block");
            }
        }
    </script>

 

    <script type="text/javascript">
        $(document).ready(function() {

            var idColla = <?php echo json_encode($id); ?>;

            $('#sortpicture').on('change', function() {

                var file_data = $('#sortpicture').prop('files')[0];
                if (file_data != '' || file_data[0] != "") {
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    if (file_data.size > (1048576 * 8)) {
                        let mo = (file_data.size / 1000000).toFixed(2);
                        document.querySelector('.file-name-identite').textContent = "Le fichier dépasse la limite autorisée de 6 Mo : " + mo + "Mo"
                    } else {
                        $.ajax({
                                url: 'upload.php?idColaborateur=' + idColla + '&event=1',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',

                            })
                            .done(function(response, textStatus, jqXHR) {

                                if ("ok" == response) {

                                    $(".pdfValid").css("display", "block");


                                }
                                if ("error" == response) {

                                    console.log("error")

                                }

                                if ("Erreur extension" == response) {

                                    document.querySelector('.file-name-identite').textContent = "Erreur d'extension"

                                }


                            }).fail(function(jqXHR, textStatus, errorThrown) {


                                $(".pdfNotValid").css("display", "block");
                                console.log('fail')

                            });
                    }

                } else {
                    console.log("vide");
                }

            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var idColla = <?php echo json_encode($id); ?>;

            $('#uploadTrombi').on('change', function() {

                var file_data = $('#uploadTrombi').prop('files')[0];
                if (file_data != '' || file_data[0] != "") {
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    if (file_data.size > (1048576 * 8)) {
                        let mo = (file_data.size / 1000000).toFixed(2);
                        document.querySelector('.file-name-trombi').textContent = "Le fichier dépasse la limite autorisée de 6 Mo : " + mo + "Mo"
                    } else {
                        $.ajax({
                                url: 'uploadTrombi.php?idColaborateur=' + idColla + '&event=1',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',

                            })
                            .done(function(response, textStatus, jqXHR) {

                                if ("ok" == response) {

                                }
                                if ("error" == response) {

                                    console.log("error")

                                }

                                if ("Erreur extension" == response) {
                                    document.querySelector('.file-name-trombi').textContent = "Erreur d'extension"
                                }

                                console.log(response)

                            }).fail(function(jqXHR, textStatus, errorThrown) {

                                console.log('fail')

                            });
                    }

                } else {
                    console.log("vide");
                }

            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var idColla = <?php echo json_encode($id); ?>;

            $('#sortpictureAcc').on('change', function() {

                var file_data = $('#sortpictureAcc').prop('files')[0];
                if (file_data != '' || file_data[0] != "") {
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    if (file_data.size > (1048576 * 8)) {
                        let mo = (file_data.size / 1000000).toFixed(2);
                        document.querySelector('.file-name-identite-acc').textContent = "Le fichier dépasse la limite autorisée de 6 Mo : " + mo + "Mo"
                    } else {
                        $.ajax({
                                url: 'uploadAcc.php?idColaborateur=' + idColla + '&event=1',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',

                            })
                            .done(function(response, textStatus, jqXHR) {

                                if ("ok" == response) {

                                    $(".pdfValid").css("display", "block");


                                }
                                if ("error" == response) {
                                    console.log("error")
                                }
                                if ("Erreur extension" == response) {
                                    document.querySelector('.file-name-identite-acc').textContent = "Erreur d'extension"
                                }


                            }).fail(function(jqXHR, textStatus, errorThrown) {


                                $(".pdfNotValid").css("display", "block");
                                console.log('fail')

                            });
                    }

                } else {
                    console.log("vide");
                }

            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var idColla = <?php echo json_encode($id); ?>;

            $('#uploadTrombiAcc').on('change', function() {

                var file_data = $('#uploadTrombiAcc').prop('files')[0];
                if (file_data != '' || file_data[0] != "") {
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    if (file_data.size > (1048576 * 8)) {
                        let mo = (file_data.size / 1000000).toFixed(2);
                        document.querySelector('.file-name-trombi-acc').textContent = "Le fichier dépasse la limite autorisée de 6 Mo : " + mo + "Mo"
                    } else {
                        $.ajax({
                                url: 'uploadTrombiAcc.php?idColaborateur=' + idColla + '&event=1',
                                dataType: 'text',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',

                            })
                            .done(function(response, textStatus, jqXHR) {

                                if ("ok" == response) {

                                }
                                if ("error" == response) {
                                    console.log("error")
                                }
                                if ("Erreur extension" == response) {
                                    document.querySelector('.file-name-trombi-acc').textContent = "Erreur d'extension"
                                }

                                console.log(response)

                            }).fail(function(jqXHR, textStatus, errorThrown) {

                                console.log('fail')

                            });
                    }

                } else {
                    console.log("vide");
                }

            });

        });
    </script>
</body>

</html>