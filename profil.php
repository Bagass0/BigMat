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

                if (($civilite == "") or ($nom == "") or ($prenom == "") or ($agence == "") or ($tel == "") or ($dateNaiss == "") or ($lieuNaiss == "") or ($nationalite == "") or ($numPassport == "") or ($dateEmission == "") or ($lieuEmission == "") or ($dateExpiration == "")) {

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

                $usr->updateUserById3($id, $validation, $civilite, $nom, $prenom, $agence, $mail, $tel, $dateNaiss, $lieuNaiss, $nationalite, $numPassport, $dateEmission, $lieuEmission, $dateExpiration, $typeChambre, $remarques, $remarquesAli, $civiliteAcc, $nomAcc, $prenomAcc, $mailAcc, $telAcc, $dateNaissAcc, $lieuNaissAcc, $nationaliteAcc, $numPassportAcc, $dateEmissionAcc, $lieuEmissionAcc, $dateExpirationAcc, $remarquesAcc, $remarquesAliAcc, $accompagnement, $conditions, $conditionsAcc);

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

    <section id="two" class="wrapper align-left" style="border-radius: 1em; padding-top: 5em; margin-top: 5em; margin-bottom: -7em;">
        <h3 style="font-weight: 700; margin-left: 1.5em; font-size: 2em;"> Formulaire d'inscription </h3>
    </section>

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
                <div class="row uniform">

                    <div class="12u$ 12u$(xsmall)" style="display: flex; margin-bottom: 3em;">
                        <img src="images/profil.jpg" style="width: 2em; height: 2.3em; margin-right: 2em;" class="">
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
                        <label for="nom" style="width: 4em;" class="labelProfil">Nom* :</label>
                        <input style="width: calc(100% - 4em);" <?php echo ($readonly) ?> type="text" name="nom" class="inputProfil" id="nom" value="<?= $data['NOM'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="prenom" style="width: 6em;" class="labelProfil">Prénom* :</label>
                        <input style="width: calc(100% - 6em);" <?php echo ($readonly) ?> type="text" name="prenom" class="inputProfil" id="prenom" value="<?= $data['PRENOM'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%;">
                        <label for="agence" style="width: 13em;" class="labelProfil">Votre Cabinet de Courtage* :</label>
                        <input style="width: calc(100% - 13em);" <?php echo ($readonly) ?> type="text" name="agence" class="inputProfil" id="agence" value="<?= $data['AGENCE'] ?>">
                    </div>

                    <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="mail" style="width: 4em;" class="labelProfil">Email* :</label>
                        <input style="width: calc(100% - 4em);" <?php echo ($readonly) ?> type="email" name="mail" class="inputProfil" id="mail" value="<?= $data['EMAIL'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="tel" style="width: 12em;" class="labelProfil">Numéro de Portable* : +33</label>
                        <input style="width: calc(100% - 12em);" <?php echo ($readonly) ?> type="tel" name="tel" class="inputProfil" id="tel" value="<?= $data['TEL'] ?>">
                    </div>

                    <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="dateNaiss" style="width: 9em;" class="labelProfil">Date de naissance* :</label>
                        <input style="width: calc(100% - 9em);" <?php echo ($readonly) ?> type="date" name="dateNaiss" class="inputProfil" id="dateNaiss" value="<?= $data['DATE_NAISS'] ?>" pattern="[0-3][0-9]/[0-1][0-9]/[1-2][^1-8][0-9][0-9]">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="lieuNaiss" style="width: 9em;" class="labelProfil">Lieu de naissance* :</label>
                        <input style="width: calc(100% - 9em);" <?php echo ($readonly) ?> type="text" name="lieuNaiss" class="inputProfil" id="lieuNaiss" value="<?= $data['LIEU_NAISS'] ?>">
                    </div>

                    <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="nationalite" style="width: 6em;" class="labelProfil">Nationalité* :</label>
                        <input style="width: calc(100% - 6em);" <?php echo ($readonly) ?> type="text" name="nationalite" class="inputProfil" id="nationalite" value="<?= $data['NATIONALITE'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                        <label for="numPassport" style="width: 11em;" class="labelProfil">N° de passeport* :</label>
                        <input style="width: calc(100% - 11em);" <?php echo ($readonly) ?> type="text" name="numPassport" class="inputProfil" id="numPassport" value="<?= $data['NUM_PASSPORT'] ?>">
                    </div>

                    <div class="6u 12u$(xsmall) divProfil" style="width: 33%">
                        <label for="dateEmission" style="width: 8em;" class="labelProfil">Date d'émission* :</label>
                        <input style="width: calc(100% - 8em);" <?php echo ($readonly) ?> type="date" name="dateEmission" class="inputProfil" id="dateEmission" value="<?= $data['DATE_EMISSION'] ?>">
                    </div>

                    <div class="6u 12u$(xsmall) divProfil" style="width: 34%">
                        <label for="lieuEmission" style="width: 8em;" class="labelProfil">Lieu d'émission* :</label>
                        <input style="width: calc(100% - 8em);" <?php echo ($readonly) ?> type="text" name="lieuEmission" class="inputProfil" id="lieuEmission" value="<?= $data['LIEU_EMISSION'] ?>">
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 33%">
                        <label for="dateExpiration" style="width: 9em;" class="labelProfil">Date d'expiration* :</label>
                        <input style="width: calc(100% - 9em);" <?php echo ($readonly) ?> type="date" name="dateExpiration" class="inputProfil" id="dateExpiration" value="<?= $data['DATE_EXPIRATION'] ?>">
                    </div>

                    <div class="12u$ 12u$(xsmall) divProfil" style="display: block; margin-top: 1em; margin-bottom: 0em;" id="div1">
                        <label for="remarquesAli" style="width: 100%;" class="labelProfil">Particularités alimentaires (allergies, intolérances, régimes spécifiques) :</label>
                        <textarea <?php echo ($readonly) ?> class="inputProfil" id="remarquesAli" name="remarquesAli" style="height: 5em !important; resize: none; border: solid 1px #000 !important;" oninput="conditionsCheck()"><?= $data['REMARQUES_ALI'] ?></textarea>
                    </div>

                    <div class="12u$ displayConditions" style="text-align: left; margin-top: 0em; padding-top: 1em;">
                        <input <?php echo ($checkbox) ?> id="conditions" name="conditions" class="conditions" type="checkbox" value="1" <?php if ($data['CONDITIONS'] == "1") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>>
                        <label for="conditions" class="conditions labelProfil" style="font-weight: 500 !important;">
                            J’accepte que mes données relatives aux particularités alimentaires, susceptibles de constituer des données de santé ou des données révélant mes convictions religieuses, soient traitées par Abeille Vie afin de préparer des repas adaptés dans le cadre du voyage courtage national 2023. A défaut de consentement, vos particularités alimentaires ne seront pas prises en compte.
                        </label>

                    </div>

                    <br><br>

                    <div class="12u$ 12u$(xsmall) divProfil" style="display: block;">
                        <label for="remarques" style="width: 100%;" class="labelProfil">Autres remarques :</label>
                        <textarea <?php echo ($readonly) ?> class="inputProfil" id="remarques" name="remarques" style="height: 5em !important; resize: none; border: solid 1px #000 !important;"><?= $data['REMARQUES'] ?></textarea>
                    </div>

                    <div class="3u$ 12u$(xsmall) sourceSansPro" style="width: auto;">
                        Pièces jointes à télécharger : <em class="em14" style="font-size: 11pt;">(Formats : pdf, jpeg, jpg, png/ 6Mo maximum)</em>
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%; gap: 1em; margin-bottom: 0;">
                        <label for="trombi" style="width: 29em; align-self: baseline !important;" name="divFil-trombi" class="labelProfil">Une photo qui vous ressemble (autre que photo ID) – trombinoscope*</label>
                        <a style="text-decoration: none; font-weight: 600; cursor: pointer;" <?php echo ($trombi) ?> value="Photo" id="trombi">
                            <img src="images/ici.jpg" style="height: 1.5em;">
                        </a>
                        <input <?php echo ($readonly) ?> type='file' id="uploadTrombi" name="uploadP" accept=".jpeg,.jpg,.png,.pdf,.JPEG,.JPG,.PNG,.PDF" style="width: 70%; float:left; display:none">
                        <p class="file-name-trombi labelProfil" style="align-self: baseline !important; <?php if ($photoProfil != "") {
                                                                                                            echo ('margin: 0px;');
                                                                                                        } ?>">
                            <?= $photoProfil != "" ? $photoProfil . " - " . $formattedSizeTrombi : "" ?>
                        </p>
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%; gap: 1em;">
                        <label <?php echo ($disable) ?> for="uploadPassport" style="width: 8em; align-self: baseline !important;" name="divFil-identite" class="labelProfil">Votre passeport*</label>
                        <a style="text-decoration: none; font-weight: 600; cursor: pointer;" <?php echo ($passport) ?> value="Passeport" id="uploadPassport">
                            <img src="images/ici.jpg" style="height: 1.5em;">
                        </a>
                        <input <?php echo ($readonly) ?> type='file' id="sortpicture" name="sortpic" accept=".jpeg,.jpg,.png,.pdf,.JPEG,.JPG,.PNG,.PDF" style="width: 70%; float:left; display:none">
                        <p class="file-name-identite labelProfil" style="align-self: baseline !important; <?php if ($carteIdentite != "") {
                                                                                                                echo ('margin: 0px;');
                                                                                                            } ?>">
                            <?= $carteIdentite != "" ? $carteIdentite . " - " . $formattedSizeCni : "" ?>
                        </p>
                    </div>

                    <div class="12u$ 12u$(xsmall) displayPartenaire" style="display: flex; margin-bottom: 1em;">
                        <img src="images/profil.jpg" style="width: 2em; height: 2.3em; margin-right: 2em;" class="">
                        <h3 style="font-size: 20pt; font-weight: 700; width: 11em; text-align:left; margin-right: 1em; align-self: center; margin: 0;">Accompagnant</h3>
                    </div>

                    <div class="3u 12u$(xsmall) sourceSansPro displayPartenaire" style="width: auto;">
                        Type de Chambre* :
                    </div>
                    <div class="3u 12u$(xsmall) displayPartenaire" style="width: auto;">
                        <input <?php echo ($disable) ?> type="radio" name="typeChambre" id="double" value="Double" <?php if ($data['TYPE_CHAMBRE'] == "Double") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                        <label class="labelProfil" for="double">Double</label>
                    </div>
                    <div class="3u 12u$(xsmall) displayPartenaire" style="width: auto">
                        <input <?php echo ($disable) ?> type="radio" name="typeChambre" id="twin" value="Twin" <?php if ($data['TYPE_CHAMBRE'] == "Twin") {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                        <label class="labelProfil" for="twin">Twin ( 2 lits séparés )</label>
                    </div>

                    <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%; display: none;">
                        <input style="width: 100%;" disabled type="radio" name="ifSingle" class="inputProfil" id="ifSingle" value="Oui" <?php if ($data['SINGLE'] == "Oui") {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                    </div>

                    <div style="height: 3em; width: 100%" class="ifSingle"></div>

                    <div class="row uniform displayPartenaire" style="width: 100%">
                        <div class="2u 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em;">
                            <input <?php echo ($disable) ?> type="radio" name="civiliteAcc" id="mrAcc" value="Mr" <?php if ($data['CIVILITE_ACC'] == "Mr") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="labelProfil" for="mrAcc">Mr*</label>
                        </div>
                        <div class="3u$ 12u$(xsmall) divProfil" style="width: auto; margin-left: 0.5em;">
                            <input <?php echo ($disable) ?> type="radio" name="civiliteAcc" id="mmeAcc" value="Mme" <?php if ($data['CIVILITE_ACC'] == "Mme") {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                            <label class="labelProfil" for="mmeAcc">Mme*</label>
                        </div>


                        <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="nomAcc" style="width: 4em;" class="labelProfil">Nom* :</label>
                            <input style="width: calc(100% - 4em);" <?php echo ($readonly) ?> type="text" name="nomAcc" class="inputProfil" id="nomAcc" value="<?= $data['NOM_ACC'] ?>">
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="prenomAcc" style="width: 6em;" class="labelProfil">Prénom* :</label>
                            <input style="width: calc(100% - 6em);" <?php echo ($readonly) ?> type="text" name="prenomAcc" class="inputProfil" id="prenomAcc" value="<?= $data['PRENOM_ACC'] ?>">
                        </div>

                        <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="mailAcc" style="width: 4em;" class="labelProfil">Email* :</label>
                            <input style="width: calc(100% - 4em);" <?php echo ($readonly) ?> type="email" name="mailAcc" class="inputProfil" id="mailAcc" value="<?= $data['MAIL_ACC'] ?>">
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="telAcc" style="width: 12em;" class="labelProfil">Numéro de Portable* : +33</label>
                            <input style="width: calc(100% - 12em);" <?php echo ($readonly) ?> type="tel" name="telAcc" class="inputProfil" id="telAcc" value="<?= $data['TEL_ACC'] ?>">
                        </div>

                        <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="dateNaissAcc" style="width: 9em;" class="labelProfil">Date de naissance* :</label>
                            <input style="width: calc(100% - 9em);" <?php echo ($readonly) ?> type="date" name="dateNaissAcc" class="inputProfil" id="dateNaissAcc" value="<?= $data['DATE_NAISS_ACC'] ?>" pattern="[0-3][0-9]/[0-1][0-9]/[1-2][^1-8][0-9][0-9]">
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="lieuNaissAcc" style="width: 9em;" class="labelProfil">Lieu de naissance* :</label>
                            <input style="width: calc(100% - 9em);" <?php echo ($readonly) ?> type="text" name="lieuNaissAcc" class="inputProfil" id="lieuNaissAcc" value="<?= $data['LIEU_NAISS_ACC'] ?>">
                        </div>

                        <div class="6u 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="nationaliteAcc" style="width: 6em;" class="labelProfil">Nationalité* :</label>
                            <input style="width: calc(100% - 6em);" <?php echo ($readonly) ?> type="text" name="nationaliteAcc" class="inputProfil" id="nationaliteAcc" value="<?= $data['NATIONALITE_ACC'] ?>">
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 50%">
                            <label for="numPassportAcc" style="width: 11em;" class="labelProfil">N° de passeport* :</label>
                            <input style="width: calc(100% - 11em);" <?php echo ($readonly) ?> type="text" name="numPassportAcc" class="inputProfil" id="numPassportAcc" value="<?= $data['NUM_PASSPORT_ACC'] ?>">
                        </div>

                        <div class="6u 12u$(xsmall) divProfil" style="width: 33%">
                            <label for="dateEmissionAcc" style="width: 8em;" class="labelProfil">Date d'émission* :</label>
                            <input style="width: calc(100% - 8em);" <?php echo ($readonly) ?> type="date" name="dateEmissionAcc" class="inputProfil" id="dateEmissionAcc" value="<?= $data['DATE_EMISSION_ACC'] ?>">
                        </div>

                        <div class="6u 12u$(xsmall) divProfil" style="width: 34%">
                            <label for="lieuEmissionAcc" style="width: 8em;" class="labelProfil">Lieu d'émission* :</label>
                            <input style="width: calc(100% - 8em);" <?php echo ($readonly) ?> type="text" name="lieuEmissionAcc" class="inputProfil" id="lieuEmissionAcc" value="<?= $data['LIEU_EMISSION_ACC'] ?>">
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 33%">
                            <label for="dateExpirationAcc" style="width: 9em;" class="labelProfil">Date d'expiration* :</label>
                            <input style="width: calc(100% - 9em);" <?php echo ($readonly) ?> type="date" name="dateExpirationAcc" class="inputProfil" id="dateExpirationAcc" value="<?= $data['DATE_EXPIRATION_ACC'] ?>">
                        </div>

                        <div style="height: 3em; width: 100%"></div>

                        <div class="12u$ 12u$(xsmall) divProfil" style="display: block; margin-top: 1em; margin-bottom: 0em;">
                            <label for="remarquesAliAcc" style="width: 100%;" class="labelProfil">Particularités alimentaires (allergies, intolérances, régimes spécifiques) :</label>
                            <textarea <?php echo ($readonly) ?> class="inputProfil" id="remarquesAliAcc" name="remarquesAliAcc" style="height: 5em !important; resize: none; border: solid 1px #000 !important;" oninput="conditionsAccCheck()"><?= $data['REMARQUES_ALI_ACC'] ?></textarea>

                        </div>

                        <div class="12u$ displayConditionsAcc" style="text-align: left; margin-top: 0em; padding-top: 1em;">
                            <input <?php echo ($checkbox) ?> id="conditionsAcc" name="conditionsAcc" class="conditions" type="checkbox" value="1" <?php if ($data['CONDITIONS_ACC'] == "1") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>>
                            <label for="conditionsAcc" class="conditions labelProfil" style="font-weight: 500 !important;">
                                J’accepte que mes données relatives aux particularités alimentaires, susceptibles de constituer des données de santé ou des données révélant mes convictions religieuses, soient traitées par Abeille Vie afin de préparer des repas adaptés dans le cadre du voyage courtage national 2023. A défaut de consentement, vos particularités alimentaires ne seront pas prises en compte.
                            </label>

                        </div>

                        <br><br>

                        <div class="12u$ 12u$(xsmall) divProfil" style="display: block;">
                            <label for="remarquesAcc" style="width: 100%;" class="labelProfil">Autres remarques :</label>
                            <textarea <?php echo ($readonly) ?> class="inputProfil" id="remarquesAcc" name="remarquesAcc" style="height: 5em !important; resize: none; border: solid 1px #000 !important;"><?= $data['REMARQUES_ACC'] ?></textarea>
                        </div>

                        <div class="3u$ 12u$(xsmall) sourceSansPro" style="width: auto;">
                            Pièces jointes à télécharger : <em class="em14" style="font-size: 11pt;">(Formats : pdf, jpeg, jpg, png/ 6Mo maximum)</em>
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%; gap: 1em; margin-bottom: 0;">
                            <label <?php echo ($disable) ?> for="trombiAcc" style="width: 29em; align-self: baseline !important;" name="divFil-trombi-acc" class="labelProfil">Une photo qui vous ressemble (autre que photo ID) – trombinoscope*</label>
                            <a style="text-decoration: none; font-weight: 600; cursor: pointer;" <?php echo ($trombiAcc) ?> value="Photo" id="trombiAcc">
                                <img src="images/ici.jpg" style="height: 1.5em;">
                            </a>
                            <input <?php echo ($readonly) ?> type='file' id="uploadTrombiAcc" name="uploadP" accept=".jpeg,.jpg,.png,.pdf,.JPEG,.JPG,.PNG,.PDF" style="width: 70%; float:left; display:none">
                            <p class="file-name-trombi-acc labelProfil" style="align-self: baseline !important; <?php if ($photoProfilAcc != "") {
                                                                                                                    echo ('margin: 0px;');
                                                                                                                } ?>">
                                <?= $photoProfilAcc != "" ? $photoProfilAcc . " - " . $formattedSizeTrombiAcc : "" ?>
                            </p>
                        </div>

                        <div class="6u$ 12u$(xsmall) divProfil" style="width: 100%; gap: 1em;">
                            <label <?php echo ($disable) ?> for="uploadPassportAcc" style="width: 8em; align-self: baseline !important;" name="divFil-identite-acc" class="labelProfil">Votre passeport*</label>
                            <a style="text-decoration: none; font-weight: 600; cursor: pointer;" <?php echo ($passportAcc) ?> value="Passeport" id="uploadPassportAcc">
                                <img src="images/ici.jpg" style="height: 1.5em;">
                            </a>
                            <input <?php echo ($readonly) ?> type='file' id="sortpictureAcc" name="sortpic" accept=".jpeg,.jpg,.png,.pdf,.JPEG,.JPG,.PNG,.PDF" style="width: 70%; float:left; display:none">
                            <p class="file-name-identite-acc labelProfil" style="align-self: baseline !important; <?php if ($carteIdentiteAcc != "") {
                                                                                                                        echo ('margin: 0px;');
                                                                                                                    } ?>">
                                <?= $carteIdentiteAcc != "" ? $carteIdentiteAcc . " - " . $formattedSizeCniAcc : "" ?>
                            </p>
                        </div>
                    </div>

                    <br>

                    <em class="em14" style="font-size: 9pt; font-family: 'Arial', sans-serif;">

                        Vos données personnelles sont traitées par Abeille Vie afin d'organiser le voyage courtage national 2023 sur la base de son intérêt légitime à gérer son réseau d’apporteurs. Les données relatives aux particularités alimentaires sont traitées sur la base de votre consentement.<br>
                        <br>
                        Vos données sont conservées pour la durée du voyage. Les destinataires de vos données sont les personnels d’Abeille Vie ou des entités d'Abeille&nbsp;Assurances auxquelles ils appartiennent, ses prestataires ou partenaires, y compris les agences organisatrices du voyage.<br>
                        <br>
                        Vous disposez des droits d'accès, de rectification, d'effacement, de portabilité des données, d'opposition et de limitation du traitement. Vous pouvez retirer votre consentement au traitement de vos données relatives aux particularités alimentaires à tout moment.<br>
                        Ces droits peuvent être exercés auprès du délégué à la protection des données, en précisant dans l’objet de la demande « Voyage courtage national 2023 »,à l’adresse : dpo.france@abeille-assurances.fr.<br>
                        Vous disposez également du droit d'introduire une réclamation auprès de la CNIL.<br>
                    </em>
                </div>

        </div>

        <br>

        <div class="12u$">
            <input type="hidden" name="form" value="profile">
            <input type="hidden" name="id_societe" value="<?= $societe_infos['ID'] ?>">
            <input type="hidden" name="id" value="<?= $data['ID'] ?>">
            <ul style="text-align: left; margin: 0 auto 0 auto; max-width: 90%;" class="actions displayBtnProfil">
                <li>
                    <input <?php echo ($disable) ?> id="btnSauvegarder" name="btnSauvegarder" style="background: linear-gradient(to right, #E9D9CE, #E9D9CE);" type="submit" value="Sauvegarder*" class="special">
                    <label for="btnSauvegarder" class="labelProfil" style="margin-left: 1em;">* Sauvegarde provisoire</label>
                </li>

                <li style="float: right;">
                    <input <?php echo ($disable2) ?> id="btnValider" name="btnValider" style="background: linear-gradient(to right, #FFD400, #FFD400);" type="submit" value="Valider*" class="special">
                    <label for="btnValider" class="labelProfil" style="margin-left: 1em;">* Validation définitive</label>
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

    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".pdfNotValid").css("display", "none");
        $(".pdfValid").css("display", "none");
        $(".sortpicture").css("display", "none");
        $(".uploadTrombi").css("display", "none");
        $(".sortpictureAcc").css("display", "none");
        $(".uploadTrombiAcc").css("display", "none");
        let uploadFieldIdentite = document.getElementById("sortpicture");
        uploadFieldIdentite.onchange = function() {
            if (this.files[0].size > (1048576 * 8)) {
                alert("Attention, votre fichier dépasse la taille autorisée !");
                this.value = "";
                $('#blah').attr('src', '<?php if ($myurlok != "") {
                                            echo $myurlok . "?" . time();
                                        } ?>');
            } else {
                readURL(this);
            };
        };

        let uploadFieldTrombi = document.getElementById("uploadTrombi");
        uploadFieldTrombi.onchange = function() {

            if (this.files[0].size > (1048576 * 8)) {
                alert("Attention, votre fichier dépasse la taille autorisée !");
                this.value = "";
                $('#blah').attr('src', '<?php if ($myurlok != "") {
                                            echo $myurlok . "?" . time();
                                        } ?>');
            } else {
                readURL(this);
            };
        };

        let uploadFieldIdentiteAcc = document.getElementById("sortpictureAcc");
        uploadFieldIdentiteAcc.onchange = function() {

            if (this.files[0].size > (1048576 * 8)) {
                alert("Attention, votre fichier dépasse la taille autorisée !");
                this.value = "";
                $('#blah').attr('src', '<?php if ($myurlok != "") {
                                            echo $myurlok . "?" . time();
                                        } ?>');
            } else {
                readURL(this);
            };
        };

        let uploadFieldTrombiAcc = document.getElementById("uploadTrombiAcc");
        uploadFieldTrombiAcc.onchange = function() {

            if (this.files[0].size > (1048576 * 8)) {
                alert("Attention, votre fichier dépasse la taille autorisée !");
                this.value = "";
                $('#blah').attr('src', '<?php if ($myurlok != "") {
                                            echo $myurlok . "?" . time();
                                        } ?>');
            } else {
                readURL(this);
            };
        };

        uploadFieldIdentite.onchange = function(e) {
            const [sortpicture] = e.target.files;

            const {
                name: fileName,
                size
            } = sortpicture;

            const fileSize = (size / 1000).toFixed(2);

            const fileNameAndSize = `${fileName} - ${fileSize}KB`;
            document.querySelector('.file-name-identite').textContent = fileNameAndSize;
            $(".file-name-identite").css("margin", "0");
        }

        uploadFieldTrombi.onchange = function(e) {
            const [uploadTrombi] = e.target.files;

            const {
                name: fileName,
                size
            } = uploadTrombi;

            const fileSize = (size / 1000).toFixed(2);

            const fileNameAndSize = `${fileName} - ${fileSize}KB`;
            document.querySelector('.file-name-trombi').textContent = fileNameAndSize;
            $(".file-name-trombi").css("margin", "0");
        }

        uploadFieldIdentiteAcc.onchange = function(e) {
            const [sortpictureAcc] = e.target.files;

            const {
                name: fileName,
                size
            } = sortpictureAcc;

            const fileSize = (size / 1000).toFixed(2);

            const fileNameAndSize = `${fileName} - ${fileSize}KB`;
            document.querySelector('.file-name-identite-acc').textContent = fileNameAndSize;
            $(".file-name-identite-acc").css("margin", "0");
        }

        uploadFieldTrombiAcc.onchange = function(e) {
            const [uploadTrombiAcc] = e.target.files;

            const {
                name: fileName,
                size
            } = uploadTrombiAcc;

            const fileSize = (size / 1000).toFixed(2);

            const fileNameAndSize = `${fileName} - ${fileSize}KB`;
            document.querySelector('.file-name-trombi-acc').textContent = fileNameAndSize;
            $(".file-name-trombi-acc").css("margin", "0");
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