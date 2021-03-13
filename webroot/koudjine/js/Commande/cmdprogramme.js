$(document).ready(function () {
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();

    $("#iconPreviewForm .champ").keyup(function (event) {
        if (event.keyCode == 13){
            //alert('passe');
            var id = $(this).attr("id");
            var position = $("#"+id).attr("data");
            position = parseInt(position);
            position = position + 1;
            $("#iconPreviewForm .champ"+position).focus();
            //$("#iconPreviewForm .champ"+position).val(position);
        }
    })

    $('#iconPreviewForm').on('show.bs.modal', function () {
        ////alert('passe');
        $("#tab_BCrecherche").hide();
        $("#tab_GCrecherche").hide();
    })

    //Recherche rapide
    $("#recherche_commande_prog").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/result_commande_prog2.php",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if(data.erreur == "non"){
                            load_produit(data.id, data.nom, data.prixA, data.prixV, data.reduction);
                            $('#recherche').val("");
                            $("#tab_BCrecherche").empty();
                            $("#tab_GCrecherche").hide();
                        }
                        else {
                            $('#message-box-danger p').html(data.erreur);
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
                        }
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_BCrecherche").empty();
                $("#tab_GCrecherche").hide();
            }
        } else {
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

function load_produit(id, nom, prixachat, prixvente, reduction) {

    $("#tab_BCrecherche").hide();
    $("#tab_BCrecherche").empty();
    $("#tab_GCrecherche").hide();
    $('#nom_cmdprogramme').val(nom);
    $('#reduction_max').val(reduction);
    $('#recherche_commande_prog').val('');
    $('#prixachat_cmdprogramme').val(prixachat);
    $('#prixpublic_cmdprogramme').val(prixvente);
    $('#id_xr').attr("data", id);
    $("#iconPreviewForm").modal("show");
}

function enregistrer_commande_programme() {


    if($("#fournisseur_commande option:selected").val() == 0 || $("#numero_bon_livraison").val() == ''){
        $('#message-box-danger p').html("Veuillez selectionner un fournisseur et entrer le numero de Livraison !!!");
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);
        $("#iconPreviewForm").modal("hide");
    }else {
        var id = $('#id_xr').attr("data");
        var nom = $('#nom_cmdprogramme').val();
        var ug, qte = $('#qte_cmdprogramme').val();
        if($('#ug_cmdprogramme').val() != '')
            ug = $('#ug_cmdprogramme').val();
        else
            ug = 0;
        var prixachat = $('#prixachat_cmdprogramme').val();
        var prixpublic = $('#prixpublic_cmdprogramme').val();
        var reduction = $('#reduction_max').val();
        var date = $('#date_cmdprogramme').val();
        if(date == '' || qte == ''){
            alert("Vérifier les champs Quantité et Date !!!");
        }
        else{
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = yyyy  + mm  + dd;

            var codefournisseur = $('#fournisseur_commande option:selected').attr("data");



            var codebarre = id + "" + codefournisseur + "" + today;

            var data = {
                nom: nom,
                qte: qte,
                ug: ug,
                prixachat: prixachat,
                prixpublic: prixpublic,
                date: date,
            };

            var cat = '<tr id=' + codebarre + ' >'
                + ' <td class="nom" data="' + id + '" ><strong>' + nom + '</strong></td>'
                + '<td class="qte">' + qte + '</td>'
                + '<td class="ug">' + ug + '</td>'
                + '<td class="prixachat">' + prixachat + '</td>'
                + '<td class="prixpublic">' + prixpublic + '</td>'
                + '<td class="date">' + date + '</td>'
                + '<td class="reduction">' + reduction + '</td>'
                + '<td>'
                + '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_row_commande(' + codebarre + ')" ><span class="fa fa-times"></span></button>'
                + '<button class="btn btn-primary btn-rounded btn-sm" onClick="showPrintCmdProgramme(' + codebarre + ');" >Imprimer Ticket</span></button>'
                + '</td>'
                + '</tr>';
            $('#tab_commande_programme').prepend(cat);
            var total, prixTotal = 0, qteTotal = 0, ugTotal = 0;
            qte = 0;
            ug = 0;
            $('#tab_commande_programme  tr').each(function (i) {
                var id1 = $(this).attr("id");

                $("#" + id1 + " td").each(function (j) {
                    ////alert($(this).html());
                    if (j == 1) { qte = parseInt($(this).html()); qteTotal = qteTotal + qte; }
                    if (j == 2) { ug = parseInt($(this).html()); ugTotal = ugTotal + ug; alert(ugTotal); }
                    if (j == 3) { total = (qte * parseInt($(this).html())); prixTotal = prixTotal + total; }

                });

            });
            $('#prixTotal').html(prixTotal);
            $('#prixTotal').attr("data", qteTotal);
            $('#prixTotal').attr("data1", ugTotal);

            //alert(JSON.stringify(data));
            $("#iconPreviewForm").modal("hide");
            $('#qte_cmdprogramme').val('');
            $('#date_cmdprogramme').val('');
        }
        //alert(id);


    }

}

function showPrintCmdProgramme(id) {

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = dd + "-" + mm + "-" + yyyy;
    var todayCode = dd + "" + mm + "" + yyyy;
    var nom = $("#" + id + " .nom").html();
    var datelivraisron = $("#" + id + " .date").html();
    var codefournisseur = $('#fournisseur_commande option:selected').attr("data");

    //var date = $("#" + id + " .date").html();
    //date = date.replaceAll("-", "");

    var codebarre = id + "" + codefournisseur + "" + todayCode;

    $('#iconPreviewPrintCmdProgramme .nom').html(nom);
    $("#iconPreviewPrintCmdProgramme .codefournisseur").html(codefournisseur);
    $("#iconPreviewPrintCmdProgramme .codebarre").barcode(
        codebarre, // Value barcode (dependent on the type of barcode)
        "code128" // type (string)

    );

    $("#iconPreviewPrintCmdProgramme .today").html(today);
    $("#iconPreviewPrintCmdProgramme .datelivraisron").html(datelivraisron);

    $("#iconPreviewPrintCmdProgramme").modal("show");
}

function imprimer_cmdProgramme(titre, objet) {
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
function delete_row_commande(id) {
    var total;
    $("#" + id).remove();

    var prixTotal = 0,qte;
    $('#tab_commande_programme  tr').each(function (i) {
        var id1 = $(this).attr("id");

        $("#" + id1 + " td").each(function (j) {
            ////alert($(this).html());
            if (j == 1) { qte = parseInt($(this).html()); }
            if (j == 2) { total = (qte * parseInt($(this).html())); prixTotal = prixTotal + total; }

        });

    });
    $('#prixTotal').html(prixTotal);
}
function valider_commande(imprimer) {
    var prixTotal, idc, ref;
    var prix, qte, ug, prixPublic, reduction, datep,nomP, count=0, rec=0;
    var h = 1, total = 0, nbre = 0;
    prixTotal = parseInt($('#prixTotal').html());
    var today = new Date();
    var dd = String(today.getDate()).padStart(2,'0');
    var mm = String(today.getMonth()+1).padStart(2,'0');
    var yyyy = today.getFullYear();
    var time = today.getHours()+":"+today.getMinutes()+":"+today.getSeconds();
    today = yyyy+"-"+mm+"-"+dd+"  "+time;
    //alert(parseInt($("#prixTotal").attr("data1")));
    $("#date").html(today);
    if (prixTotal == 0) {
        alert('Veuillez sélectionner des produits !!!');
    } else if ($("#fournisseur_commande").val() == 0) {
        alert('Veuillez sélectionner un fournisseur!!!');
    } else {
        $.ajax({
            type: "POST",
            url: "/pharmacietest/koudjine/inc/enregistrer_commande.php",
            data: {
                idf: parseInt($("#fournisseur_commande").val()),
                numLivraison: $("#numero_bon_livraison").val(),
                montant: prixTotal,
                datel: today,
                qte: parseInt($("#prixTotal").attr("data")),
                ug: parseInt($("#prixTotal").attr("data1"))
            },
            dataType: 'json',
            success: function (data) {
                //alert(data);
                //alert('tpasse');
                //alert(data.erreur);
                if (data.erreur == 'ok') {
                    //alert('passe');
                    idc = data.id;
                    ref = data.ref;
                    //alert(idc);
                    $('#tab_commande_programme  tr').each(function (i) {
                        count++;});
                    console.log(count);
                    $('#tab_commande_programme  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        var id2 = $("#" + id1 + " .nom").attr("data");
                        //alert(id2);

                        ////alert(id1);


                        $("#" + id1 + " td").each(function (j) {
                            ////alert($(this).html());
                            if (j == 0) { nomP = $(this).html(); }
                            if (j == 1) { qte = parseInt($(this).html()); }
                            if (j == 2) { ug = parseInt($(this).html()); }
                            if (j == 3) { prix = parseInt($(this).html()); }
                            if (j == 4) { prixPublic = parseInt($(this).html()); }
                            if (j == 5) { datep = $(this).html(); }
                            if (j == 6) { reduction = $(this).html(); }

                        });
                        var cat = '<tr>'
                            + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">'+h+'</td>'
                            + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;font-size: 10px;">' +nomP + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + qte + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + qte + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + ug + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + prix + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + prixPublic + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + (prix * qte) + '</td>'
                            + '</tr>';
                        $('#tab_Bcommande_Recu').append(cat);
                        h++;
                        total = total + (prix * qte);
                        nbre = nbre +  qte;
                        //alert(prix+'-'+qte+'-'+prixPublic);
                        $.ajax({
                            type: "POST",
                            url: "/pharmacietest/koudjine/inc/produit_commande.php",
                            data: {
                                idc: idc,
                                idp: id2,
                                ide: id1,
                                prixu: prix,
                                prixp: prixPublic,
                                datep: datep,
                                qte: qte,
                                ug: ug,
                                reduction: reduction
                            },
                            success: function (server_responce) {
                                alert(server_responce);
                                //alert(idc);
                                //alert("OK");
                                rec++;

                                $("#mb-confirmation").attr("data", idc);
                                //alert($("#mb-confirmation").attr("data"));
                                if(imprimer && rec == count){
                                    //imprimer_com(idc, ref, $('#fournisseur_commande option:selected').text());
                                    var cat = '<tr>'
                                        + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="6">Total</td>'
                                        + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"><strong>' +total+ '</strong></td>'
                                        + '</tr>';
                                    $('#tab_Bcommande_Recu').append(cat);
                                    //$("#totalRecu").html(total);
                                    $("#article_commande").html(h-1);
                                    $("#produit_commande").html(nbre);
                                    var yo = ref;
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
                                    $("#bordereau_livraison").html($("#numero_bon_livraison").val());
                                    $("#rec_commande").html(chaine);
                                    $("#ref_commande").html(ref);
                                    $("#nomf_commande").html($('#fournisseur_commande option:selected').text());
                                    $("#date_commande").html(today);
                                    $("#iconPreviewRecu").modal("show");
                                }else{

                                    if(rec == count){
                                        console.log('Redirige');
                                        var link = '/pharmacietest/bouwou/commande/list';
                                        window.location.href = link;
                                    }
                                }
                                /*if(data1.erreur == 'ok'){
                                    var link = '/pharmacietest/users/logout';
                                    ////alert(link);
                                    window.location.href = link;
                                }*/
                            }
                        })

                    });

                }


            }
        })
    }


}

function imprimer_bloc(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet).innerHTML;
    //alert("Hello");
    // Ouverture du popup,
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

