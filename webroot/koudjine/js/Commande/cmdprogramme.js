$(document).ready(function () {
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();

    //Recherche rapide
    $("#recherche_commande_prog").keyup(function (event) {
        if (event.keyCode == 13){

        }else{
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef1=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result_commande_prog.php",
                    data: data,
                    success: function (server_responce) {
                        $("#tab_GCrecherche").show();
                        $("#tab_BCrecherche").html(server_responce).show();
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_BCrecherche").empty();
                $("#tab_GCrecherche").hide();
            }
        }
    })

});

function load_produit(id) {

    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    }
    else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                ////alert(data);
                //$("#iconPreview .icon-preview").html(icon_preview);

                $('#tab_Bload_produit').html(server_responce);
                //$("#code").barcode(data.codebarre);


            }


        })



        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

    }

}

function showRecu() {
    $("#iconPreviewRecu").modal("show");
}

function imprimer_bon(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet).innerHTML;

    // Ouverture du popup
    var fen = window.open("", "", "height=auto, width=auto,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=0, top=0");

    // style du popup
    fen.document.body.style.color = '#000000';
    fen.document.body.style.backgroundColor = '#FFFFFF';
    fen.document.body.style.padding = "0px";

    // Ajout des données a imprimer
    fen.document.title = titre;
    fen.document.body.innerHTML += " " + zone + " ";

    // Impression du popup
    fen.window.print();

    //Fermeture du popup
    fen.window.close();
    return true;
}

function imprimer_recu(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet).innerHTML;

    // Ouverture du popup
    var fen = window.open("", "", "height=auto, width=auto,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=0, top=0");

    // style du popup
    fen.document.body.style.color = '#000000';
    fen.document.body.style.backgroundColor = '#FFFFFF';
    fen.document.body.style.padding = "0px";

    // Ajout des données a imprimer
    fen.document.title = titre;
    fen.document.body.innerHTML += " " + zone + " ";

    // Impression du popup
    fen.window.print();

    //Fermeture du popup
    fen.window.close();
    return true;
}




