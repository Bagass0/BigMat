<?php

session_start();
require_once './class/User.php';


$usr = new User();



$folder = "trombinoscope/";
$zip_filename = 'trombinoscope.zip';
$url = "liste";


$files = scandir($folder);

if (count($files) <= 2) {
    $_SESSION['error'] = "dossier_vide";
    header("Location: ".$url.".php");
}

$zip = new ZipArchive();


// Ouvrez le fichier ZIP en mode création
if ($zip->open($zip_filename, ZipArchive::CREATE) !== TRUE) {
    die("Impossible d'ouvrir le fichier <$zip_filename>\n");
}


foreach ($files as $file) {
    // Ignorer les éléments . et ..
    if ($file == '.' || $file == '..') {
        continue;
    }

    // Vérifiez si c'est un fichier PNG
    $path_info = pathinfo($file);
        $zip->addFile($folder . '/' . $file, $file);
}

// Fermez le fichier ZIP
$zip->close();

// Set the appropriate headers and output the zip file to the browser

// Obtenez le nom complet du fichier ZIP
$zip_file = realpath($zip_filename);

// Envoyez un en-tête de téléchargement au navigateur
header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . basename($zip_file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($zip_file));

// Lisez le fichier ZIP et envoyez-le au navigateur
readfile($zip_file);

unlink($zip_filename);
