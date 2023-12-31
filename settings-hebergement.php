<?php 

include 'connect-backoffice.php';

require_once './class/sHebergement.php';
require_once './class/User.php';
require_once './class/Event.php';


$hebergement = new sHebergement();
$usr = new User();
$evt = new Event();

$event = $_GET["event"];

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){

	$nomOrigine = $_FILES['PIC_HEBERGEMENT']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin['extension'];
	$extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
    $nomOrigine2 = "banner-hebergement.".$extensionFichier;
	if (!(in_array($extensionFichier, $extensionsAutorisees))) {
	} else {
        
        $dossierimage = "images/".$event;
        if (!file_exists($dossierimage)) {
            mkdir($dossierimage, 0777, true);
        }
        
		$repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
		$nomDestination = $nomOrigine2;

        unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

		if (move_uploaded_file($_FILES["PIC_HEBERGEMENT"]["tmp_name"],$repertoireDestination.$nomDestination)) {

			$data = $hebergement->updateHebergementPic($nomDestination, $event);

		}
	}
    
    $TXT_HEBERGEMENT_ST = $fct->cleanXSS($_POST['TXT_HEBERGEMENT_ST']);
    $NB_HEBERGEMENT = $fct->cleanXSS($_POST['NB_HEBERGEMENT']);

	$data = $hebergement->updateHebergement($TXT_HEBERGEMENT_ST, $NB_HEBERGEMENT, $event);

    $error = "Les informations ont bien été mises à jour.";
    $color = "#28a745";
    $valid = "0";
    
    
    for ($i = 1; $i <= $NB_HEBERGEMENT; $i++) {
        
        $namepicture = "PIC1_HEBERGEMENT_H".$i;
        $oldnamepicture = "OLD_PIC1_HEBERGEMENT_H".$i;
        $nomOrigine = $_FILES[$namepicture]['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $nomOrigine2 = "hebergement-".$i."-1.".$extensionFichier;
        if (!(in_array($extensionFichier, $extensionsAutorisees))) {
        } else {

            $dossierimage = "images/".$event;
            if (!file_exists($dossierimage)) {
                mkdir($dossierimage, 0777, true);
            }

            $repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
            $nomDestination = $nomOrigine2;

            unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

            if (move_uploaded_file($_FILES[$namepicture]["tmp_name"],$repertoireDestination.$nomDestination)) {

	            $hebergement->updateHerbergementPcLoop($namepicture, $nomDestination, $event);

            }
        }
        
        $namepicture = "PIC2_HEBERGEMENT_H".$i;
        $oldnamepicture = "OLD_PIC2_HEBERGEMENT_H".$i;
        $nomOrigine = $_FILES[$namepicture]['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $nomOrigine2 = "hebergement-".$i."-2.".$extensionFichier;
        if (!(in_array($extensionFichier, $extensionsAutorisees))) {
        } else {

            $dossierimage = "images/".$event;
            if (!file_exists($dossierimage)) {
                mkdir($dossierimage, 0777, true);
            }

            $repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
            $nomDestination = $nomOrigine2;

            unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

            if (move_uploaded_file($_FILES[$namepicture]["tmp_name"],$repertoireDestination.$nomDestination)) {

	            $hebergement->updateHerbergementPcLoop($namepicture, $nomDestination, $event);
            }
        }
        
        $namepicture = "PIC3_HEBERGEMENT_H".$i;
        $oldnamepicture = "OLD_PIC3_HEBERGEMENT_H".$i;
        $nomOrigine = $_FILES[$namepicture]['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $nomOrigine2 = "hebergement-".$i."-3.".$extensionFichier;
        if (!(in_array($extensionFichier, $extensionsAutorisees))) {
        } else {

            $dossierimage = "images/".$event;
            if (!file_exists($dossierimage)) {
                mkdir($dossierimage, 0777, true);
            }

            $repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
            $nomDestination = $nomOrigine2;

            unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

            if (move_uploaded_file($_FILES[$namepicture]["tmp_name"],$repertoireDestination.$nomDestination)) {

	            $hebergement->updateHerbergementPcLoop($namepicture, $nomDestination, $event);

            }
        }
        $TXT_HEBERGEMENT_TITRE = "TXT_HEBERGEMENT_H".$i."_TITRE";
        $TXT_HEBERGEMENT_TITRE_CONTENT = $fct->cleanXSS($_POST['TXT_HEBERGEMENT_H'.$i.'_TITRE']);
        $TXT_HEBERGEMENT = "TXT_HEBERGEMENT_H".$i;
        $TXT_HEBERGEMENT_CONTENT = $fct->cleanXSS($_POST['TXT_HEBERGEMENT_H'.$i]);
        $MAP_HEBERGEMENT_H = "MAP_HEBERGEMENT_H".$i;
        $MAP_HEBERGEMENT_CONTENT = $fct->cleanXSS($_POST['MAP_HEBERGEMENT_H'.$i]);

	    $data = $hebergement->updateHebergementAllLoop($TXT_HEBERGEMENT_TITRE, $TXT_HEBERGEMENT, $MAP_HEBERGEMENT_H, $TXT_HEBERGEMENT_TITRE_CONTENT, $TXT_HEBERGEMENT_CONTENT, $MAP_HEBERGEMENT_CONTENT, $event);
    }
}

$eventNom = $evt->getNameById($event);
$data = $hebergement->findAllById($event);
$data1 = $usr->findOneById($_SESSION["id"]);


if($data1['STATUT'] == 1){
    header('Location: backoffice.php');
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Paramètres - <?php echo $eventNom['NOM'] ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <style>.hotel{display: none;}</style>
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

							<h2 id="content" style="color:#f99f1b;">Paramètres - <?php echo $eventNom['NOM'] ?></h2>

                            <?php if (($error != "") && ($valid == "0")) { ?>
                                <div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                                    <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                                </div>
                            <?php } ?>

							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Page à propos</th>
                                        <th style="text-align: right;"><a data-fancybox data-type="iframe" data-src="hebergement.php?event=<?php echo $event; ?>&view=admin" href="javascript:;" style="text-decoration:none;"><i class="fas fa-eye"></i></a></th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <form method="post" action="settings-hebergement.php?event=<?php echo $event; ?>" enctype="multipart/form-data">
                                <div class="row uniform">
                                    <div class="12u$ 12u$(xsmall)">
                                        <div class="fakeinput">Bannière :
                                            <input id="PIC_HEBERGEMENT" name="PIC_HEBERGEMENT" class="fake-btn" type="file" onchange="displayContent(event, 0, 0)">
                                            <input type="button" class="real-button" onclick="document.getElementById('PIC_HEBERGEMENT').click()" value="choisir une photo">
                                            <p class="out-0-0 outout"></p>
                                            <?php if($data["PIC_HEBERGEMENT"] != ""){
                                                echo'
                                                    <a href="delete.php?picture='.$data['PIC_HEBERGEMENT'].'&url=settings-hebergement.php&event='.$event.'&jour=PIC_HEBERGEMENT" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a data-fancybox="images" href="images/'.$event.'/'.$data["PIC_HEBERGEMENT"].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                        <div class="miniature" style="background: url(images/'.$event.'/'.$data["PIC_HEBERGEMENT"].')"></div>
                                                    </a>';
                                            } ?>
                                        </div>
                                        <input type="hidden" id="OLD_PIC_HEBERGEMENT" name="OLD_PIC_HEBERGEMENT" value="<?php echo $data['PIC_HEBERGEMENT']; ?>">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TXT_HEBERGEMENT_ST" id="TXT_HEBERGEMENT_ST" value="<?php echo $data['TXT_HEBERGEMENT_ST']; ?>" placeholder="Sous-titre">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <select name="NB_HEBERGEMENT" id="NB_HEBERGEMENT">
										    <option id="H0" value="0" <?php if($data["NB_HEBERGEMENT"] == "0"){echo "selected";} ?>>Nombre d'hôtel</option>
										    <option id="H1" value="1" <?php if($data["NB_HEBERGEMENT"] == "1"){echo "selected";} ?>>1 hôtel</option>
										    <option id="H2" value="2" <?php if($data["NB_HEBERGEMENT"] == "2"){echo "selected";} ?>>2 hôtels</option>
										    <option id="H3" value="3" <?php if($data["NB_HEBERGEMENT"] == "3"){echo "selected";} ?>>3 hôtels</option>
                                        </select>
                                    </div>
                                    <?php for ($i = 1; $i <= 3; $i++) {
                                    $PIC1_HEBERGEMENT_H = "PIC1_HEBERGEMENT_H".$i;
                                    $PIC2_HEBERGEMENT_H = "PIC2_HEBERGEMENT_H".$i;
                                    $PIC3_HEBERGEMENT_H = "PIC3_HEBERGEMENT_H".$i;
                                    $TXT_HEBERGEMENT_H_TITRE = "TXT_HEBERGEMENT_H".$i."_TITRE";
                                    $TXT_HEBERGEMENT_H = "TXT_HEBERGEMENT_H".$i;
                                    $MAP_HEBERGEMENT_H = "MAP_HEBERGEMENT_H".$i;
                                    ?>
                                    <div class="4u<?php if($i % 3 == 0){echo '$';} ?> 12u$(medium) H<?php echo $i; ?> hotel" <?php if($data["NB_HEBERGEMENT"] >= $i){echo "style='display:block;'";} ?>>
                                        <div class="row uniform">
                                            <div class="12u$ 12u$(xsmall)" style="padding-top: 0;">
                                                <div class="separator">Hôtel <?php echo $i; ?></div>
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <div class="fakeinput">Photo 1 :
                                                    <input id="PIC1_HEBERGEMENT_H<?php echo $i; ?>" name="PIC1_HEBERGEMENT_H<?php echo $i; ?>" type="file" class="fake-btn" onchange="displayContent(event, 1, <?=$i?>)">
                                                    <input type="button" value="choisir une photo" style="width: calc(100% - 120px);" onclick="document.getElementById('PIC1_HEBERGEMENT_H<?php echo $i; ?>').click()" class="real-button">
                                                    <p class="out-1-<?=$i?>"></p>
                                                    <?php if($data[$PIC1_HEBERGEMENT_H] != ""){
                                                        echo'
                                                            <a href="delete.php?picture='.$data[$PIC1_HEBERGEMENT_H].'&url=settings-hebergement.php&event='.$event.'&jour=PIC1_HEBERGEMENT_H'.$i.'" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a data-fancybox="images_J'.$i.'" href="images/'.$event.'/'.$data[$PIC1_HEBERGEMENT_H].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                                <div class="miniature" style="background: url(images/'.$event.'/'.$data[$PIC1_HEBERGEMENT_H].')"></div>
                                                            </a>';
                                                    } ?>
                                                </div>
                                                <input type="hidden" id="OLD_PIC1_HEBERGEMENT_H<?php echo $i; ?>" name="OLD_PIC1_HEBERGEMENT_H<?php echo $i; ?>" value="<?php echo $data[$PIC1_HEBERGEMENT_H]; ?>">
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <div class="fakeinput">Photo 2 :
                                                    <input id="PIC2_HEBERGEMENT_H<?php echo $i; ?>" name="PIC2_HEBERGEMENT_H<?php echo $i; ?>" type="file" class="fake-btn" onchange="displayContent(event, 2, <?=$i?>)">
                                                    <input type="button" value="choisir une photo" style="width: calc(100% - 120px);" onclick="document.getElementById('PIC2_HEBERGEMENT_H<?php echo $i; ?>').click()" class="real-button">
                                                    <p class="out-2-<?=$i?>"></p>

                                                    <?php if($data[$PIC2_HEBERGEMENT_H] != ""){
                                                        echo'
                                                            <a href="delete.php?picture='.$data[$PIC2_HEBERGEMENT_H].'&url=settings-hebergement.php&event='.$event.'&jour=PIC2_HEBERGEMENT_H'.$i.'" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a data-fancybox="images_J'.$i.'" href="images/'.$event.'/'.$data[$PIC2_HEBERGEMENT_H].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                                <div class="miniature" style="background: url(images/'.$event.'/'.$data[$PIC2_HEBERGEMENT_H].')"></div>
                                                            </a>';
                                                    } ?>
                                                </div>
                                                <input type="hidden" id="OLD_PIC2_HEBERGEMENT_H<?php echo $i; ?>" name="OLD_PIC2_HEBERGEMENT_H<?php echo $i; ?>" value="<?php echo $data[$PIC2_HEBERGEMENT_H]; ?>">
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <div class="fakeinput">Photo 3 :
                                                    <input id="PIC3_HEBERGEMENT_H<?php echo $i; ?>" name="PIC3_HEBERGEMENT_H<?php echo $i; ?>" type="file" class="fake-btn" onchange="displayContent(event, 3, <?=$i?>)">
                                                    <input type="button" value="choisir une photo" style="width: calc(100% - 120px);" onclick="document.getElementById('PIC3_HEBERGEMENT_H<?php echo $i; ?>').click()" class="real-button">
                                                    <p class="out-3-<?=$i?>"></p>
                                                    <?php if($data[$PIC3_HEBERGEMENT_H] != ""){
                                                        echo'
                                                            <a href="delete.php?picture='.$data[$PIC3_HEBERGEMENT_H].'&url=settings-hebergement.php&event='.$event.'&jour=PIC3_HEBERGEMENT_H'.$i.'" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a data-fancybox="images_J'.$i.'" href="images/'.$event.'/'.$data[$PIC3_HEBERGEMENT_H].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                                <div class="miniature" style="background: url(images/'.$event.'/'.$data[$PIC3_HEBERGEMENT_H].')"></div>
                                                            </a>';
                                                    } ?>
                                                </div>
                                                <input type="hidden" id="OLD_PIC3_HEBERGEMENT_H<?php echo $i; ?>" name="OLD_PIC3_HEBERGEMENT_H<?php echo $i; ?>" value="<?php echo $data[$PIC3_HEBERGEMENT_H]; ?>">
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <input type="text" name="TXT_HEBERGEMENT_H<?php echo $i; ?>_TITRE" id="TXT_HEBERGEMENT_H<?php echo $i; ?>_TITRE" value="<?php echo $data[$TXT_HEBERGEMENT_H_TITRE]; ?>" placeholder="Titre de l'hôtel <?php echo $i; ?>">
                                            </div>
                                            <div class="12u$">
                                                <textarea name="TXT_HEBERGEMENT_H<?php echo $i; ?>"  class="summernote" id="TXT_HEBERGEMENT_H<?php echo $i; ?>" placeholder="Contenu de l'hôtel <?php echo $i; ?>" rows="6"><?php echo $data[$TXT_HEBERGEMENT_H]; ?></textarea>
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <input type="text" name="MAP_HEBERGEMENT_H<?php echo $i; ?>" id="MAP_HEBERGEMENT_H<?php echo $i; ?>" value="<?php echo $data[$MAP_HEBERGEMENT_H]; ?>" placeholder="Adresse postale de l'hôtel <?php echo $i; ?> pour Google Maps">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="12u$">
                                        <ul class="actions" style="float:left;">
                                            <li><input type="submit" value="Valider" class="special" name="valider"></li>
                                        </ul>
                                        <ul class="actions" style="float:right;"><li><a class="button special" href="settings.php?event=<?php echo $event; ?>">RETOUR</a></li></ul>
                                    </div>
                                </div>
                            </form>

						</div>

					</div>

				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
            <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
            <script>
                var displayContent = function (event, a, b) {
                    var output = document.getElementsByClassName('out-' + a + '-' + b);
                        output[0].innerHTML = event.target.files[0].name;
                }
            </script>
			<script type="text/javascript">
				$(document).ready(function() {

                  $('.summernote').summernote({
                        height: 100,
                    });

					$('.confirm').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette photo ?")) {
							location.href = this.href;
						}
					});
                    
                    $("#NB_HEBERGEMENT").change(function(){
                      var id = $(this).find("option:selected").attr("id");

                      switch (id){
                        case "H0":
                          $(".H1").css("display","none");
                          $(".H2").css("display","none");
                          $(".H3").css("display","none");
                          break;
                        case "H1":
                          $(".H1").css("display","block");
                          $(".H2").css("display","none");
                          $(".H3").css("display","none");
                          break;
                        case "H2":
                          $(".H1").css("display","block");
                          $(".H2").css("display","block");
                          $(".H3").css("display","none");
                          break;
                        case "H3":
                          $(".H1").css("display","block");
                          $(".H2").css("display","block");
                          $(".H3").css("display","block");
                          break;
                      }
                    });
				});
			</script>

	</body>
</html>
