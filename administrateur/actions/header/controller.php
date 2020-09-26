<!-- Header -->

<div id="header">
	<div id="menubar">
			<h1 id="logo"><a href="../">ResSocUTT</a></h1>
			<p id="profil">Bonjour administrateur</p>
			<ul id="menu">
				<li class="<?php if(empty($_GET['action'])||($_GET['action']=='modifier_profil')){echo 'actif';} ?>"><a href="index.php">Gestion des Comptes</a></li>
				<li <?php if(isset($_GET['action'])){if($_GET['action']=='logs'){echo 'class="actif"';}} ?>><a href="index.php?action=logs">Logs</a></li>
				<li <?php if(isset($_GET['action'])){if($_GET['action']=='informations'){echo 'class="actif"';}} ?>><a href="index.php?action=informations">Informations</a></li>
			</ul>
	</div>
</div>