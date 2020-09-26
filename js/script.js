$(document).ready(function(){

	autocomplete();
	recherche();
	modifier();
	
});

function autocomplete(){
	$("#recherche").autocomplete({
		source: "recherche.php",
		minLength: 2,
		open: function() {
			$(this).autocomplete("widget").appendTo("#autocomplete").css("margin-left", "-1px");
			$("ul.ui-autocomplete").append("<li class='recherche'><a href='index.php?action=recherche'>- Recherche avancée -</a></li>");
		}
	});
	
	$("#simple").autocomplete({
		source: "recherche.php",
		minLength: 2,
	});	
}

function ajoutRelations(user,value){
	check = confirm("Vous êtes sur de vouloir ajouter cette relation ?");
	if(check == true){
		$.ajax({
			type: "POST",
			url: "relations.php",
			data: "user="+user+"&type="+value,
			success: function(msg){
				alert(msg);
			}
		});
	}
}

function deleteRelation(user,value){
	check = confirm("Vous êtes sur de vouloir supprimer cette relation ?");
	if(check == true){
		$.ajax({
			type: "POST",
			url: "delete_relations.php",
			data: "user="+user+"&type="+value,
			success: function(msg){
				alert(msg);
				$('body').delay(0).load('index.php?action=connexion#resultat');
			}
		});
	}
}

function deleteimage(value){
	check = confirm("Vous êtes sur de vouloir supprimer cette image ?");
	if(check == true){
		$.ajax({
			type: "POST",
			url: "delete_image.php",
			data: "image="+value,
			success: function(msg){
				alert(msg);
				$('body').delay(0).load('index.php?action=connexion');
			}
		});
	}
}

function recherche(){
	$(".recherche #simple").focus(function(){
		if (this.value=="Recherche…"){
			this.value="";
		}
	});

	$(".recherche #simple").blur(function(){
		if (this.value==""){
			this.value="Recherche…";
		}
	});
}

function modifier(){
	$('.modifier_profil select.select').find('option:first').remove();
}