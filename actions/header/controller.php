<!-- Header -->

<div id="header">
	<div id="menubar">
		<?php
		if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
		?>
			<h1 id="logo"><a href="index.php?action=connexion">ResSocUTT</a></h1>
			<p id="profil">Bonjour <?php echo $_SESSION['login_profil'];?></p>
			<ul id="menu">
				<li <?php if(isset($_GET['action'])){if($_GET['action']=='connexion'){echo 'class="actif"';}} ?>><a href="index.php?action=connexion">Profil</a></li>
				<li <?php if(isset($_GET['action'])){if($_GET['action']=='modifier_profil'){echo 'class="actif"';}} ?>><a href="index.php?action=modifier_profil">Modifier</a></li>
				<li><a href="index.php?action=deconnexion">Deconnexion</a></li>
			</ul>
		<?php
		}
		else{
		?>
		<h1 id="logo"><a href="index.php">ResSocUTT</a></h1>
		<ul id="menu">
			<li class="first <?php if(empty($_GET['action'])){echo 'actif';} ?>"><a href="index.php">Accueil</a></li>
			<li <?php if(isset($_GET['action'])){if($_GET['action']=='connexion'){echo 'class="actif"';}} ?>><a href="index.php?action=connexion">Connexion</a></li>
			<li <?php if(isset($_GET['action'])){if($_GET['action']=='inscription'){echo 'class="actif"';}} ?>><a href="index.php?action=inscription">Inscription</a></li>
			<li class="last <?php if(isset($_GET['action'])){if($_GET['action']=='recherche'){echo 'actif';}}?>"><a href="index.php?action=recherche">Recherche</a></li>
		</ul>
		<?php
		}
		?>
		<div id="search">
			<form action="index.php?action=recherche#resultat" method="POST">
				<input type="submit" value="Envoyer" class="search-button" />
				<input type="text" id="recherche" name="recherche" value="Recherche..." onblur="if (this.value == '') {this.value = 'Recherche...';}" onfocus="if (this.value == 'Recherche...') {this.value = '';}" />
			</form>
		</div>
	</div>
</div>