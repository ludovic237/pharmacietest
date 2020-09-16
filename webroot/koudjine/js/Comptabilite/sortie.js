$(document).ready(function(){
    $("#tab_Grecherche").hide();
    $(".contenu").hide();
    $("#choix").change(function () {

        if ($("#choix").val() == 1) {
            ////alert('coché');
            $(".contenu").show();
        }
        else {
            $(".contenu").hide();
        }
    })
    $("#recherche").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var link = '/pharmacietest/bouwou/comptabilite/sortie/'+recherche;
            window.location.href = link;
        }
        else {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef1=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result_sortie.php",
                    data: data,
                    success: function (server_responce) {
                        $("#tab_Grecherche").show();
                        $("#tab_Brecherche").html(server_responce).show();
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_Grecherche").hide();
            }
        }

    });


});
function load_produit(id) {
    //alert(id)

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_sortie.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                //alert(server_responce);
                //$("#iconPreview .icon-preview").html(icon_preview);

                $('#tab_Bload_produit').html(server_responce);
                //$("#code").barcode(data.codebarre);


            }


        })


        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

}

