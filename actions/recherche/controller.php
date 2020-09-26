<div class="content_box">
	<h2>Recherche avancée</h2>
	<div id="contact_form" class="formulaire">
		<form action="index.php?action=recherche#resultat" method="POST">
			<h3>Recherche simple sur tous les profils :</h3>	
			<?php
			$simple="Recherche…";
			if(isset($_POST['recherche'])){
				if(!empty($_POST['recherche'])){
					$simple = $_POST['recherche'];
				}
				if($_POST['recherche']=="Recherche..."){
					$simple="Recherche…";
				}
			}
			if(isset($_POST['simple'])){
				if(!empty($_POST['simple'])){
					$simple = $_POST['simple'];
				}
			}
			?>
			<?php input("Recherche :","simple","text",$simple); ?>
			<?php
			if((isset($_POST['simple']))&&(empty($_POST['simple']))){
				echo "<p class='erreur_item'>".$userMessage[3]."</p>";
			}
			?>
			<div class="cleaner h10"></div>
			<input type="submit" value="Trouver" class="submit_btn" />
		</form>
		<div class="cleaner h30"></div>
		<form action="index.php?action=recherche#resultat" method="POST">
			<h3>Recherche par genre :</h3>

			<?php
			if(isset($_POST['genre'])){
				select_simple("Genre :",$sexe_tab,"genre",$_POST['genre']);
			}
			else{
				select_simple("Genre :",$sexe_tab,"genre","");
			}
			
			if((isset($_POST['genre']))&&(empty($_POST['genre']))){
				echo "<p class='erreur_item'>".$userMessage[3]."</p>";
			}
			?>
			<div class="cleaner h10"></div>
			<input type="submit" value="Trouver" class="submit_btn" />
		</form>
		<div class="cleaner h30"></div>
		<form action="index.php?action=recherche#resultat" method="POST">
			<h3>Recherche par programme :</h3>
			
			<?php
			if(isset($_POST['prog'])){
				select_simple("Programme :",$programme_tab,"prog",$_POST['prog']);
			}
			else{
				select_simple("Programme :",$programme_tab,"prog","");
			}

			if((isset($_POST['prog']))&&(empty($_POST['prog']))){
				echo "<p class='erreur_item'>".$userMessage[3]."</p>";
			}
			?>
			<div class="cleaner h10"></div>
			<input type="submit" value="Trouver" class="submit_btn" />
		</form>
		<div class="cleaner h30"></div>
		<form action="index.php?action=recherche#resultat" method="POST">
			<h3>Recherche par programme et semestre :</h3>
			
			<?php
			if(isset($_POST['prog_bis'])){
				select_simple("Programme :",$programme_tab,"prog_bis",$_POST['prog_bis']);
			}
			else{
				select_simple("Programme :",$programme_tab,"prog_bis","");
			}

			if((isset($_POST['prog_bis']))&&(empty($_POST['prog_bis']))){
				echo "<p class='erreur_item'>".$userMessage[3]."</p>";
			}
			?>
			<div class="cleaner h10"></div>
			<?php
			if(isset($_POST['sem'])){
				select_simple("Semestre :",$semestre_tab,"sem",$_POST['sem']);
			}
			else{
				select_simple("Semestre :",$semestre_tab,"sem","");
			}

			if((isset($_POST['sem']))&&(empty($_POST['sem']))){
				echo "<p class='erreur_item'>".$userMessage[3]."</p>";
			}
			?>
			<div class="cleaner h10"></div>
			<input type="submit" value="Trouver" class="submit_btn" />
		</form>
		<?php if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){ ?>
		<div class="cleaner h30"></div>
		<form action="index.php?action=recherche#resultat" method="POST">
			<h3>Recherche par relations :</h3>
			<?php
			if(isset($_POST['sem'])){
				select_simple("Relations :",$relations_tab,"relations",$_POST['relations']);
			}
			else{
				select_simple("Relations :",$relations_tab,"relations","");
			}

			if((isset($_POST['relations']))&&(empty($_POST['relations']))){
				echo "<p class='erreur_item'>".$userMessage[3]."</p>";
			}
			?>
			<div class="cleaner h10"></div>
			<input type="submit" value="Trouver" class="submit_btn" />
		</form>
		<?php } ?>
	</div>
	<div class="cleaner h40"></div>
	
	<?php
	if(($simple !="")&&($simple !="Recherche…")){
		recherche('simple',$simple);
	}

	if(!empty($_POST['genre'])){
		recherche('genre',$_POST['genre']);
	}
	
	if(!empty($_POST['prog'])){
		recherche('programme',$_POST['prog']);
	}
	
	if((!empty($_POST['prog_bis']))&&(!empty($_POST['sem']))){
		recherche('programme_semmestre',array("prog_bis" => $_POST['prog_bis'],"sem" => $_POST['sem']));
	}
	
	if(!empty($_POST['relations'])){
		recherche('relations',$_POST['relations']);
	}
?>
	
	<div class="cleaner"></div>
</div>