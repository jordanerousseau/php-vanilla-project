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
/***************  Fonction profil *******************/
/****************************************************/

function liste_profil(){
	global $SQL;
	$pages = new Paginator('10','p');

	$requete_profil = $SQL->ExecuteSQL("select * from profil order by id_profil DESC");
	$total = $SQL->RetourneNbRequetes($requete_profil);
	$pages->set_total($total);
	
	$data = $SQL->ExecuteSQL("select * from profil order by id_profil DESC ".$pages->get_limit());
	
	echo "<table width='880' id='result'>";
	echo "<tr>";
	echo "<th>Prénom</th>";
	echo "<th>Nom</th>";
	echo "<th>Actions</th>";
	echo "</tr>";
	while ($profil = $SQL->ResSQL($data)){
		echo "<tr>";
		echo "<td>$profil->prenom</td>";
		echo "<td>$profil->nom</td>";
		echo "<td><a href='index.php?action=modifier_profil&profil=$profil->id_profil' title='Modifier le profil'>Modifier</a> - <a href='javascript:void(0)' onclick='deleteuser($profil->id_profil)' title='Supprimer le profil'>Supprimer</a></td>";
		echo "</tr>";
	}
	echo "</table>";
	
	echo $pages->page_links();

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
/****************  Fonctions afficher logs  *********/
/****************************************************/

function logs(){
	global $SQL;
	$pages = new Paginator('10','p');
	
	$requete_logs = $SQL->ExecuteSQL("select * from administration order by id_evenement DESC");
	
	$total = $SQL->RetourneNbRequetes($requete_logs);
	$pages->set_total($total);
	
	$data = $SQL->ExecuteSQL("select * from administration order by id_evenement DESC ".$pages->get_limit());
	
	echo "<table width='880' id='result'>";
	echo "<tr>";
	echo "<th>Message</th>";
	echo "<th>Date</th>";
	echo "<th>Heure</th>";
	echo "</tr>";
	while ($resultat = $SQL->ResSQL($data)){
		echo "<tr>";
		echo "<td>$resultat->description</td>";
		echo "<td>$resultat->date</td>";
		echo "<td>$resultat->heure</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	echo $pages->page_links();
}

/****************************************************/
/********  Fonctions pour l'administrateur  *********/
/****************************************************/

function informations(){
	global $SQL;
	
	$actions = $SQL->ExecuteSQL("select p.prenom,p.nom,count(a.id_profil) as nbaction from administration as a,profil as p where a.id_profil=p.id_profil group by a.id_profil order by nbaction DESC");
	
	echo '<h3>Total des actions réalisées par les internautes</h3>';
	
	echo "<script type='text/javascript'>";
		echo "var chart;";
			
		echo "var chartInfo = [";
		while ($resultat = $SQL->ResSQL($actions)){
			echo "{";			
			echo "country: '".$resultat->prenom." ".$resultat->nom."',";
			echo "visits: ".$resultat->nbaction;
			echo "},";
		}
		echo "];";
		
            echo "AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartInfo;
                chart.categoryField = 'country';
                chart.startDuration = 1;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.gridPosition = 'start';

                // value
                // in case you don't want to change default settings of value axis,
                // you don't need to create it, as one value axis is created automatically.

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = 'visits';
                graph.balloonText = '[[category]]: [[value]]';
                graph.type = 'column';
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.8;
                chart.addGraph(graph);

                chart.write('informations');
            });";
	
	
	echo "</script>";
	
	echo "<div id='informations' style='width: 100%; height: 400px;'></div>";
	
	echo '<div class="cleaner h30"></div>';
}

function reputation(){
	global $SQL;
	
	$requete = $SQL->ExecuteSQL("select id_profil,prenom,nom from profil order by nom");
	$reputation="";
	
	$tabReputation = array();
	
	while ($resultat = $SQL->ResSQL($requete)){
		$Rentrant = $SQL->ExecuteSQL("select count(id_profil) as total from profil_relations where id_profil=".$resultat->id_profil);
		$liens_entrants = $SQL->ResSQL($Rentrant);
		$Rsortant = $SQL->ExecuteSQL("select count(id_profil) as total from profil_relations where utilisateur=".$resultat->id_profil);
		$liens_sortants = $SQL->ResSQL($Rsortant);
		if(($liens_entrants->total!=0)&&($liens_sortants->total!=0)){
			$reputation = $liens_entrants->total / ($liens_entrants->total + $liens_sortants->total);
			if($reputation>0){
				$tabReputation[] = array($resultat->prenom,$resultat->nom,$reputation);
			}
		}
	}
	
	sort($tabReputation);
	
	echo '<h3>Indicateur de réputation des profils</h3>';
	
	echo "<script type='text/javascript'>";
		echo "var chart;var legend;";

		echo "var chartData = [";
		for($i=0;$i<5;$i++){
			if(isset($tabReputation[$i])){
				if($tabReputation[$i]!=NULL){
					echo "{";
					echo "name: '".$tabReputation[$i][0]." ".$tabReputation[$i][1]."',";
					echo "value: ".number_format($tabReputation[$i][2],2);
					echo "},";
				}
			}
		}
		echo "];";

		echo "AmCharts.ready(function () {
			chart = new AmCharts.AmPieChart();
			chart.dataProvider = chartData;
			chart.titleField = 'name';
			chart.valueField = 'value';
			chart.outlineColor = '#FFFFFF';
			chart.outlineAlpha = 0.8;
			chart.outlineThickness = 2;
			chart.depth3D = 15;
			chart.angle = 30;
			chart.write('reputation');
		});";
	
	
	echo "</script>";
	
	echo "<div id='reputation' style='width: 100%; height: 400px;'></div>";
	echo '<div class="cleaner h30"></div>';
}

function binomes(){
	global $SQL;
	
	$pages = new Paginator('5','p');
	
	$requete = $SQL->ExecuteSQL("select * from profil as p,profil_relations as pr where p.id_profil=pr.id_profil and pr.type='Je travaille avec' and pr.utilisateur>pr.id_profil and pr.utilisateur in(select id_profil from profil_relations)");
	
	$total = $SQL->RetourneNbRequetes($requete);
	$pages->set_total($total);
	
	$data = $SQL->ExecuteSQL("select * from profil as p,profil_relations as pr where p.id_profil=pr.id_profil and pr.type='Je travaille avec' and pr.utilisateur>pr.id_profil and pr.utilisateur in(select id_profil from profil_relations) ".$pages->get_limit());
	
	echo '<h3>Profils qui travaillent ensemble</h3>';
	
	echo "<table width='880' id='result'>";
	echo "<tr>";
	echo "<th>Prénom</th>";
	echo "<th>Nom</th>";
	echo "<th>Liaison</th>";
	echo "<th>Prénom binôme</th>";
	echo "<th>Nom binôme</th>";
	echo "</tr>";
	while($resultat = $SQL->ResSQL($data)){
		$binome = $SQL->ExecuteSQL("select * from profil where id_profil=$resultat->utilisateur");
		$result = $SQL->ResSQL($binome);
		echo "<tr>";
		echo "<td>$resultat->prenom</td>";
		echo "<td>$resultat->nom</td>";
		echo "<td>Travaille avec</td>";
		echo "<td>$result->prenom</td>";
		echo "<td>$result->nom</td>";
		echo "</tr>";	
	}
	echo "</table>";

	echo $pages->page_links();
}

/****************************************************/
/*********  Fonctions  Supprimer dossier  ***********/
/****************************************************/

function sup_repertoire($chemin){
	if ($chemin[strlen($chemin)-1] != '/'){ 
		$chemin .= '/';
	}

	if (is_dir($chemin)){
		$sq = opendir($chemin);

		while ($f = readdir($sq)){
			if ($f != '.' && $f != '..'){
				$fichier = $chemin.$f;
				if (is_dir($fichier)){
					sup_repertoire($fichier);
				}
				else{
					unlink($fichier);
				}
			}
		}

		closedir($sq);
		if ($chemin!="chemin de repertoire parent s'il existe "){
			rmdir($chemin); 
		}
	}

	else{
		unlink($chemin);
	}
}

?>