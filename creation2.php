
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mémé</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="assets/css/style_users.css">
    <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>
    <script type='text/javascript'>//<![CDATA[
      $(window).load(function(){
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function(){
        readURL(this);
      });
      });//]]>
    </script>

</head>

<body id="body_cration">
    <div>
        <div class="container">
            <div class="row">
               <h1>Bienvenu dans le Méme Générator...!</h1> &nbsp&nbsp&nbsp
               <!-- <button class="btn btn-primary" name="button">Choisir votre photo</button> -->
                 <input type='file' id="imgInp"  class="btn btn-primary" style="border-radius:25px"/>
              </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                  <h2>Gallerie</h2>
              </div>
                <div class="row">
                  <div class="col-md-2"> <a href="#blah"><img src="image/tof1.jpg" alt="image_1" style=" width:150px; height:150px; border-radius:25px " onclick="document.getElementById('blah').src='image/tof1.jpg'"></a> </div>
                  <div class="col-md-2"><a href="#blah"><img src="image/tof2.jpg" alt="image_2" style=" width:150px; height:150px; border-radius:25px " onclick="document.getElementById('blah').src='image/tof2.jpg'"></a></div>
                  <div class="col-md-2"><a href="#blah"><img src="image/tof3.jpg" alt="image_3" style=" width:150px; height:150px; border-radius:25px " onclick="document.getElementById('blah').src='image/tof3.jpg'"></a></div>
                  <div class="col-md-2"><a href="#blah"><img src="image/tof4.jpg" alt="image_4" style=" width:150px; height:150px; border-radius:25px " onclick="document.getElementById('blah').src='image/tof4.jpg'"></a></div>
                  <div class="col-md-2"><a href="#blah"><img src="image/tof5.jpg" alt="image_2" style=" width:150px; height:150px; border-radius:25px " onclick="document.getElementById('blah').src='image/tof5.jpg'"></a></div>
                  <div class="col-md-2"><a href="#blah"><img src="image/tof6.jpg" alt="image_4" style=" width:150px; height:150px; border-radius:25px " onclick="document.getElementById('blah').src='image/tof6.jpg'"></a></div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form class="form-groups" id="form1" runat="server">
                  <br>
                  <br>
                  <div  id="memecanvas">
                      <img id="blah" class="img-fluid" src="#" alt="" style=" width:620px; height:470px; border-radius:25px "/>
                  </div>
                  <div class="gr_txt1">
                      <input type="text" class="form-control" name="bottom_text" value="" style="border-radius:25px">
                      <label>Votre Texte 1</label>
                      <br>
                      <br>
                      <input type="text" class="form-control" name="txt_1" value="" style="border-radius:25px">
                      <label>Votre Texte 2</label>
                      <br>
                      <br>
                      <label>Couleur du Texte</label><br>
                      <input type="color" name="palette" value="" style="border-radius:25px">
                      <br>
                      <br>
                      <label>Taille du Texte</label>
                      <br>
                      <input type="range" class="form-control-range" name="" value="">
                      <br>
                      <br>
                      <button class="btn btn-primary btn-lg" name="#" style="border-radius:25px">Sauvegarder</button>
                  </div>
                  </form>
              </div>
              </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="row"></div>
            <div class="row"></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php
if (isset($_FILES['fichier']))
{
	//$_FILES existe on récupère les infos qui nous intéressent
	$fichier=$_FILES['fichier']['name'];//nom réel de l'image
	$size=$_FILES['fichier']['size']; //poids de l'image en octets
	$tmp=$_FILES['fichier']['tmp_name'];//nom temporaire de l'image (sur le serveur)
	$type=$_FILES['fichier']['type'];//type de l'image
	//On récupère la taille de l'image
	//list($width,$height)=getimagesize($tmp);
	if (is_uploaded_file($tmp)) //permet de vérifier si le fichier a été uplodé via http
	{
		//vérification du type de l'img, son poids et sa taille
		if ($type=="images")
		{
			// type mime gif, poids < à 20500 octets soit environ 20Ko, largeur = hauteur = 100px
			//Pour supprimer les espaces dans les noms de fichiers car celà entraîne une erreur lorsque vous voulez l'afficher
			$fichier = preg_replace ("` `i","",$fichier);//ligne facultative :)
			//On vérifie s'il existe une image qui a le même nom dans le répertoire
			if (file_exists('./images'.$fichier))
			{
				//Le fichier existe on rajoute dans son nom le timestamp du moment pour le différencier de la première (comme cela on est sûr de ne pas avoir 2 images avec le même nom :) )
				$nom_final= preg_replace("`.*`is",date("U").".*",$fichier);
			}
			else {
				$nom_final=$fichier; //l'image n'existe pas on garde le même nom
			}
			//on déplace l'image dans le répertoire final
			 move_uploaded_file($tmp,'./images'.$nom_final);
			//Message indiquant que tout s'est bien passé
			echo "L'image a été uploadée avec succès<br/>";
		}
		else {
			//Le type mime, ou la taille ou le poids est incorrect
			// echo 'Votre image a été rejetée (poids, taille ou type incorrect)';
		}
	}
}

?>
