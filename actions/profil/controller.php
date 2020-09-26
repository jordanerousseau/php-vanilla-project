<div class="content_box">
<?php
if((!empty($_GET['user']))&&(!empty($_GET['user']))){
	$user = $_GET['user'];
	@$decode = convert_uudecode(base64_decode($user));

	if($decode !=''){
?>
	<div id="legende_profil">
		<h5>Les critère de visibilité définis pour ce profil :</h5>
		<ul>
			<li class="prive">Privé</li>
			<li class="amis">Amis</li>
			<li class="public">Public</li>
		</ul>
	</div>
	<?php
	}
	if((!empty($_SESSION['id_profil']))&&(!empty($_SESSION['login_profil']))){
	?>
	<div id="boite">
		<h5>Ajouter une relation à votre profil :</h5>
		<ul>
			<?php
				foreach($relations_tab as $value){
				?>
					<li><input type="button" value="<?php echo $value; ?>" class="submit_btn" onclick="ajoutRelations('<?php echo $user; ?>','<?php echo $value; ?>')" /></li>
				<?php
				}
			?>
		</ul>
	</div>
	<?php
	}
		
	if($decode !=''){		
		afficher_profil($competences_tab,$decode);
	}
	else{
		echo "<p>Impossible d'effectuer l'operation.</p>";
	}
	?>
	
	<div class="cleaner"></div>
<?php
}
else{
	echo "<p>Impossible d'effectuer l'operation.</p>";
}
?>
</div>