<?php
try {
 $pdo= new PDO('mysql:host=localhost;dbname=meme_generator','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (Exception $e) {
	die('erreurs'.$e->getMessage());
	echo "erreur de connection avec la base";
}
?>
