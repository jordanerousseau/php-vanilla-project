<!-- Inscription -->
<?php
if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
	die('<meta http-equiv="refresh" content="0;URL=index.php?action=connexion">');
}
?>

<div class="content_box">
	<?php
	extract($variables);
	if((isset($_POST))&&(!empty($_POST))){
		extract($_POST);
		if(verif_login($login) != 0){
			$login="";
		}
	}

	if((!empty($_POST['sexe']))&&(!empty($_POST['nom']))&&(!empty($_POST['prenom']))&&($_POST['programme']!="0")&&($_POST['semestre']!="0")&&(!empty($_POST['login']))&&($login!="")&&(!empty($_POST['password']))&&(!empty($_POST['repassword']))&&($_POST['password']==$_POST['repassword'])&&($_FILES['photo1']['name'] != "")&&($_FILES['photo2']['name'] != "")&&($_FILES['photo3']['name'] != "")&&(!empty($_POST['competences']))){
		ajout_profil($_POST);
		Tracabilite("$prenom $nom vient de s\'\inscrire");
	}
	else{
	?>
	<h2>S'inscrire sur ResSocUTT</h2>
	<div id="contact_form" class="formulaire">
<?php
	if(!empty($_POST)){
		echo "<p class='erreur_global'>".$userMessage[3]."</p><br />";

		//Vérification des images
		$erreur=FALSE;
		$taille_maxi = 1024000;
		$taille1 = filesize($_FILES['photo1']['tmp_name']);
		$taille2 = filesize($_FILES['photo2']['tmp_name']);
		$taille3 = filesize($_FILES['photo3']['tmp_name']);
		$extension1 = strrchr($_FILES['photo1']['name'], '.');
		$extension2 = strrchr($_FILES['photo2']['name'], '.');
		$extension3 = strrchr($_FILES['photo3']['name'], '.');
		foreach($_FILES as $key => $value){
			if ($_FILES[$key]['name'] == ""){
				$erreur=TRUE;
			}
		}
	}
	
?>
		<form action="" method="POST" enctype='multipart/form-data'>
			<h3>Informations personnelles :</h3>
			
			<?php radio("Sexe :","sexe",$sexe_tab,$sexe); ?>
			<?php
			if(!empty($_POST)){
				if (empty($_POST['sexe'])){
					echo "<p class='erreur_item'>".$valideMessage[0]."</p>";
				}
			}
			?>
			<div class="cleaner h10"></div>

			<?php input("Nom :","nom","text",$nom); ?>
			<?php
			if(!empty($_POST)){
				if((isset($_POST['nom']))&&(empty($_POST['nom']))){
					echo "<p class='erreur_item'>".$valideMessage[1]."</p>";
				}
			}
			?>
			<div class="cleaner h10"></div>
			
			<?php input("Prénom :","prenom","text",$prenom); ?>
			<?php
			if(!empty($_POST)){
				if((isset($_POST['prenom']))&&(empty($_POST['prenom']))){
					echo "<p class='erreur_item'>".$valideMessage[2]."</p>";
				}
			}
			?>
			<div class="cleaner h10"></div>
			
			<?php select_simple("Programme :",$programme_tab,"programme",$programme); ?>
			<?php
			if(!empty($_POST)){
				if($_POST['programme']=="0"){
					echo "<p class='erreur_item'>".$valideMessage[3]."</p>";
				}
			}
			?>
			<div class="cleaner h10"></div>
			
			<?php select_simple("Semestre :",$semestre_tab,"semestre",$semestre); ?>
			<?php
			if(!empty($_POST)){
				if($_POST['semestre']=="0"){
					echo "<p class='erreur_item'>".$valideMessage[4]."</p>";
				}
			}
			?>
			<div class="cleaner h30"></div>
			
			<h3>Informations sur votre compte :</h3>
			
			<?php input("Identifiant :","login","text",$login); ?>
			<?php
			if(!empty($_POST)){
				if((isset($_POST['login']))&&($login=="")){
					echo "<p class='erreur_item'>".$valideMessage[5]."</p>";
				}
			}
			?>
			<div class="cleaner h10"></div>
			
			<?php
			if(!empty($_POST)){
				if($_POST['password']!=$_POST['repassword']){
					echo "<p class='erreur_global'>".$valideMessage[8]."</p>";
				}
			}
			?>
			
			<?php input("Mot de passe :","password","password",$password); ?>
			<?php
			if(!empty($_POST)){
				if((isset($_POST['password']))&&(empty($_POST['password']))){
					echo "<p class='erreur_item'>".$valideMessage[6]."</p>";
				}
			}
			?>
			<div class="cleaner h10"></div>
			
			<?php input("Confirmation :","repassword","password",$repassword); ?>
			<?php
			if(!empty($_POST)){
				if((isset($_POST['repassword']))&&(empty($_POST['repassword']))){
					echo "<p class='erreur_item'>".$valideMessage[7]."</p>";
				}
			}
			?>
			<div class="cleaner h30"></div>
			
			<h3>Ajouter des photos :</h3>
			
			<input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
			<?php
			if(!empty($_POST)){
				if(($erreur==TRUE)||(($taille1>$taille_maxi)||($taille2>$taille_maxi)||($taille3>$taille_maxi))||((!in_array($extension1, $extensions))||(!in_array($extension2, $extensions))||(!in_array($extension3, $extensions)))){
					echo "<p class='erreur_global'>".$valideMessage[9]."</p>";
				}
			}
			?>
			
			<?php fichier("Première photo :","photo1"); ?>
			<div class="cleaner h10"></div>
			<?php fichier("Deuxième photo :","photo2"); ?>
			<div class="cleaner h10"></div>
			<?php fichier("Troisième photo :","photo3"); ?>
			<div class="cleaner h30"></div>
			
			<h3>Ajouter des compétences :</h3>
			
			<?php
			if(!empty($_POST)){
				if(empty($_POST['competences'])){
					echo "<p class='erreur_global'>".$valideMessage[10]."</p>";
				}
			}
			?>	
			
			<?php select_multiple("Compétences :",$competences_tab,"competences[]",10,$competences); ?>
			
			<div class="cleaner h30"></div>
			
			<input type="submit" value="Inscription" class="submit_btn" />
			<input type="reset" value="Réinitialiser" class="submit_btn" />
		</form>
	</div>
	<?php
		}
	?>

	<div class="cleaner"></div>
</div>