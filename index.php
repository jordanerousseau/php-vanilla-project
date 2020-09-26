<?php
session_start() ; // Pour pouvoir utiliser le tableau $_SESSION[]
require("include/methodesBDD.php");
require("include/function.php");

define('ACTION_PAR_DEFAUT','accueil'); // Définit la constante ACTION_PAR_DEFAUT
define('Page404','404'); // Définit la constante de la page 404

 // récupérer l'action à entreprendre dans GET, sinon, c'est l'action par défaut
	if((isset($_GET['action']))&&(!empty($_GET['action']))){
		if(is_dir("actions/".$_GET['action'])){
		  $_SESSION['action']=$_GET['action'] ;
		}
		else{
			$_SESSION['action']=Page404;
		}
	}
	else{
		$_SESSION['action']=ACTION_PAR_DEFAUT;
	}
  
 // Construction du chemin menant aux fichiers gérant l'action à effectuer  
 $_SESSION['chemin']="actions/".$_SESSION['action'].'/' ;
  
  // Gestion de l'action à exécuter
  ob_start() ; // Pour mémoriser tout le texte généré par l'action  
  require($_SESSION['chemin'].'controller.php'); // executer l'action

  // Préparer les information à passer au layout
  $resultatAction=ob_get_clean(); // Pour récupérer le texte généré par l'action
  $nomSite = ' - ResSocUTT';  

  // Faire appel au layout 
  require('layout.php');
?>
