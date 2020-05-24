/**
 * @author BouWou
 */
/*
 * Racourci
 */
$(document).ready(function(){ 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus
	
	
   $('#charge').ajaxStart(function(request, settings) { $(this).css("visibility", "visible") });
	$('#charge').ajaxStop(function(request, settings){ $(this).css("visibility", "hidden") });
	$('.page-container .page-content .content-frame .content-frame-body #categorie a').click(function(){
		alert("test");
		page=($(this).attr("href")); 
		$.ajax({  // ajax
		type:'POST',
		url: page, // url de la page ?harger
		dataType: 'text',
		cache: false, // pas de mise en cache
		success:function(reponse){ // si la requ뵩 est un succ鳍
			
			
			alert(reponse);	    // on execute la fonction afficher(donnees)
			
		},
		error:function(XMLHttpRequest, textStatus, errorThrows){ // erreur durant la requete
		}
	});
	return false;
	});
	
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
