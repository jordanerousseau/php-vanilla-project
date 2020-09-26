<?php

//Traitement de l'affichage des infos de la partie public du site


/****************************************************/
/*******************  Générale  *********************/
/****************************************************/

//Variable de validations
$userMessage = array("L'ajout a bien été effectué.", "La modification a bien été effectué.", "La suppression a bien été effectué.", "Le formulaire est incomplet !", "Identification incorrecte.");
$classMessage = array("messageIncorrect", "messageCorrect");

//Variable du formulaire d'inscription
$variables = array("sexe"=>"",
					"nom"=>"",
					"prenom"=>"",
					"programme"=>"",
					"semestre"=>"",
					"login"=>"",
					"password"=>"",
					"repassword"=>"",
					"competences"=>"",
					"sexe_visibility"=>"",
					"nom_visibility"=>"",
					"prenom_visibility"=>"",
					"programme_visibility"=>"",
					"semestre_visibility"=>"",
					"photos_visibility"=>"",
					"competences_visibility"=>"",
					"relations_visibility"=>"");

$sexe_tab = array("Homme","Femme");
$programme_tab = array("ISI","SRT","SI","SM","Master","Licence");
$semestre_tab = range(1,8);
$competences_tab = array("Programmation"=>array("PHP","HTML/CSS","ASP","C/C++"),"Langue"=>array("Français","Anglais","Espagnol","Portugais","Italien"),"Divers"=>array("Je ne sais rien faire","Draguer","Je sais tout faire"));
$criteres = array("Prive","Amis","Public");
$extensions = array('.png', '.gif', '.jpg');
$relations_tab = array('Je flashe sur','Je le connais','Je suis ami(e) avec','Je travaille avec');

//variable validation formulaire d'inscription
$valideMessage = array("Veuillez spécifier votre sexe","Veuillez indiquer votre nom","Veuillez indiquer votre prénom","Veuillez choisir un programme","Veuillez indiquer votre semestre","Veuillez choisir un identifiant qui n'existe pas","Veuillez choisir un mot de passe","Veuillez confirmer votre mot de passe","Les champs mot de passe et confirmation ne sont pas identiques","Veuillez ajouter des photos (la taille maximum est de 1 MO par photo)<br />Attention : seules les extensions png, gif et jpg sont acceptés","Veuillez choisir au moins une compétence dans la liste","Veuillez régler la visibilité de vos informations","Veuillez vérifier votre photo");


//Tronque une chaine au mot
function coupeMot($chaine, $lengthMax){
	if (strlen($chaine) > $lengthMax){
		$chaine = substr($chaine, 0, $lengthMax);
		$last_space = strrpos($chaine, " ");
		$chaine = substr($chaine, 0, $last_space)."...";
	}
	return $chaine;
}

function clean($str){
	/** Mise en minuscules */
	$str = strtolower($str);
	/** strtr() sait gérer le multibyte */
	$str = strtr($str, array(
	'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'a'=>'a', 'a'=>'a', 'a'=>'a', 'ç'=>'c', 'c'=>'c', 'c'=>'c', 'c'=>'c', 'c'=>'c', 'd'=>'d', 'd'=>'d', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'e'=>'e', 'e'=>'e', 'e'=>'e', 'e'=>'e', 'e'=>'e', 'g'=>'g', 'g'=>'g', 'g'=>'g', 'h'=>'h', 'h'=>'h', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'i'=>'i', 'i'=>'i', 'i'=>'i', 'i'=>'i', 'i'=>'i', '?'=>'i', 'j'=>'j', 'k'=>'k', '?'=>'k', 'l'=>'l', 'l'=>'l', 'l'=>'l', '?'=>'l', 'l'=>'l', 'ñ'=>'n', 'n'=>'n', 'n'=>'n', 'n'=>'n', '?'=>'n', '?'=>'n', 'ð'=>'o', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'o'=>'o', 'o'=>'o', 'o'=>'o', 'œ'=>'o', 'ø'=>'o', 'r'=>'r', 'r'=>'r', 's'=>'s', 's'=>'s', 's'=>'s', 'š'=>'s', '?'=>'s', 't'=>'t', 't'=>'t', 't'=>'t', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'w'=>'w', 'ý'=>'y', 'ÿ'=>'y', 'y'=>'y', 'z'=>'z', 'z'=>'z', 'ž'=>'z'
	));
	return $str;
}

//Affichage de la classe sur le body en focntion du nom de l'action
function classBody(){
	if($_SESSION['action']!="accueil"){
		$class = 'not-front '.$_SESSION['action'];
		}
		else{
			$class = 'front '.$_SESSION['action'];
			}
	return $class;
}

/****************************************************/
/*****  Fonctions du formulaire d'inscription  ******/
/****************************************************/

//fonction pour créer des input
function input($label,$name,$type,$value){
	echo '<label for="'.$name.'">'.$label.'</label>';
	echo '<input name="'.$name.'" id="'.$name.'" type="'.$type.'" value="'.$value.'" class="required input_field" />';
}

//Fonction pour créer dans champs radio
function radio($label,$name,$tableau,$value){
	echo '<label>'.$label.'</label>';
	echo '<div class="champs radio">';
	foreach ($tableau as $valeur){
		if($valeur == $value){
			echo '<label for="'.strtolower($valeur).'">'.$valeur.'</label><input type="radio" id="'.strtolower($valeur).'" name="'.$name.'" value="'.$valeur.'" checked="checked" />';	
		}
		else{
			echo '<label for="'.strtolower($valeur).'">'.$valeur.'</label><input type="radio" id="'.strtolower($valeur).'" name="'.$name.'" value="'.$valeur.'" />';
		}
	}
	echo '</div>';
}

//Fonction pour créer des champs select à selection unique
function select_simple($label,$tableau,$name,$value){
	echo '<label>'.$label.'</label>';
	echo '<select name="'.$name.'" class="champs select" size="1">';
	echo '<option value="0">--- Choisissez un item ---></option>';
	foreach ($tableau as $valeur){
		if($valeur == $value){
			echo '<option value="'.$valeur.'" selected="selected">'.$valeur.'</option>';
		}
		else{
			echo '<option value="'.$valeur.'">'.$valeur.'</option>';
		}
	}
	echo '</select>';
}


//Fonction pour créer des champs à selection multiple
function select_multiple($label,$tableau,$name,$size,$value){
	echo '<label class="labelMultiple">'.$label.'</label>';
	echo '<select name="'.$name.'" multiple="multiple" size="'.$size.'" class="champs multiple">';
	foreach ($tableau as $cle=>$tab){
		echo '<optgroup label="'.$cle.'">';
		foreach($tab as $valeur){
			if(in_array($valeur,$value)){
				echo '<option value="'.$valeur.'" selected="selected">'.$valeur.'</option>';
			}
			else{
				echo '<option value="'.$valeur.'">'.$valeur.'</option>';
			}
		}
		echo '</optgroup>';
	}
	echo '</select>';
	
}


//Fonction pour créer des champs fichier
function fichier($label,$name){
	echo '<label for="'.$name.'">'.$label.'</label>';
	echo '<input type="file" name="'.$name.'" id="'.$name.'" class="required file" size="27" />';
}

/****************************************************/
/*  Fonction ajout profil dans la base de données  **/
/****************************************************/

function verif_login($login){
	global $SQL;
	
	$verif = $SQL->ExecuteSQL("select * from profil where login='$login'");
	$result = $SQL->RetourneNbRequetes($verif);
	return $result;
}

function ajout_profil($formulaire){
	global $SQL;

	extract($formulaire);
	//inscription de base
	$creation_profil = "insert into profil (login,password,nom,prenom,sexe,programme,semestre) values ('$login','$password','$nom','$prenom','$sexe','$programme','$semestre')";
	$inscription = $SQL->ExecuteSQL($creation_profil);
	//on récupère l'id du profil pour les autres éléments
	$requete_profil = $SQL->ExecuteSQL("select * from profil where login='$login'");
	$profil = $SQL->ResSQL($requete_profil);
	$_SESSION['id_profil'] = $profil->id_profil;
	//Ajout des compétences
	foreach($competences as $element){
		$ajout_competence =  $SQL->ExecuteSQL("insert into profil_competences (competences,id_profil) values ('$element','$profil->id_profil')");
	}
	//Ajout des critéres des visibilités
	$ajout_visibility = $SQL->ExecuteSQL("insert into profil_visibility (nom_visibility,prenom_visibility,sexe_visibility,competences_visibility,photos_visibility,semestre_visibility,programme_visibility,relations_visibility,id_profil) values ('Prive','Prive','Public','Amis','Prive','Public','Public','Amis','$profil->id_profil')");
	
	//Ajout des photos dans un répertoire pour l'utilisateur
	mkdir("images/".$login,0700);//Créer le répertoire pour l'utilisateur
	
	$uploadpath="images/".$login."/";
	
	foreach($_FILES as $key => $value){
		if ((isset($_FILES[$key]['tmp_name']))&&($_FILES[$key]['error'] == UPLOAD_ERR_OK)){
			move_uploaded_file($_FILES[$key]['tmp_name'], $uploadpath.$_FILES[$key]['name']);
			$name_photo = $_FILES[$key]['name'];
			$url_photo = $uploadpath.$_FILES[$key]['name'];
			$ajout_photo =  $SQL->ExecuteSQL("insert into profil_photos (nom_photo,url_photo,id_profil) values ('$name_photo','$url_photo','$profil->id_profil')");
		}
		else{
			echo "<p>Erreur sur le fichier ".$key."</p>";
		}
	}
	
	echo '<p>Bravo, votre inscription est maintenant terminée et vous pouvez dès à présent vous connecter sur la plateforme.</p>';
	echo '<p><a href="index.php?action=connexion" title="Accéder à votre profil">Se connecter à la plateforme</a></p>';
}

/****************************************************/
/************  Fonctions due tracabilite  ***********/
/****************************************************/

function Tracabilite($description){
	global $SQL;
	//Fonction permettant de réaliser pour chaque internaute d'enregistrer la date, l'heure et une description de l'évènement effectué sur le site
	
	$date=date("d-m-Y");
	$heure=date("H:i");
	$id_profil = $_SESSION['id_profil'];
	$requete_ajout = $SQL->ExecuteSQL("insert into administration (date,heure,description,id_profil) values ('$date','$heure','$description',$id_profil)");	
}

/****************************************************/
/********  Fonctions connexion / deconnexion  *******/
/****************************************************/

function connexion($login,$password){
	global $SQL;

	$requete_connect = $SQL->ExecuteSQL("select * from profil where login='".$login."' and password='".$password."'");
	$result = $SQL->RetourneNbRequetes($requete_connect);
	$connect = $SQL->ResSQL($requete_connect);
	if($result != 0){
		$_SESSION['id_profil'] = $connect->id_profil;
		$_SESSION['login_profil'] = $connect->login;
	}
}

function deconnexion(){
	session_destroy();
	die('<meta http-equiv="refresh" content="0;URL=index.php">');
}

/****************************************************/
/****************  Fonctions profil  ****************/
/****************************************************/

function afficher_profil($tableau,$id_profil){
	global $SQL,$relations_tab;

	//Requettes pour récuperer les informations
	$requete_profil = $SQL->ExecuteSQL("select * from profil where id_profil='$id_profil'");
	$requete_competences = $SQL->ExecuteSQL("select * from profil_competences where id_profil='$id_profil'");
	$requete_photos = $SQL->ExecuteSQL("select * from profil_photos where id_profil='$id_profil'");
	$requete_relations = $SQL->ExecuteSQL("select p.id_profil,p.nom,p.prenom, r.type from profil as p,profil_relations as r where p.id_profil=r.utilisateur and r.id_profil='$id_profil' order by r.type");
	$requete_visibility = $SQL->ExecuteSQL("select * from profil_visibility where id_profil='$id_profil'");
	
	//Stocker les informations dans des variables
	$profil = $SQL->TabResSQL($requete_profil);
	$id_competences = $SQL->RetourneNbRequetes($requete_competences);
	$id_photos = $SQL->RetourneNbRequetes($requete_photos);
	$id_relations = $SQL->RetourneNbRequetes($requete_relations);
	$visibility = $SQL->TabResSQL($requete_visibility);
	
	echo "<h2>Paramètres du compte</h2>";
	
	echo '
	<div class="section profil">
		<h3>Informations personnelles</h3>';
		foreach($profil as $key => $value){
			if(($key!="id_profil")&&($key!="password")&&($key!="login")){
				$visible = clean($visibility[$key."_visibility"]);
				echo '<div class="'.$visible.'">';
				echo '<h4>'.ucfirst($key).' : </h4>';
				echo '<p>'.$value.'</p>';
				echo '<div class="cleaner h10"></div>';
				echo '</div>';
			}
		}	
	echo '</div>';
	
	echo '<div class="cleaner h30"></div>';
	
	if($id_competences){
	
		echo '
	<div class="section profil">
		<h3>Compétences par domaine</h3>';
		for($i=1;$i<=$id_competences;$i++){
			$competence = $SQL->ResSQL($requete_competences);
			foreach($tableau as $cle => $valeur){
				if(in_array($competence->competences,$valeur)){
					$tab_competences[$cle][]=$competence->competences;
				}
			}
		}
		foreach ($tab_competences as $key => $tab){
			echo '<div class="'.clean($visibility["competences_visibility"]).'">';
			echo '<h4>'.ucfirst($key).' : </h4>';
			echo '<p>'.implode(", ",$tab).'</p>';
			echo '<div class="cleaner h10"></div>';
			echo '</div>';
		}
	echo '</div>';
	
	echo '<div class="cleaner h40"></div>';
	
	}
	
	if($id_photos){
		echo '<div class="section photos large">';
		echo '<h3 class='.clean($visibility["photos_visibility"]).'>Photos du profil</h3>';
			echo '<ul>';
			for($i=1;$i<=$id_photos;$i++){
				$photos = $SQL->ResSQL($requete_photos);
				$id_photo_code = base64_encode(convert_uuencode($photos->id_photo));
				if($_SESSION['action'] != "profil"){
					echo '<li><span class="image"><img src="'.$photos->url_photo.'" alt="'.$photos->nom_photo.'" width="200px" /></span><br /><a hreh="javascript:void(0)" class="lien" onclick=deleteimage("'.$id_photo_code.'") title="Supprimer cette image">Supprimer image</a></li>';
				}
				else{
					echo '<li><span class="image"><img src="'.$photos->url_photo.'" alt="'.$photos->nom_photo.'" width="200px" /></span></li>';
				}
			}
			echo '</ul>';
			
		echo '</div>';
	}
	
	if($id_relations){
		echo '<div class="cleaner h40"></div>';
		echo '
		<div class="section large">
		<div id="resultat">
		<h3 class='.clean($visibility["relations_visibility"]).'>Relations de ce compte</h3>';
		
		echo "<table width='880' id='result'>";
		echo "<tr>";
		echo "<th>Prénom</th>";
		echo "<th>Nom</th>";
		echo "<th>Information relation</th>";
		echo "</tr>";
		foreach($relations_tab as $value){
			$affiche = false;
			$requete_relations_tab = $SQL->ExecuteSQL("select p.id_profil,p.nom,p.prenom, r.type from profil as p,profil_relations as r where p.id_profil=r.utilisateur and r.id_profil='$id_profil' and r.type='$value'");
			while ($relations = $SQL->ResSQL($requete_relations_tab)){
				if($affiche == false){
					echo "<tr>";
					echo "<td colspan='3' class='colspan'>".$value."</td>";
					echo "</tr>";
					$affiche = true;
				}
				echo "<tr>";
				echo "<td>".$relations->prenom."</td>";
				echo "<td>".$relations->nom."</td>";
				if($_SESSION['action']=="connexion"){
					echo "<td><a href='index.php?action=profil&user=".base64_encode(convert_uuencode($relations->id_profil))."' title='Afficher profil'>Voir profil</a> - <a href='javascript:void(0)' onclick='deleteRelation(\"".base64_encode(convert_uuencode($relations->id_profil))."\",\"".$value."\")' title='Supprimer cette relation'>Supprimer relation</a></td>";
				}
				else{
					echo "<td><a href='index.php?action=profil&user=".base64_encode(convert_uuencode($relations->id_profil))."' title='Afficher profil'>Voir profil</a></td>";					
				}
				echo "</tr>";
			}
		}
		
		echo "</table>";
		
		echo "</div>";
		echo "</div>";
	}
}

/****************************************************/
/****************  Fonctions modifier profil  *******/
/****************************************************/

function modifier_profil($nom, $prenom, $sexe, $semestre, $id_profil, $competences, $programme){
	global $SQL;

	$modifier_profil = "update profil
						set nom = '$nom', prenom = '$prenom', sexe = '$sexe', semestre = '$semestre', programme = '$programme'
						where id_profil = $id_profil";
	$modifier = $SQL->ExecuteSQL($modifier_profil);
	
	$supprimer_comp = "delete from profil_competences where id_profil = $id_profil";
	$supprimer = $SQL->ExecuteSQL($supprimer_comp);
	
	foreach($competences as $element){
		$ajout_competence =  $SQL->ExecuteSQL("insert into profil_competences (competences,id_profil) values ('$element','$id_profil')");
	}
}

function modifier_mdp($id_profil, $mdp){
	global $SQL;

	$modifier_mdp = "update profil
					set password = '$mdp'
					where id_profil = $id_profil";
	$mdp_exe = $SQL->ExecuteSQL($modifier_mdp);
}

function modif_conf($id_profil, $sexe, $nom, $prenom, $programme, $semestre, $photos, $competences, $relations){
	global $SQL;
	
	$modifier_visi = "update profil_visibility
					set sexe_visibility = '$sexe', nom_visibility = '$nom', prenom_visibility = '$nom',
						programme_visibility = '$programme', semestre_visibility = '$semestre', photos_visibility = '$photos',
						competences_visibility = '$competences', relations_visibility = '$relations'
					where id_visibility = '$id_profil'";
	$visi_exe = $SQL->ExecuteSQL($modifier_visi);			
}

/****************************************************/
/****************  Fonctions rechercher  ************/
/****************************************************/

function recherche($label,$values){
	global $SQL;
	
	if($label == "simple"){
		$tab = explode(" ",$values);
		if(empty($tab)){
			$tab[0]="";
			$tab[1]="";
		}
		if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
			$requete = 'select distinct p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and (v.nom_visibility="Public" and v.prenom_visibility="Public" and p.id_profil!='.$_SESSION['id_profil'].' and (p.prenom like "%'.$tab[0].'%" or p.nom like "%'.$tab[1].'%")) or (p.prenom like (select p.prenom from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.prenom like "%'.$tab[0].'%") or p.nom like (select p.nom from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.nom like "%'.$tab[1].'%")) limit 5';
		}
		else{
			$requete = 'select p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and v.nom_visibility="Public" and v.prenom_visibility="Public" and (p.prenom like "%'.$tab[0].'%" or p.nom like "%'.$tab[0].'%") limit 5';
		}
	}
	
	if($label == "genre"){
		if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
			$requete = 'select distinct p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and (v.nom_visibility="Public" and v.prenom_visibility="Public" and p.id_profil!='.$_SESSION['id_profil'].' and p.sexe="'.$values.'") or (p.id_profil in (select p.id_profil from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.sexe="'.$values.'")) order by p.nom ASC';
		}
		else{
			$requete = 'select p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and v.nom_visibility="Public" and v.prenom_visibility="Public" and p.sexe="'.$values.'" order by p.nom ASC';
		}		
	}
	
	if($label == "programme"){
		if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
			$requete = 'select distinct p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and (v.nom_visibility="Public" and v.prenom_visibility="Public" and p.id_profil!='.$_SESSION['id_profil'].' and p.programme="'.$values.'") or (p.id_profil in (select p.id_profil from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.programme="'.$values.'")) order by p.nom ASC';
		}
		else{
			$requete = 'select p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and v.nom_visibility="Public" and v.prenom_visibility="Public" and p.programme="'.$values.'" order by p.nom ASC';
		}		
	}
	
	if($label == "programme_semmestre"){
		if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
			$requete = 'select distinct p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and (v.nom_visibility="Public" and v.prenom_visibility="Public" and p.id_profil!='.$_SESSION['id_profil'].' and p.programme="'.$values['prog_bis'].'" and p.semestre="'.$values['sem'].'") or (p.id_profil in (select p.id_profil from profil as p,profil_relations as r where p.id_profil=r.id_profil and r.type="Je suis ami(e) avec" and r.utilisateur='.$_SESSION['id_profil'].' and p.programme="'.$values['prog_bis'].'" and p.semestre="'.$values['sem'].'")) order by p.nom ASC';
		}
		else{
			$requete = 'select p.id_profil,p.nom,p.prenom from profil as p,profil_visibility as v where p.id_profil=v.id_profil and v.nom_visibility="Public" and v.prenom_visibility="Public" and p.programme="'.$values['prog_bis'].'" and p.semestre="'.$values['sem'].'" order by p.nom ASC';
		}		
	}
	
	if($label == "relations"){
		$requete = 'select p.id_profil,p.nom,p.prenom from profil as p,profil_relations as r where p.id_profil=r.utilisateur and r.id_profil='.$_SESSION['id_profil'].' and r.type="'.$values.'" order by p.nom ASC';
	}
	
	$executer = $SQL->ExecuteSQL($requete);
	$resultat = $SQL->RetourneNbRequetes($executer);
	
	if($resultat != 0){
		echo "<div id='resultat'>";
		echo "<h2>Résultat de la recherche</h2>";
		echo "<table width='900' id='result'>";
		echo "<tr>";
		echo "<th>Prénom</th>";
		echo "<th>Nom</th>";
		echo "<th>Information profil</th>";
		echo "</tr>";
		while($row = $SQL->ResSQL($executer)){
			echo "<tr>";
			echo "<td>$row->prenom</td>";
			echo "<td>$row->nom</td>";
			echo "<td><a href='index.php?action=profil&user=".base64_encode(convert_uuencode($row->id_profil))."' title='Afficher profil'>Voir profil</a></td>";
			echo "</tr>";
		}	
		echo "</table>";
		echo "</div>";
	}
	else{
		echo "<div id='resultat'>";
		echo "<h2>Aucun résultat...</h2>";
		echo "</div>";
	}
}

/****************************************************/
/****************  Fonctions ajouter photo  *********/
/****************************************************/

function ajoutphoto(){
	global $SQL;

	$uploadpath="images/".$_SESSION['login_profil']."/";
	
	$id_profil=$_SESSION['id_profil'];
		
	foreach($_FILES as $key => $value){
		if ((isset($_FILES[$key]['tmp_name']))&&($_FILES[$key]['error'] == UPLOAD_ERR_OK)){
			move_uploaded_file($_FILES[$key]['tmp_name'], $uploadpath.$_FILES[$key]['name']);
			$name_photo = $_FILES[$key]['name'];
			$url_photo = $uploadpath.$_FILES[$key]['name'];
			$ajout_photo =  $SQL->ExecuteSQL("insert into profil_photos (nom_photo,url_photo,id_profil) values ('$name_photo','$url_photo','$id_profil')");
		}
		else{
			echo "<p>Erreur sur le fichier ".$key."</p>";
		}
	}
}
