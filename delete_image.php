<?php
session_start() ; // Pour pouvoir utiliser le tableau $_SESSION[]
require("include/methodesBDD.php");
require("include/function.php");

if(isset($_POST['image'])){
	if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
			$id_profil = $_SESSION['id_profil'];
			$image = $_POST['image'];
			@$decode = convert_uudecode(base64_decode($image));
			
			$requete_url_photo = $SQL->ExecuteSQL("select url_photo from profil_photos where id_photo='$decode'");
			$url_photo = $SQL->ResSQL($requete_url_photo);
			
			unlink($url_photo->url_photo);
			
			$supprime = $SQL->ExecuteSQL("delete from profil_photos where id_photo='$decode'");
			
			$requete_profil = $SQL->ExecuteSQL("select * from profil where id_profil=$id_profil");
			$profil = $SQL->ResSQL($requete_profil);
			Tracabilite($profil->prenom." ".$profil->nom." vient de supprimer une image");
			
			echo "La photo a été supprimé de votre profil.";
	}
}

?>