<?php
session_start() ; // Pour pouvoir utiliser le tableau $_SESSION[]
require("include/methodesBDD.php");
require("include/function.php");

if(isset($_GET['term'])){

	$return_arr = array();
	if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
		$stmt = $SQL->ExecuteSQL('select distinct p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and (v.nom_visibility="Public" and v.prenom_visibility="Public" and p.id_profil!='.$_SESSION['id_profil'].' and (p.prenom like "%'.$_GET['term'].'%" or p.nom like "%'.$_GET['term'].'%")) or (p.prenom like (select p.prenom from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.prenom like "%'.$_GET['term'].'%") or p.nom like (select p.nom from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.nom like "%'.$_GET['term'].'%"))');	
	}	
	else{
		$stmt = $SQL->ExecuteSQL('select p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and v.nom_visibility="Public" and v.prenom_visibility="Public" and (p.prenom like "%'.$_GET['term'].'%" or p.nom like "%'.$_GET['term'].'%")');
	}
		
	while($row = $SQL->ResSQL($stmt)) {
		$return_arr[] =  $row->prenom.' '.$row->nom;
	}

	echo json_encode($return_arr);
}

?>