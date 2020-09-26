<!-- Connexion -->

<div class="content_box">

	<?php
		extract($variables);
		if((isset($_POST))&&(!empty($_POST))){
			extract($_POST);
		}

		if((!empty($_POST['login']))&&(!empty($_POST['password']))){
			connexion($_POST['login'],$_POST['password']);
		}
		
		if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
		?>

		<div id="legende_profil">
			<h5>Les critère de visibilité définis pour votre profil :</h5>
			<ul>
				<li class="prive">Privé</li>
				<li class="amis">Amis</li>
				<li class="public">Public</li>
			</ul>
		</div>
		
		<div id="boite" class="image">
			<h5>Ajouter une image :</h5>			
			<form action="" method="POST" enctype='multipart/form-data'>
				<p>Attention : seules les extensions png, gif et jpg sont acceptés (la taille maximum est de 1 MO par photo)</p>
				<?php
					if(!empty($_FILES)){
						//Vérification de l'image
						$erreur=FALSE;
						$taille_maxi = 1024000;
						$taille = filesize($_FILES['photo']['tmp_name']);
						$extension_photo = strrchr($_FILES['photo']['name'], '.');
						foreach($_FILES as $key => $value){
							if ($_FILES[$key]['name'] == ""){
								$erreur=TRUE;
							}
						}

						if(($erreur==TRUE)||($taille>$taille_maxi)||(!in_array($extension_photo, $extensions))){
							echo "<p class='erreur_global'>".$valideMessage[12]."</p>";
						}
						else{
							ajoutphoto();
							$id_profil = $_SESSION['id_profil'];
							$requete_profil = $SQL->ExecuteSQL("select * from profil where id_profil=$id_profil");
							$profil = $SQL->ResSQL($requete_profil);
							Tracabilite($profil->prenom." ".$profil->nom." vient d\'\ajouter une image");
							echo "<p class='modifReussie'>".$userMessage[0]."</p>";
						}
					}
				?>
				<p>
					<br />
					<input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
					<?php fichier("Choisir un fichier : ","photo"); ?>
					<br />
				</p>
				<p>
					<input type="submit" value="Ajouter" class="submit_btn" />
				</p>
				<div class="cleaner h10"></div>
			</form>
		</div>
		
		<?php
			afficher_profil($competences_tab,$_SESSION['id_profil']);
		}
	else{
	?>
	<h2>Se connecter sur ResSocUTT</h2>
	<div id="contact_form">
	<?php

			if(!empty($_POST)){
				echo "<p class='erreur_global'>".$userMessage[4]."</p><br />";
			}
	?>
		<form action="" method="POST">
			<?php input("Identifiant :","login","text",$login); ?>
			<div class="cleaner h10"></div>
			
			<?php input("Mot de passe :","password","password",$password); ?>
			<div class="cleaner h10"></div>
			<input type="submit" value="Connexion" class="submit_btn" />	
		</form>	
	</div>
	<?php
	}
	?>

	<div class="cleaner"></div>
</div>