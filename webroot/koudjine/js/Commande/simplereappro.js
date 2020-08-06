$(document).ready(function(){
    //$("#div_inventaire").hide();
    $("#tab_Crecherche").hide();

});

function ajouter_commande() {

}
function charger_commande() {
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function inventorier_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'creer',
            id: id,
            qte: 0,
            employe_id: $("#recherche_inventaire").attr("data"),
            qteRestante: 0
        },
        success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .inventorier_inventaire').attr("disabled", "disabled");
            $('#' + id + ' .exclure_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function inventoriers_row_inventaire() {
    $('#tab_BNIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");

        if($("#" + id1 + " .inventorier_inventaire").attr("disabled") != "disabled"){
            inventorier_row_inventaire(id1);
        }

    });
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function exclure_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/exclure_inventaire.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .exclure_inventaire').attr("disabled", "disabled");
            $('#' + id + ' .inventorier_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function exclures_row_inventaire() {
    $('#tab_BNIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");
        //alert(id1);
        //if(id1 == '')
        if($("#" + id1 + " .exclure_inventaire").attr("disabled") != "disabled"){
            //alert('paasa');
            exclure_row_inventaire(id1);
        }

    });
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function ajouter_inventaire(id) {
    $("#quantiteajoute").attr("data", id);
    $("#iconPreviewInventaire").modal("show");
}
function ajouter_row_inventaire() {
    var id = $("#quantiteajoute").attr("data");
    var qte = parseInt($("#quantiteajoute").val());
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'ajouter',
            id: id,
            qte: qte
        },
        success: function (server_responce) {
            //alert(id);
            var val = ''+id;
            //alert($('#'+ id + ' .qteinventaire').html());
            //$('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
            $("#iconPreviewInventaire").modal("hide");
            var link = '/pharmacietest/bouwou/stock/inventaire';
            window.location.href=link;
            //$("#"+id+" .qtevalide").html(parseInt($("#"+id+" .qtevalide").html())+ qte);
        }
    })
}
function charger_inventaire() {
    id= $('#select_inventaire').val();
    var link = '/pharmacietest/bouwou/stock/inventaire/'+id;
    window.location.href=link;
}



