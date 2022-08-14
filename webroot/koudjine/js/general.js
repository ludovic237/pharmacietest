/**
 * @author BouWou
 */
/*
 * Racourci
 */
$(document).ready(function(){ 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus


    $('#tcharger').click(function(){

        var state =  $(this).attr('checked');
        if(state == 'checked'){
            //alert('reussi');
        }
        else alert('eteint');


    });
// Orientation question
	$('#type').change(function(){

		//alert($('.selectpicker').val());
		if ($('.selectpicker').val() == 2){
			$('#categorie').css('display','block');
		}
		else{
			$('#categorie').css('display','none');
			//$('.categorie').val('defaut');
		}

	});

	// Pharmacie
	$("#recherche").keyup(function (event) {
		var recherche = $(this).val();
		recherche = $.trim(recherche);
		var data = 'motclef=' + recherche;
		if (recherche.length > 1) {
			//alert('yes');
			$.ajax({
				type: "GET",
				url: "/pharmacietest/koudjine/inc/result.php",
				data: data,
				success: function (server_responce) {
					$("#resultat ul").html(server_responce).show();
					//alert('yes');
				}
			})
		} else {
			$("#resultat ul").empty();
		}
	});

	//$("#recherche").focus();



	
});
function afficher(donnees){ // pour remplacer le contenu du div content
	 // on vide le div
	$("#content").append(donnees); // on met dans le div le r?ltat de la requete ajax
}

function charger(page){
	$.ajax({  // ajax
		url: page, // url de la page ?harger
		//data: "nom="+ name,
		cache: false, // pas de mise en cache
		success:function(reponse){ // si la requ뵩 est un succ鳍
			
			
			afficher(reponse);	    // on execute la fonction afficher(donnees)
			
		},
		error:function(XMLHttpRequest, textStatus, errorThrows){ // erreur durant la requete
		}
	});
}
  
  // Ajax
  
   
//Accueil
