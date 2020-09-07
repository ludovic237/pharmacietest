$(document).ready(function(){
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();
    if($("#tab_produit_commande").attr("data") != null){
        charger_produit_commande($("#tab_produit_commande").attr("data"),$("#tab_produit_commande").attr("etat"),$("#tab_produit_commande").attr("prix"))
    }


});
function receptionner_commande(nbre) {
    var  action = 0;
    $("#tab_produit_commande tr").each(function (j) {

        var id = $(this).attr("id");
        if(parseInt($("#inputQteRecu"+id).val()) != 0){
            if($("#prixVente"+id).val() == '' || $("#datePeremption"+id).val() == ''){
                alert("Veuillez renseigner les champs Prix vente et Date péremption !!!\n Quand les quantités livrés sont supérieurs à 0");
                action = 1;
            }
            nbre = nbre + parseInt($("#inputQteRecu"+id).val());
            alert(nbre);

        }
    })
    if($('#etat_commande option:selected').text() == "Commandé"){
        alert("Veuillez changer l'état de la commande !!!");
        action = 1;
    }
    if(parseInt($('#facture_commande').html()) == 0){
        alert("Le montant ne peut être nul !!!");
        action = 1;
    }
    if(action == 0){
        $("#tab_produit_commande tr").each(function (j) {

            var id = $(this).attr("id");
            if(parseInt($("#inputQteRecu"+id).val()) != 0){
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/reception_commande.php",
                    data: {
                        idc: $('#facture_commande').attr("data"),
                        idp: id,
                        prixa: parseInt($("#prixCmd"+id).val()),
                        prixv: parseInt($("#prixVente"+id).val()),
                        datep: $("#datePeremption"+id).val(),
                        qte: parseInt($("#inputQteRecu"+id).val()),
                        etat: $('#etat_commande option:selected').val(),
                        total: parseInt($("#facture_commande").html()),
                        commentaire: $("#commentaire_commande").val(),
                        nbreProduit: nbre
                    },
                    success: function (server_responce) {
                        alert(server_responce);
                        /*if(data1.erreur == 'ok'){
                            var link = '/pharmacietest/users/logout';
                            ////alert(link);
                            window.location.href = link;
                        }*/
                    }
                })
            }
        })
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
        if($("#"+id).val() == '' || $("#"+id).val() == null)
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



