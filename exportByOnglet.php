<?php

include 'connect-backoffice.php';

if ($_GET['export'] == '') {
    header("Location: index.php");
    exit();
}

require_once './config/Database.php';
$db = Database::getMysqli();

$separateur = ";";

// Onglet
if ($_GET['export'] == 'onglet') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT ID, PARTICIPATION, LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);

    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 1
if ($_GET['export'] == 'onglet0_1') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 ORDER BY ID ASC';

    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);

    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 2
if ($_GET['export'] == 'onglet0_2') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 3
if ($_GET['export'] == 'onglet0_3') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 0 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "") ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 4
if ($_GET['export'] == 'onglet0_4') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 0 AND (LAST_SAVE IS NULL OR LAST_SAVE = "") ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 5
if ($_GET['export'] == 'onglet0_5') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Double" ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 6
if ($_GET['export'] == 'onglet0_6') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Twin" ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 7
if ($_GET['export'] == 'onglet0_7') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Single" ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 8
if ($_GET['export'] == 'onglet0_8') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND ((REMARQUES != "" AND REMARQUES IS NOT NULL) OR (REMARQUES_ACC != "" AND REMARQUES_ACC IS NOT NULL)) ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 9
if ($_GET['export'] == 'onglet0_9') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND ((REMARQUES_ALI != "" AND REMARQUES_ALI IS NOT NULL) OR (REMARQUES_ALI_ACC != "" AND REMARQUES_ALI_ACC IS NOT NULL)) ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 10
if ($_GET['export'] == 'onglet0_10') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND FIRST_CO = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 0 11
if ($_GET['export'] == 'onglet0_11') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND FIRST_CO = 0 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 1
if ($_GET['export'] == 'onglet1_1'){

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';
	
	

    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 2
if ($_GET['export'] == 'onglet1_2') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 1 AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 3
if ($_GET['export'] == 'onglet1_3') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 0 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "") AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 4
if ($_GET['export'] == 'onglet1_4') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 0 AND (LAST_SAVE IS NULL OR LAST_SAVE = "") AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 5
if ($_GET['export'] == 'onglet1_5') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Double" AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 6
if ($_GET['export'] == 'onglet1_6') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Twin" AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 7
if ($_GET['export'] == 'onglet1_7') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Single" AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 8
if ($_GET['export'] == 'onglet1_8') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND ((REMARQUES != "" AND REMARQUES IS NOT NULL) OR (REMARQUES_ACC != "" AND REMARQUES_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 9
if ($_GET['export'] == 'onglet1_9') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND ((REMARQUES_ALI != "" AND REMARQUES_ALI IS NOT NULL) OR (REMARQUES_ALI_ACC != "" AND REMARQUES_ALI_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 10
if ($_GET['export'] == 'onglet1_10') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND FIRST_CO = 1 AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 1 11
if ($_GET['export'] == 'onglet1_11') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND FIRST_CO = 0 AND GROUPE_VOYAGE = 1 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 1
if ($_GET['export'] == 'onglet2_1') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 2
if ($_GET['export'] == 'onglet2_2') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 1 AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 3
if ($_GET['export'] == 'onglet2_3') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 0 AND (LAST_SAVE IS NOT NULL AND LAST_SAVE != "") AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 4
if ($_GET['export'] == 'onglet2_4') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND PARTICIPATION = 0 AND (LAST_SAVE IS NULL OR LAST_SAVE = "") AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 5
if ($_GET['export'] == 'onglet2_5') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Double" AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 6
if ($_GET['export'] == 'onglet2_6') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Twin" AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 7
if ($_GET['export'] == 'onglet2_7') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND TYPE_CHAMBRE = "Single" AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 8
if ($_GET['export'] == 'onglet2_8') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND ((REMARQUES != "" AND REMARQUES IS NOT NULL) OR (REMARQUES_ACC != "" AND REMARQUES_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 9
if ($_GET['export'] == 'onglet2_9') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND ((REMARQUES_ALI != "" AND REMARQUES_ALI IS NOT NULL) OR (REMARQUES_ALI_ACC != "" AND REMARQUES_ALI_ACC IS NOT NULL)) AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 10
if ($_GET['export'] == 'onglet2_10') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND FIRST_CO = 1 AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}

// Onglet 2 11
if ($_GET['export'] == 'onglet2_11') {

    $headers = array('ID', 'Participation', 'Sauvegarde','Civilité', 'Nom', 'Prénom', 'E-mail', 'Téléphone', 'Agence', 'Date de Naissance', 'Lieu de Naissance', 'Nationalite', 'Type de Chambre', 'N° Passport/CNI', 'Date d\'Émission', 'Lieu d\'Émission', 'Date d\'Expiration', 'Remarques', 'Remarques Alimentaires', 'Condition', 'Photo Trombinoscope', 'Passport/CNI', 'Civilité Accompagnant', 'Nom Accompagnant', 'Prénom Accompagnant', 'E-mail Accompagnant', 'Téléphone Accompagnant', 'Date de Naissance Accompagnant', 'Lieu de Naissance Accompagnant', 'Nationalite Accompagnant', 'N° Passport/CNI Accompagnant', 'Date d\'Émission Accompagnant', 'Lieu d\'Émission Accompagnant', 'Date d\'Expiration Accompagnant', 'Remarques Accompagnant', 'Remarques Alimentaires Accompagnant', 'Condition Accompagnant','Photo Trombinoscope Accompagnant', 'Passport/CNI Accompagnant', 'Région', 'Groupes');

    $sql = 'SELECT SELECT ID, PARTICIPATION,  LAST_SAVE, CIVILITE, NOM, PRENOM, EMAIL, TEL, AGENCE, DATE_NAISS, LIEU_NAISS, NATIONALITE, TYPE_CHAMBRE, NUM_PASSPORT, DATE_EMISSION, LIEU_EMISSION, DATE_EXPIRATION, REMARQUES, REMARQUES_ALI, CONDITIONS, UPLOAD_PHOTO, UPLOAD_PASSPORT, CIVILITE_ACC, NOM_ACC, PRENOM_ACC, MAIL_ACC, TEL_ACC, DATE_NAISS_ACC, LIEU_NAISS_ACC, NATIONALITE_ACC, NUM_PASSPORT_ACC, DATE_EMISSION_ACC, LIEU_EMISSION_ACC, DATE_EXPIRATION_ACC, REMARQUES_ACC, REMARQUES_ALI_ACC, CONDITIONS_ACC, UPLOAD_PHOTO_ACC, UPLOAD_PASSPORT_ACC, INFO_8, INFO_7 FROM USERS WHERE DROIT = 0 AND ID >= 100 AND FIRST_CO = 0 AND GROUPE_VOYAGE = 2 ORDER BY ID ASC';



    $req = mysqli_query($db, $sql) or die('Erreur 500-EX1, Merci de contacter l\'administrateur.');

    $data = mysqli_fetch_all($req);
    foreach ($data as $key => $line) {
        if ($data[$key][1] == "1") {
            $data[$key][1] = 'Validé';
        }
        if ($data[$key][1] == "0") {
            $data[$key][1] = 'N\'a pas encore validé';
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=csv_export.csv');
    
    $output = fopen('php://output', 'w');
    
    ob_end_clean();
    
    fputs( $output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );

    fputcsv($output, $headers, $separateur);
    
    foreach ($data as $data_item) {
        fputcsv($output, $data_item, $separateur);
    }
    exit;
}