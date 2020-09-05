$(document).ready(function(){
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();


});
function receptionner_commande() {
    var qte, prix, action = 0;
    $("#tab_produit_commande tr").each(function (j) {

        var id = $(this).attr("id");
        if(parseInt($("#inputQteRecu"+id).val()) != 0){
            if($("#prixVente"+id).val() == '' || $("#datePeremption"+id).val() == ''){
                alert("Veuillez renseigner les champs Prix vente et Date péremption !!!\n Quand les quantités livrés sont supérieurs à 0");
                action = 1;
            }

        }
    })
    if($('#etat_commande option:selected').text() == "Commandé"){
        alert("Veuillez changer l'état de la commande !!!");
        action = 1;
    }
    if(action == 0){
        alert("passe");
    }
}
function charger_produit_commande(id, etat, prix) {
    //alert('passe');
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_commande.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            //alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_produit_commande').empty();
            $('#tab_produit_commande').html(server_responce);
            //$('#tab_BfactureImprimer').prepend(server_responce);

        }


    })
    //alert(prix);
    $("#etat_commande option[value = '"+etat+"']").prop("selected", true);
    $('#facture_commande').attr("data",id);
    $('#facture_commande').html(prix);
}
function change_input(option, id) {
    if(option == 'plus'){
        if($("#"+id).val() == '')
            $("#"+id).val(1);
            else
        $("#"+id).val(parseInt($("#"+id).val())+1);
    }
    else {
        if(parseInt($("#"+id).val()) != 0)
            $("#"+id).val(parseInt($("#"+id).val())-1);
    }
    var prixTotal = 0, qte, prix;
    $("#tab_produit_commande tr").each(function (j) {

        var id = $(this).attr("id");
        if(parseInt($("#inputQteRecu"+id).val()) != 0){
            prixTotal = prixTotal + (parseInt($("#inputQteRecu"+id).val())*parseInt($("#prixCmd"+id).val()))
        }
        $('#facture_commande').html(prixTotal);
    })
}



