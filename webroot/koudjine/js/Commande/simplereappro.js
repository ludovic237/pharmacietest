$(document).ready(function(){
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();

    //Recherche rapide
    $("#recherche_commande").keyup(function (event) {
        var recherche = $(this).val();
        recherche = $.trim(recherche);
        var data = 'motclef1=' + recherche;
        if (recherche.length > 1) {
            ////alert('yes');
            $.ajax({
                type: "GET",
                url: "/pharmacietest/koudjine/inc/result_commande.php",
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
    })

});

function ajouter_commande(id) {
    var nom, prix, qte;
    $("#" + id + " td").each(function (j) {
        ////alert($(this).html());
        if (j == 0) { nom = $(this).html(); }
        if (j == 4) { prix = parseInt($("#inputPrix"+id).val()); }
        if (j == 5) { qte = parseInt($("#input"+id).val()); }

    });
    $('#tab_commande  tr').each(function(i){
        var id1 = $(this).attr("id");
        var id2 = 'C'+id;
        if(id2 == id1){
            delete_row_commande(id);
        }

    });
    // ajout de la ligne
    var cat = '<tr id="C' + id + '">'
        + ' <td><strong>' +nom + '</strong></td>'
        + '<td>' + prix + '</td>'
        + '<td>' + qte + '</td>'
        + '<td>' + (prix * qte) + '</td>'
        + '<td>'
        + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row_commande(\'' + id + '\');"><span class="fa fa-times"></span></button>'
        + '</td>'
        + '</tr>';
    $('#tab_commande').prepend(cat);
    var total, prixTotal = 0, qteTotal = 0;
    qte = 0;
    $('#tab_commande  tr').each(function(i){
        var id1 = $(this).attr("id");

        $("#"+id1+" td").each(function(j){
            ////alert($(this).html());
            if(j==2) {qte = parseInt($(this).html());  qteTotal = qteTotal + qte;}
            if(j==3) {total = parseInt($(this).html());  prixTotal = prixTotal + total;}

        });

    });
    $('#prixTotal').html(prixTotal);
    $('#prixTotal').attr("data",qteTotal);
    $('#btn-modifier' + id ).show();
    $('#btn-ajouter' + id ).attr("disabled", "disabled");
}
function modifier_commande(id) {
    $('#btn-modifier' + id ).hide();
    $('#btn-ajouter' + id ).removeAttr("disabled");
    delete_row_commande(id);
}
function valider_commande(imprimer) {
    var prixTotal, idc, ref;
    prixTotal = parseInt($('#prixTotal').html());
    if(prixTotal == 0){
        alert('Veuillez sélectionner des produits !!!');
    } else if($("#fournisseur_commande").val() == 0){
        alert('Veuillez sélectionner un fournisseur!!!');
    }else{
        $.ajax({
            type: "POST",
            url: "/pharmacietest/koudjine/inc/enregistrer_commande.php",
            data: {
                idf: parseInt($("#fournisseur_commande").val()),
                montant: prixTotal,
                qte: parseInt($("#prixTotal").attr("data"))
            },
            dataType: 'json',
            success: function (data) {
                //alert(server_responce);
                ////alert('tpasse');
                if (data.erreur == 'ok') {
                    idc = data.id;
                    ref = data.ref;
                    //alert(idc);

                    $('#tab_commande  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        var prix, qte;
                        ////alert(id1);


                        $("#" + id1 + " td").each(function (j) {
                            ////alert($(this).html());
                            if (j == 1) { prix = parseInt($(this).html()); }
                            if (j == 2) { qte = parseInt($(this).html()); }


                        });
                        ////alert(prix+'-'+qte+'-'+prixReduit);
                        $.ajax({
                            type: "POST",
                            url: "/pharmacietest/koudjine/inc/produit_commande.php",
                            data: {
                                idc: idc,
                                idp: id1,
                                prixu: prix,
                                qte: qte
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

                    });
                    if(imprimer){
                        //imprimer_com(idc, ref, $('#fournisseur_commande option:selected').text());
                        $.ajax({
                            type: "POST",
                            url: '/pharmacietest/koudjine/inc/charger_list_commande.php',
                            data: {
                                id: idc
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
                        $(".nomf_commande").html($('#fournisseur_commande option:selected').text());
                        $("#iconPreviewBonCommande").modal("show");
                    }
                }


            }
        })
    }

}
function delete_row_commande(id) {
    var total;
    $("#C"+id ).remove();

        var prixTotal = 0;
        $('#tab_commande  tr').each(function(i){
            var id1 = $(this).attr("id");

            $("#"+id1+" td").each(function(j){
                ////alert($(this).html());
                if(j==3) {total = parseInt($(this).html());  prixTotal = prixTotal + total;}

            });

        });
        $('#prixTotal').html(prixTotal);
}

function change_input(option, id) {
    if(option == 'plus'){
        $("#"+id).val(parseInt($("#"+id).val())+1);
    }
    else {
        if(parseInt($("#"+id).val()) != 0)
        $("#"+id).val(parseInt($("#"+id).val())-1);
    }
}
function charger_commande() {
    var idf = $("#fournisseur_commande").val();
    var jour_vente = $("#jour_vente").val();
    if(jour_vente != "" && $.isNumeric(jour_vente)){
        var link = '/pharmacietest/bouwou/commande/simplereappro/'+idf+'/'+jour_vente;
        window.location.href=link;
    }
    else {
        alert('Vérifier vos informations');
    }
}

function showProvider() {

    $("#iconPreviewProvider").modal("show");
}

function showBonCommande() {
    $("#iconPreviewBonCommande").modal("show");
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



