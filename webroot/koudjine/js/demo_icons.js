$(function() {
    
    $(".icons-list li").on("click",function(){
        var lien = $(this).attr('id');

        $.ajax({
            type: "POST",
            url:'inc/info_universite.php',
            data:{
                id:lien
            },
            success: function(data){
                //alert(data);
                //$("#iconPreview .icon-preview").html(icon_preview);

                $("#iconPreview .nom").html(data.nom);
                $("#iconPreview .ville").html(data.ville);
                $("#iconPreview .region").html(data.region);
                $("#iconPreview .statut").html(data.statut);
                $("#iconPreview .type").html(data.type);
                $("#iconPreview .responsable").html(data.responsable);
                $("#iconPreview .bp").html(data.bp);
                $("#iconPreview .email").html(data.email);
                $("#iconPreview .phone").html(data.phone);
                $("#iconPreview .site").html(data.site);
                $("#iconPreview .parrain").html(data.parrain);
            }
        })
        
       // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreview").modal("show");
        
        
    })
    
});