<?php
session_start() ; // Pour pouvoir utiliser le tableau $_SESSION[]
require("include/methodesBDD.php");
require("include/function.php");

if(isset($_POST['user'])){
	if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
			$user = $_POST['user'];
			@$decode = convert_uudecode(base64_decode($user));
			$id_profil=$_SESSION['id_profil'];
			$type=$_POST['type'];
			
			$requete = $SQL->ExecuteSQL("select * from profil_relations where id_profil=$id_profil and utilisateur=$decode and type='$type'");
			
			$resultat = $SQL->RetourneNbRequetes($requete);
			
			if($resultat){
				echo "Vous avez déjà ajouté ce profil à votre liste de relation.";
			}
			else{
				$requete = $SQL->ExecuteSQL("insert into profil_relations (type,utilisateur,id_profil) values ('$type',$decode,$id_profil)");
				$requete_profil = $SQL->ExecuteSQL("select * from profil where id_profil=$id_profil");
				$profil = $SQL->ResSQL($requete_profil);
				$requete_relation = $SQL->ExecuteSQL("select * from profil where id_profil=$decode");
				$relation = $SQL->ResSQL($requete_relation);
				Tracabilite($profil->prenom." ".$profil->nom." vient d\'\ajouter ".$relation->prenom." ".$relation->nom." dans ses relations ($type)");
				echo "Profil ajouté à votre liste de relation.";
			}
	}
}

?>