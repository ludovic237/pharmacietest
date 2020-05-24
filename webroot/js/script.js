$(document).ready(function(){ 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus
	
	
	var evenement = $('#event').val();
	var load_comment_id = '';
	var add_comment_id = '';
	var reponse_comment_id = '';
	var id = '';
	//$('#charge').ajaxStart(function(request, settings) { alert("test") });
	/*if($('#srch_ville').val()!="Tout..."){
		$.ajax({
					url: 'inc/evenement.php',
					data: {'ville': $('#srch_ville').val(),'type': $('#srch_type').val()},
					type: 'GET',
					dataType: 'html',
					success: function(data) {
						//alert($('#srch_ville').val());
					$('#srch_universite').html(data);
					//document.write("<"+"script src='js/bootstrap-select.js'></"+"script>");
		 			}
					});
	}*/
	
	$(".load_comment").on("click",function(e){
		        load_comment_id = $(this).parent().parent().parent().attr('id');
		        reponse_comment_id = $(this).parent().attr('data');
		        id = $(this).attr('href');
		        //alert(reponse_comment_id);
		        $("#add_comment").modal("show");
		        e.preventDefault();
		    });
		    $(".ajouter_commentaire").on("click",function(e){
		        
		        add_comment_id = $(this).attr('id');
		        id = $(this).attr('type');
		        //alert(load_comment_id);
		        $("#add_comment").modal("show");
		        e.preventDefault();
		    });
	
	$(".panel-fullscreen").on("click",function(){
        panel_fullscreen($(this).parents(".panel"));
        return false;
    });
    
    $(".panel-collapse").on("click",function(){
        panel_collapse($(this).parents(".panel"));
        $(this).parents(".dropdown").removeClass("open");
        return false;
    });    
    $(".panel-remove").on("click",function(){
        panel_remove($(this).parents(".panel"));
        $(this).parents(".dropdown").removeClass("open");
        return false;
    });
    $(".panel-refresh").on("click",function(){
        var panel = $(this).parents(".panel");
        panel_refresh(panel);

        setTimeout(function(){
            panel_refresh(panel);
        },3000);
        
        $(this).parents(".dropdown").removeClass("open");
        return false;
    });
	
	$('.faculte').click(function(){
				
			var id = this.id;
			$("#content").empty();
			charger('../inc/chargement.php',id);
			$('#charge').ajaxStart(function() { $(this).css("visibility", "visible"); });
			$('#charge').ajaxStop(function(){ $(this).css("visibility", "hidden"); });
			
			/*$("#content").empty();
			var id = this.id;
			//alert(id);
				$.ajax({
					url: '../inc/chargement.php',
					data: {'id': id},
					type: 'GET',
					dataType: 'html',
					success: function(data) {
					$('#content').html(data);
					
					//document.write("<"+"script src='js/touchTouch.jquery.js'></"+"script>");
		 			},
		error:function(XMLHttpRequest, textStatus, errorThrows){ // erreur durant la requete
		}
					});
				$('#charge').ajaxStart(function(request, settings) { $(this).css("visibility", "visible") });
				$('#charge').ajaxStop(function(request, settings){ $(this).css("visibility", "hidden") });*/
			});
	
   $('#srch_ville').change(function(){
			
				$.ajax({
					url: '/Site/inc/evenement.php',
					data: {'ville': $('#srch_ville').val(),'type': $('#srch_type').val()},
					type: 'GET',
					dataType: 'html',
					success: function(data) {
						//alert($('#srch_ville').val());
					$('#srch_universite').html(data);
					//document.write("<"+"script src='js/bootstrap-select.js'></"+"script>");
		 			}
					});
				
			});


/*$('tr').click(function(){
			
			var id = this.id;
			//var dep =  $('#'+id).attr("alt");
			var filiere =  $(this).attr("rel");
			//alert(id+' '+filiere);*/
            //var link = $(#id).parent().val();
    /*var link2 = $(this).parent().attr('href');
    alert(link2);
			 //var link = 'universite/presentation.php?univ_id='+id+'&filiere='+filiere+'#'+filiere;
            // window.location.href=link;
			//alert(id);
			});
			
			$('.check').click(function(){
			
			var id = this.id;
			var val =  $(this).attr('id');
			alert(id);
			//alert(id);
				
				
			});*/
			
			// commentaires
			$('#add_comment').click(function(e){
			
			$('.load_comment').show('slow');
			//alert(id);
				
				
			});
			
			
		    
		    $("#valide").on("click",function(e){
		        
		        
		        //var id = $(this).attr('id');
				//var val =  $(this).parent().attr('class');
				var contenu = $("#contenu").val();
				var pseudo = $("#pseudo").val();
				var email = $("#email").val();
				//var id_reponse = 'reponse'+ load_comment_id ;
				if(add_comment_id == "ajouter_commentaire"){
					if(contenu != ''){
                
                var commentaire = '<li id="6"  class="media">'
                                +'<a class="pull-left" href="#">'
                                    +'<img class="media-object img-text" src="../assets/img/users/no-image.jpg" alt="'+pseudo+'" width="64">'
                                +'</a>'
                                +'<div class="media-body">'
                                    +'<h6 class="media-heading">'+pseudo+' <span style="font-size: 11px;color: #AAA;">&nbsp;&nbsp;&nbsp; 23 Mai 2015, 01:45</span> </h6>'
                                    +'<p>'+contenu+'</p>'
                                    +'<p class="text-muted"><a disabled="disabled" class="load_comment" href="#">répondre</a></p>'
                                +'</div>'
                            +'</li>';
                    $("#add_comment").modal("hide");
                $('.media-list').prepend(commentaire);
            }
				}
				else{
            if(contenu != ''){
                
                var commentaire = '<div id="6"  class="media">'
                                +'<a class="pull-left" href="#">'
                                    +'<img class="media-object img-text" src="../assets/img/users/no-image.jpg" alt="'+pseudo+'" width="64">'
                                +'</a>'
                                +'<div class="media-body">'
                                    +'<h6 class="media-heading">'+pseudo+' <span style="font-size: 11px;color: #AAA;">&nbsp;&nbsp;&nbsp; 23 Mai 2015, 01:45</span> </h6>'
                                    +'<p>'+contenu+'</p>'
                                    +'<p class="text-muted"><a disabled="disabled" class="load_comment" href="#">répondre</a></p>'
                                +'</div>'
                            +'</div>';
                    $("#add_comment").modal("hide");
                    if(reponse_comment_id != null)
                $('#'+reponse_comment_id).after(commentaire);
                else {
                	$('#'+load_comment_id).after(commentaire);
                }
            }
            } 
				//alert(load_comment_id);
		        e.preventDefault();
		        
		        
		    });
			
			// bouton charger le page article
			$('#charger').click(function(){
			
			var val =  $('#srch_universite').val();
			if(val == ''){
				var link = 'list.php?categorie=UNIVERSITE';
			}
			else
			var link = 'list.php?categorie=UNIVERSITE&srch_universite='+val;
             window.location.href=link;
				
				
			});
			
			$('.concours').click(function(){

                var id = this.id;
                 window.location.href=id;
				
				
			});
			
			$(":radio").click(function(){
				
                   if($("input[name='srch_domaine']:²").val() == "2"){
                   alert("Université");
               }
               else  if($("input[name='srch_domaine']:checked").val() == "1"){
                   alert("Filière");
               }
          });
          
          //if($(':checked').length == 1) { alert("Univers"); }
			
			

});
  // Ajax
  
  function afficher(donnees){ // pour remplacer le contenu du div content
	 // on vide le div
	$("#content").append(donnees); // on met dans le div le r?ltat de la requete ajax
}

function charger(page,id){
	$.ajax({  // ajax
		url: page, // url de la page ?harger
		//data: "nom="+ name,
		data: {'id': id},
		cache: false, // pas de mise en cache
		success:function(reponse){ // si la requ뵩 est un succ鳍
			
			
			afficher(reponse);	    // on execute la fonction afficher(donnees)
			
		},
		error:function(XMLHttpRequest, textStatus, errorThrows){ // erreur durant la requete
		}
	});
}

/* PANEL FUNCTIONS */
function panel_fullscreen(panel){    
    
    if(panel.hasClass("panel-fullscreened")){
        panel.removeClass("panel-fullscreened").unwrap();
        panel.find(".panel-body,.chart-holder").css("height","");
        panel.find(".panel-fullscreen .fa").removeClass("fa-compress").addClass("fa-expand");        
        
        $(window).resize();
    }else{
        var head    = panel.find(".panel-heading");
        var body    = panel.find(".panel-body");
        var footer  = panel.find(".panel-footer");
        var hplus   = 30;
        
        if(body.hasClass("panel-body-table") || body.hasClass("padding-0")){
            hplus = 0;
        }
        if(head.length > 0){
            hplus += head.height()+21;
        } 
        if(footer.length > 0){
            hplus += footer.height()+21;
        } 

        panel.find(".panel-body,.chart-holder").height($(window).height() - hplus);
        
        
        panel.addClass("panel-fullscreened").wrap('<div class="panel-fullscreen-wrap"></div>');        
        panel.find(".panel-fullscreen .fa").removeClass("fa-expand").addClass("fa-compress");
        
        $(window).resize();
    }
}

function panel_collapse(panel,action,callback){

    if(panel.hasClass("panel-toggled")){        
        panel.removeClass("panel-toggled");
        
        panel.find(".panel-collapse .fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");

        if(action && action === "shown" && typeof callback === "function")
            callback();            

        onload();
                
    }else{
        panel.addClass("panel-toggled");
                
        panel.find(".panel-collapse .fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");

        if(action && action === "hidden" && typeof callback === "function")
            callback();

        onload();        
        
    }
}
function panel_refresh(panel,action,callback){        
    if(!panel.hasClass("panel-refreshing")){
        panel.append('<div class="panel-refresh-layer"><img src="img/loaders/default.gif"/></div>');
        panel.find(".panel-refresh-layer").width(panel.width()).height(panel.height());
        panel.addClass("panel-refreshing");
        
        if(action && action === "shown" && typeof callback === "function") 
            callback();
    }else{
        panel.find(".panel-refresh-layer").remove();
        panel.removeClass("panel-refreshing");
        
        if(action && action === "hidden" && typeof callback === "function") 
            callback();        
    }       
    onload();
}
function panel_remove(panel,action,callback){    
    if(action && action === "before" && typeof callback === "function") 
        callback();
    
    panel.animate({'opacity':0},200,function(){
        panel.parent(".panel-fullscreen-wrap").remove();
        $(this).remove();        
        if(action && action === "after" && typeof callback === "function") 
            callback();
        
        
        onload();
    });    
}

$(function(){            
    onload();

    /* PROGGRESS COMPLETE */
    $.mpb("update",{value: 100, speed: 5, complete: function(){            
        $(".mpb").fadeOut(200,function(){
            $(this).remove();
        });
    }});
    /* END PROGGRESS COMPLETE */
});

$(window).resize(function(){
    x_navigation_onresize();
    page_content_onresize();
});

function onload(){
    x_navigation_onresize();    
    page_content_onresize();
}
