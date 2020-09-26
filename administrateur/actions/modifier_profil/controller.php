<!-- Modification -->
<div class="content_box">
	<h2>Modifier le profil</h2>
	<div id="contact_form" class="formulaire">
	<?php
	$id_profil = $_GET['profil'];
	$text_mdp = '';
	$text_mdp2 = '';
	$text_valide = '';
	
	//Appel de la fonction de modification
	if (isset($_POST['modif'])){
		if($_POST['modif']==1){
			if(!empty($_POST['nom'])&&!empty($_POST['prenom'])){
				modifier_profil($_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['semestre'], 
								$id_profil, $_POST['competences'], $_POST['programme']);
				$_POST['modif']=0;
				$text_valide = '<p class="modifReussie">Modifcation réussie !</p>';
			}
			if(!empty($_POST['mdp1'])){
					if($_POST['mdp1']==$_POST['mdp2']){
						modifier_mdp($id_profil, $_POST['mdp1']); 
					}
					else{
						$text_valide .= '<p class="modifRatee">Mais erreur dans le mot de passe</p>';
						$text_mdp = '<p class="modifRatee">Erreur.</p>';
					}
				
			}else{
					$text_valide .= '<p class="modifRatee">Mais erreur dans le mot de passe</p>';
					$text_mdp = '<p class="modifRatee">Erreur dans le mot de passe.</p>';
			}
		}
	}
	
	if(!empty($_POST['sexe_visibility'])){
		modif_conf($id_profil, $_POST['sexe_visibility'], $_POST['nom_visibility'], $_POST['prenom_visibility'],
					$_POST['programme_visibility'], $_POST['semestre_visibility'], $_POST['photos_visibility'], 
					$_POST['competences_visibility'], $_POST['relations_visibility']);
	}
	
	//Requêtes
	$requete_visibility = $SQL->ExecuteSQL("select * from profil_visibility where id_profil='$id_profil'");
	$requete_profil = $SQL->ExecuteSQL("select * from profil where id_profil='$id_profil'");
	$req_comp = $SQL->unbuffered("select * from profil_competences where id_profil='$id_profil'");

	//Récupérer les résultats des requêtes
	$visibility = $SQL->ResSQL($requete_visibility);
	$profil = $SQL->ResSQL($requete_profil);
	while($row = $SQL->TabResSQL($req_comp)){
		$competence[] = $row['competences'];
	}
	
	echo $text_valide;
	//Affichage
	?>
	
	<form action="" method="POST">
	<h3>Informations personnelles :</h3>
	
	<?php radio("Sexe :","sexe",$sexe_tab,$profil->sexe); ?>
	<?php
	if(!empty($_POST)){
		if (empty($_POST['sexe'])){
			echo "<p class='erreur_item'>".$valideMessage[0]."</p>";
		}
	}
	?>
	<div class="cleaner h10"></div>

	<?php input("Nom :","nom","text",$profil->nom); ?>
	<?php
	if(!empty($_POST)){
		if((isset($_POST['nom']))&&(empty($_POST['nom']))){
			echo "<p class='erreur_item'>".$valideMessage[1]."</p>";
		}
	}
	?>
	<div class="cleaner h10"></div>
	
	<?php input("Prénom :","prenom","text",$profil->prenom); ?>
	<?php
	if(!empty($_POST)){
		if((isset($_POST['prenom']))&&(empty($_POST['prenom']))){
			echo "<p class='erreur_item'>".$valideMessage[2]."</p>";
		}
	}
	?>
	
	<div class="cleaner h10"></div>
	
	<?php select_simple("Programme :",$programme_tab,"programme",$profil->programme); ?>
			
	<div class="cleaner h10"></div>
	
	<?php select_simple("Semestre :",$semestre_tab,"semestre",$profil->semestre); ?>
		<div class="cleaner h30"></div>
		
		<h3>Changer de mot de passe :</h3>
		
	<?php
		input("Nouveau :","mdp1","password","");
		echo '<div class="cleaner h10"></div>';
		echo $text_mdp;
		echo '<div class="cleaner h10"></div>';

		input("Confirmez :","mdp2","password","");
		echo '<div class="cleaner h10"></div>';
		echo $text_mdp;
	?>
		<div class="cleaner h30"></div>
		<h3>Vos compétences :</h3>
		
	<?php
	
		select_multiple("Compétences :",$competences_tab,"competences[]",10,$competence);

		echo '<input type="hidden" value="1" id="modif" name="modif"/>';
	?>
	<div class="cleaner h30"></div>
	
	<h3>Régler la visibilité de vos informations :</h3>
	<p><em>Attention :</em> Chaque paramètre du profil est associé à un critère de visibilité. Pour que votre compte soit visible sur le réseau, pensez à changer les critères de visibilités de votre nom et de votre prénom afin de les passer en "Public".</p>
	
	<?php select_simple("Sexe :",$criteres,"sexe_visibility",$visibility->sexe_visibility); ?>
	<div class="cleaner h10"></div>
	<?php select_simple("Nom et Prénom :",$criteres,"nom_visibility",$visibility->nom_visibility); ?>
	<div class="cleaner h10"></div>
	<?php select_simple("Programme :",$criteres,"programme_visibility",$visibility->programme_visibility); ?>
	<div class="cleaner h10"></div>
	<?php select_simple("Semestre :",$criteres,"semestre_visibility",$visibility->semestre_visibility); ?>
	<div class="cleaner h10"></div>
	<?php select_simple("Photos :",$criteres,"photos_visibility",$visibility->photos_visibility); ?>
	<div class="cleaner h10"></div>
	<?php select_simple("Compétences :",$criteres,"competences_visibility",$visibility->competences_visibility); ?>
	<div class="cleaner h10"></div>
	<?php select_simple("Relations :",$criteres,"relations_visibility",$visibility->relations_visibility); ?>
	<div class="cleaner h10"></div>
	
	<div class="cleaner h30"></div>

	<input type="submit" value="Modifier" class="submit_btn" />
	</form>
	</div>
	
	<div class="cleaner"></div>
</div>