$(document).ready(function(){
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();
    if($("#tab_produit_commande").attr("data") != null){
        charger_produit_commande($("#tab_produit_commande").attr("data"),$("#tab_produit_commande").attr("etat"),$("#tab_produit_commande").attr("prix"))
    }


});

function number_commande(){
    $("#numerocmd").modal("show");
}

function imprimer_commande() {
    $("#numerocmd").modal("hide");
    var i = 1, total = 0, nbre = 0;
    $('#tab_Bcommande_Recu').empty();
    $("#tab_produit_commande tr").each(function (j) {

        var id = $(this).attr("id");
        if(parseInt($("#inputQteRecu"+id).val()) != 0 && $("#inputQteRecu"+id).val() != '' && $("#inputQteRecu"+id).val() != null){
            // ajout de la ligne
            var cat = '<tr>'
                + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">'+i+'</td>'
                + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;font-size: 10px;"><strong>' +$("#nom"+id).html() + '</strong></td>'
                + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + parseInt($("#inputQte"+id).val()) + '</td>'
                + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + parseInt($("#inputQteRecu"+id).val()) + '</td>'
                + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + parseInt($("#prixCmd"+id).val()) + '</td>'
                + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + parseInt($("#prixVente"+id).val()) + '</td>'
                + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + (parseInt($("#prixCmd"+id).val()) * parseInt($("#inputQteRecu"+id).val())) + '</td>'
                + '</tr>';
            $('#tab_Bcommande_Recu').append(cat);
            i++;
            total = total + (parseInt($("#prixCmd"+id).val()) * parseInt($("#inputQteRecu"+id).val()));
            nbre = nbre +  parseInt($("#inputQteRecu"+id).val());

        }
    })
    var cat = '<tr>'
        + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="6">Total</td>'
        + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"><strong>' +total+ '</strong></td>'
        + '</tr>';
    $('#tab_Bcommande_Recu').append(cat);
    //$("#totalRecu").html(total);
    $("#article_commande").html(i-1);
    $("#produit_commande").html(nbre);
    var yo = $('#facture_commande').attr("data1");
    var one = yo.substr( 0, 9);
    var three = yo.substr(12, 3);

    var chaine = one +"REC"+ three;

    var today = new Date();
    var dd = String(today.getDate()).padStart(2,'0');
    var mm = String(today.getMonth()+1).padStart(2,'0');
    var yyyy = today.getFullYear();
    var time = today.getHours()+":"+today.getMinutes()+":"+today.getSeconds();
    today = dd+"-"+mm+"-"+yyyy+"  "+time
    $("#date").html(today);
    $("#bordereau_livraison").html($("#bordereau").val());
    $("#rec_commande").html(chaine);
    $("#ref_commande").html($('#facture_commande').attr("data1"));
    $("#nomf_commande").html($('#facture_commande').attr("data2"));
    $("#date_commande").html($('#facture_commande').attr("data3"));
    $('#btn_receptionner').removeAttr("disabled");
    $("#iconPreviewRecu").modal("show");
}
function imprimer_com(id, ref, nom) {

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_list_commande.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            //alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_Bcommande_com').empty();
            $('#tab_Bcommande_com').html(server_responce);
            //alert($('#total_com').attr("data"));
            $(".article_commande").html($('#total_com').attr("data1"));
            $(".produit_commande").html($('#total_com').attr("data"));

        }


    })

    $(".ref_commande").html(ref);
    $(".nomf_commande").html(nom);
    $('#facture_commande').html('0');
    $("#iconPreviewBonCommande").modal("show");
}
function imprimer_com_recu(id, ref, nom, date, bordereau) {

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_list_commande.php',
        data: {
            id: id,
            option: 'recu'
        },
        success: function (server_responce) {
            $('#tab_Bcommande_Recu').empty();
            $('#tab_Bcommande_Recu').html(server_responce);
            //alert($('#total_com').attr("data"));
            $("#article_commande").html($('#total_com').attr("data1"));
            $("#produit_commande").html($('#total_com').attr("data"));
            $("#bordereau_livraison").html(bordereau);
            var yo = ref;
            var one = yo.substr( 0, 9);
            var three = yo.substr(12, 3);

            var chaine = one +"REC"+ three;
            $("#rec_commande").html(chaine);
            $("#ref_commande").html(ref);
            $("#nomf_commande").html(nom);
            $("#date_commande").html(date);
            $('#btn_receptionner').attr("disabled", "disabled");
            $("#iconPreviewRecu").modal("show");

        }


    })
}
function receptionner_commande(nbre) {
    var  action = 0;
    $("#tab_produit_commande tr").each(function (j) {

        var id = $(this).attr("id");
        if(parseInt($("#inputQteRecu"+id).val()) != 0 && $("#inputQteRecu"+id).val() != '' && $("#inputQteRecu"+id).val() != null){
            if($("#prixVente"+id).val() == '' || $("#datePeremption"+id).val() == ''){
                alert("Veuillez renseigner les champs Prix vente et Date péremption !!!\n Quand les quantités livrés sont supérieurs à 0");
                action = 1;
            }
            nbre = nbre + parseInt($("#inputQteRecu"+id).val());
            //alert(nbre);

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
function charger_produit_commande(id, etat, prix, ref, nom, dateC) {
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
            $('#btn_recept_commande').removeAttr("disabled");
            $('#btn_print_commande').removeAttr("disabled");

        }


    })
    //alert(prix);
    $("#etat_commande option[value = '"+etat+"']").prop("selected", true);
    $('#facture_commande').attr("data",id);
    $('#facture_commande').attr("data1",ref);
    $('#facture_commande').attr("data2",nom);
    $('#facture_commande').attr("data3",dateC);
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



