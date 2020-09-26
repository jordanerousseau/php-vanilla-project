<?php
session_start() ; // Pour pouvoir utiliser le tableau $_SESSION[]
require("include/methodesBDD.php");
require("include/function.php");

if(isset($_POST['user'])){
	$user=$_POST['user'];
	
	$requete = $SQL->ExecuteSQL("select * from profil where id_profil=$user");
	$execute = $SQL->ResSQL($requete);
	$login = $execute->login;
	
	$profil = $SQL->ExecuteSQL("delete from profil where id_profil=$user");
	$competences = $SQL->ExecuteSQL("delete from profil_competences where id_profil=$user");
	$photos = $SQL->ExecuteSQL("delete from profil_photos where id_profil=$user");
	$relations = $SQL->ExecuteSQL("delete from profil_relations where id_profil=$user");
	$relations_bis = $SQL->ExecuteSQL("delete from profil_relations where utilisateur=$user");
	$competences = $SQL->ExecuteSQL("delete from profil_visibility where id_profil=$user");
	$logs = $SQL->ExecuteSQL("delete from administration where id_profil=$user");
	
	sup_repertoire("../images/".$login);

	echo "La profil a été supprimé du réseau";
}

?>