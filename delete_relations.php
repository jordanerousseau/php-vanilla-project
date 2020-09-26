<?php
session_start() ; // Pour pouvoir utiliser le tableau $_SESSION[]
require("include/methodesBDD.php");
require("include/function.php");

if(isset($_POST['user'])){
	if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
		
		$id_profil = $_SESSION['id_profil'];
		$user = $_POST['user'];
		$type=$_POST['type'];
		@$decode = convert_uudecode(base64_decode($user));
			
		$requete_supprime = $SQL->ExecuteSQL("delete from profil_relations where utilisateur=$decode and type='$type'");
			
		$requete_profil = $SQL->ExecuteSQL("select * from profil where id_profil=$id_profil");
		$profil = $SQL->ResSQL($requete_profil);
		$requete_relation = $SQL->ExecuteSQL("select * from profil where id_profil=$decode");
		$relation = $SQL->ResSQL($requete_relation);
		Tracabilite($profil->prenom." ".$profil->nom." vient de supprimer ".$relation->prenom." ".$relation->nom." ($type)");
			
		echo "Ce profil a été supprimé de vos relations.";
	}
}

?>