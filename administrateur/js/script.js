$(document).ready(function(){
	modifier();
});

function deleteuser(user){
	check = confirm("Vous êtes sur de vouloir supprimer cette utilisateur ?");
	if(check == true){
		$.ajax({
			type: "POST",
			url: "delete.php",
			data: "user="+user,
			success: function(msg){
				alert(msg);
				$('body').delay(0).load('index.php');
			}
		});
	}
}

function modifier(){
	$('.modifier_profil select.select').find('option:first').remove();
}