<!-- Accueil -->
<?php
if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
	die('<meta http-equiv="refresh" content="0;URL=index.php?action=connexion">');
}
?>
<div class="content_box">
	<h2>Bienvenue sur ResSocUTT</h2>
	<p>Pour commencer, veuillez-vous connecter ou vous inscrire en utilisant le menu mis à votre disposition.</p>
	<p>Vous pouvez également utiliser le bouton recherche le moteur de recherche pour trouver une personne sur les réseaux.</p>
	<h2>Comment utiliser ce réseau social</h2>
	<p>Pour commencer l'aventure sur ResSocUTT, il faut déjà <a href="index.php?action=inscription" title="S'inscrire sur ResSocUTT">s'inscrire</a>. Ensuite, <a href="index.php?action=connexion" title="Accéder à votre profil">connectez-vous</a> sur votre profil pour modifier les informations de votre compte, les critères de visibilités et ajouter des relations.</p>
	<p>Ce réseau fonctionne sur le principe des relations unidirectionnelles c'est-à-dire qu'il n'est pas nécessaire d'obtenir une confirmation du propriétaire pour l'ajouter à votre liste de relations.</p>

	<div class="cleaner"></div>
</div>