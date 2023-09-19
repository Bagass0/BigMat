<?php 

include 'connect-backoffice.php';

require_once './class/User.php';
require_once './class/Profil.php';

$profil = new Profil();
$usr   = new User();

$user = $_GET["user"];
$event = $_GET["event"];


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    if($_POST['form1'] == "form1"){
        $civilite = $fct->cleanXSS($_POST['civilite']);
        $nom = $fct->cleanXSS($_POST['nom']);
        $prenom = $fct->cleanXSS($_POST['prenom']);
        $date_in = $fct->cleanXSS($_POST['date_in']);
        $date_out = $fct->cleanXSS($_POST['date_out']);
        $participe = $fct->cleanXSS($_POST['participe']);
        $isvalid = $fct->cleanXSS($_POST['isvalid']);
        $isprivilegie = $fct->cleanXSS($_POST['isprivilegie']);
        
        $societe = $fct->cleanXSS($_POST['societe']);
        $typesoc = $fct->cleanXSS($_POST['typesoc']);
        $secteur = $fct->cleanXSS($_POST['secteur']);
        $fonction = $fct->cleanXSS($_POST['fonction']);
        $adresse = $fct->cleanXSS($_POST['adresse']);
        $adresse2 = $fct->cleanXSS($_POST['adresse2']);
        $cp = $fct->cleanXSS($_POST['cp']);
        $ville = $fct->cleanXSS($_POST['ville']);
        $email = $fct->cleanXSS($_POST['email']);
        $tel = $fct->cleanXSS($_POST['tel']);
        $mobile = $fct->cleanXSS($_POST['mobile']);
        $cadeau = $fct->cleanXSS($_POST['cadeau']); 
        $remarques = $fct->cleanXSS($_POST['remarques']); 

        if ($nom != ''){
            date_default_timezone_set('Europe/Paris');
	        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
	         mysqli_select_db($db, 'BddIdec');
            $sql = "UPDATE `PROFILS` SET 
            `NOM` = '".mysql_real_escape_string(utf8_decode($nom))."',
            `PRENOM` = '".mysql_real_escape_string(utf8_decode($prenom))."',
            `PARTICIPATION` = '".mysql_real_escape_string(utf8_decode($participe))."',
            `SOCIETE` = '".mysql_real_escape_string(utf8_decode($societe))."',
            `SECTEUR` = '".mysql_real_escape_string(utf8_decode($secteur))."',
            `FONCTION` = '".mysql_real_escape_string(utf8_decode($fonction))."',
            `ADRESSE` = '".mysql_real_escape_string(utf8_decode($adresse))."',
            `ADRESSE2` = '".mysql_real_escape_string(utf8_decode($adresse2))."',
            `DATE_NAISS` = '".mysql_real_escape_string(utf8_decode($cp))."',
            `LIEU_NAISS` = '".mysql_real_escape_string(utf8_decode($ville))."',
            `EMAIL` = '".mysql_real_escape_string(utf8_decode($email))."',
            `TEL` = '".mysql_real_escape_string(utf8_decode($tel))."',
            `NATIONALITE` = '".mysql_real_escape_string(utf8_decode($mobile))."',
            `DATE_IN` = '".mysql_real_escape_string(utf8_decode($date_in))."',
            `DATE_OUT` = '".mysql_real_escape_string(utf8_decode($date_out))."'
            WHERE `ID` = '".$user."';";
            $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
            $data1 = mysql_fetch_array($req);
            $data = $profil->updateProfil($civilite, $nom, $prenom, $participe, $isvalid, $isprivilegie, $societe, $typesoc, $secteur, $fonction, $adresse, $adresse2, $cp, $ville, $email, $tel, $mobile, $date_in, $date_out, $user);

            $error = "Les paramètres ont bien été mis à jour.";
            $color = "#28a745";
            $valid = "0";


        } else{
            $error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
            $color = "#FF0000";
            $valid = "0";
            if ($nom == ''){echo "<style>#nom{border-color:#ff0000;}</style>";}
        }
    }
    
}
$db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
 mysqli_select_db($db, 'BddIdec');
mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET utf8");
mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");
$data = $profil->findOneById($user);
$data1 = $usr->findOneById($_SESSION['id']);


if($data1['STATUT'] == 1){
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
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
		<link rel="icon" href="images/favicon.ico" type="image/png">
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
            
        #date_in, #date_out {
            padding-left: 70px;
        }
            
       .date_debut_fin {
            position: relative;
            margin-left: 1em;
            height: 45px;
            line-height: 45px;
            color: #bbb !important;
            /*! width: 25%; */
            float: left;
        }

       #date_in, #date_out {

    padding-left: 10px;
    width: 25%;
    float: left;
    margin-left: 10px;

}

        
            
            @media screen and (min-width: 1681px) {
            
                #date_in, #date_out {
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
                            
                            <form method="post" action="settings-profil.php?user=<?php echo $data['ID']; ?>" enctype="multipart/form-data">
                                <input type="hidden" id="form1" name="form1" class="form1" value="form1">
                                <div class="row uniform">
                                   <div class="6u 12u$(xsmall)" style="text-align: left;">
                                     <input id="settings_participe" name="participe" class="settings_participe" type="checkbox" value="1" <?php if($data["PARTICIPATION"] == "1"){echo "checked";} ?>><label for="settings_participe" class="settings_accueil" style="margin-bottom: 0;">PARTICIPERA</label>
                                     <input id="settings_isvalid" name="isvalid" class="settings_isvalid" type="checkbox" value="1" <?php if($data["ISVALID"] == "1"){echo "checked";} ?>><label for="settings_isvalid" class="settings_isvalid" style="margin-bottom: 0;">COMPTE VALIDE</label>
                                   </div>
                                    <div class="6u 12u$(xsmall)" style="text-align: left;">
                                        <span class="date_debut_fin">Arrive le : </span>
                                        <input type="date" name="date_in" id="date_in" value="<?php echo $data['DATE_IN']; ?>">
                                        <span class="date_debut_fin">Part le : </span>
                                        <input type="date" name="date_out" id="date_out" value="<?php echo $data['DATE_OUT']; ?>">
                                   </div>

                                      <div class="6u 12u$(xsmall)" style="text-align: left;"> 
                                      <input id="settings_isprivilegie" name="isprivilegie" class="settings_isprivilegie" type="checkbox" value="1" <?php if($data["ISPRIVILEGIE"] == "1"){echo "checked";} ?>>
                                      <label for="settings_isprivilegie" class="settings_isprivilegie" style="margin-bottom: 0;">COMPTE PRIVILEGIE</label></div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;">
                                        
                                    </div>


                                    <div class="6u 12u$(xsmall)">
                                       <input type="text" name="civilite" id="civilite" value="<?php echo $data['CIVILITE']; ?>"  placeholder="Civilité du participant" style="width: 20%;float: left;">
                                      <input type="text" name="nom" id="nom" value="<?php echo $data['NOM']; ?>" placeholder="Nom du participant" style="width: 70%;float: left;margin-left: 10px;">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="prenom" id="prenom" value="<?php echo $data['PRENOM']; ?>" placeholder="Prénom du participant">
                                    </div>

                                       <div class="6u 12u$(xsmall)" style="text-align: left;">   <span class="date_debut_fin">SOCIETE</span></div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;"></div>
                                    

                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="societe" id="societe" value="<?php echo $data['SOCIETE']; ?>" placeholder="Société">
                                    </div>
                                    
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="fonction" id="fonction" value="<?php echo $data['FONCTION']; ?>" placeholder="Fonction">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="typesoc" id="typesoc" value="<?php echo $data['TYPE_SOC']; ?>" placeholder="Type de société">
                                    </div>
                                     <div class="6u 12u$(xsmall)">
                                        <input type="text" name="secteur" id="secteur" value="<?php echo $data['SECTEUR']; ?>" placeholder="Secteur">
                                    </div>

                                     <div class="6u 12u$(xsmall)" style="text-align: left;">   <span class="date_debut_fin">COORDONNEES</span></div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;"></div>

                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="adresse" id="adresse" value="<?php echo $data['ADRESSE']; ?>" placeholder="Adressse">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="adresse2" id="adresse2" value="<?php echo $data['ADRESSE2']; ?>" placeholder="Adresse2">
                                    </div>


                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="cp" id="cp" value="<?php echo $data['DATE_NAISS']; ?>" placeholder="DATE_NAISS">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="ville" id="ville" value="<?php echo $data['LIEU_NAISS']; ?>" placeholder="Ville">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="email" id="email" value="<?php echo $data['EMAIL']; ?>" placeholder="EMAIL">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="tel" id="tel" value="<?php echo $data['TEL']; ?>" placeholder="TEL">
                                    </div>

                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="mobile" id="mobile" value="<?php echo $data['NATIONALITE']; ?>" placeholder="NATIONALITE">
                                    </div>



                                    <div class="12u$">
                                        <ul class="actions" style="float:left;">
                                            <li><input type="submit" value="Valider les paramètres" class="special" name="valider"></li>
                                        </ul>
                                        <ul class="actions" style="float:right;"><li><a class="button special" href="liste.php?event=<?php echo $data['EVENT_ID']; ?>">RETOUR</a></li></ul>
                                    </div>
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
