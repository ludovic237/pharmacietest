$(document).ready(function () {


    $("#tab_RetourProduit_Achete").hide();
    $("#tab_RetourProduit_Retourne").hide();

    $("#search-reference-produit").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            //$("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                //alert(recherche);
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/result_retour.php",
                    data: {
                        motclef: recherche
                    },
                   error: function (e) {
                loader(false);
            },
            success: function (data) {
                        //alert(data);
                        $('#tab_RetourProduit_Retourne').empty();
                        $("#tab_RetourProduit_Achete").empty();
                        $('#search-reference-produit').val('');
                        $("#prixTotal").html("0");
                        $("#prixReduit").html("0");
                        $("#netTotal").html("0");
                        $("#tab_RetourProduit_Achete").html(data).show();
                    }
                })
            } else {
                //$("#resultat ul").empty();
            }
        } else {
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/readreference.php',
                data: 'keyword=' + $(this).val(),
                beforeSend: function () {
                    $("#search-reference-produit").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
               error: function (e) {
                loader(false);
            },
            success: function (data) {
                    //alert(data);
                    $("#suggesstion-reference-produit-block").show();
                    $("#suggesstion-reference-produit").html(data).show();
                    $("#suggesstion-reference-produit").css("background", "#FFF");

                }
            });
        }
    })
    loadListProduitRetour();

});

function load_produit_retour(en_rayon_id, vente_id) {
    var qte = parseInt($("#R" + en_rayon_id + " .stock").html());
    var reduc = parseInt($("#R" + en_rayon_id + " .reduction").html());
    var prix = $("#R" + en_rayon_id + " .prix").html();
    var prixTotal = 0, prixReduit = 0, reductionRayon = 0, nom = $("#R" + en_rayon_id + " .nom").html();
    //alert(qte);
    reductionRayon = ((prix)*reduc/100);
    var reductionData = Math.ceil((reductionRayon / 5) * 5) + "";
    //console.log(reductionData)
    var firstData = reductionData.substr(0, reductionData.length - 2).toString();
    //console.log(firstData)
    var lastData = "";
    var finalReductionTotal = 0;
    if (reductionData.length >= 2) {
        var second = parseInt(reductionData.substr(reductionData.length - 2));
        //console.log(second)
        if (second < 100 && second >= 75) {
            lastData = "75";
        } else if (second < 75 && second >= 50) {
            lastData = "50";
        } else if (second < 50 && second >= 25) {
            lastData = "25";
        } else if (second < 25 && second >= 0) {
            lastData = "00";
        }
        finalReductionTotal = parseInt(firstData + lastData)+25;
    }
    var cat = '<tr id="' + en_rayon_id + '">'
        + ' <td><strong>' + nom + '</strong></td>'
        + '<td>' + prix + '</td>'
        + '<td><p></p><div class=\'input-group\'style=\'width:100px;\' >' +
        '<span class=\'input-group-btn\'>' +
        '                                                <button type=\'button\' class=\'btn btn-default btn-number moins\'' +
        '                                                        onclick="change_input(\'moins\',\'inputQte' + en_rayon_id + '\',\'' + qte + '\')"' +
        '                                                        style=\'padding: 4px;\'>' +
        '                                                    <span class=\'glyphicon glyphicon-minus\'></span>' +
        '                                                </button>' +
        '                                            </span>' +
        '                                                <input type=\'text\' name=\'quant[1]\' class=\'form-control input-number\'' +
        '                                                       id="inputQte' + en_rayon_id + '"' +
        '                                                       value="1" style=\'width: 40px;\'>' +
        '                                                <span class=\'input-group-btn\'>' +
        '                                                <button type=\'button\' class=\'btn btn-default btn-number plus\'' +
        '                                                        onclick="change_input(\'plus\',\'inputQte' + en_rayon_id + '\',\'' + qte + '\')"' +
        '                                                        style=\'padding: 4px;\'>' +
        '                                                    <span class=\'glyphicon glyphicon-plus\'></span>' +
        '                                                </button>' +
        '                                            </span>' +
        '                                            </div>' +
        '                                            <p></p>' +
        '</td>'
        + '<td>' + finalReductionTotal + '</td>'
        + '</tr>';
    $('#tab_RetourProduit_Retourne').prepend(cat).show();
    $('#tab_RetourProduit_Retourne  tr').each(function (i) {
        var id1 = $(this).attr("id");
        var prix1, qte1, reduction;
        ////alert(id1);

        $("#" + id1 + " td").each(function (j) {
            //alert($(this).html());
            if (j == 1) { prix1 = parseInt($(this).html()); }
            if (j == 2) { qte1 = parseInt($("#inputQte" + id1).val()); prixTotal = prixTotal + (prix1 * qte1); }
            if (j == 3) { reduction = parseInt($(this).html()); prixReduit = prixReduit + (reduction*qte1); }

        });

    });
    $('#prixTotal').html(prixTotal);
    $('#prixReduit').html(prixReduit);
    $('#netTotal').html((prixTotal - prixReduit));
    $("#search-reference-produit").attr("data", $('#R' + en_rayon_id).attr("data"))
    $('#R' + en_rayon_id).empty("slow");

}

function change_input(option, id, max) {
    var prixTotal = 0, prixReduit = 0;
    if (option == 'plus') {
        if ($("#" + id).val() == '' || $("#" + id).val() == null)
            $("#" + id).val(1);
        else if (parseInt($("#" + id).val()) < parseInt(max))
            $("#" + id).val(parseInt($("#" + id).val()) + 1);
    } else {
        if (parseInt($("#" + id).val()) != 0)
            $("#" + id).val(parseInt($("#" + id).val()) - 1);
    }
    $('#tab_RetourProduit_Retourne  tr').each(function (i) {
        var id1 = $(this).attr("id");
        var prix1, qte1, reduction;
        ////alert(id1);

        $("#" + id1 + " td").each(function (j) {
            ////alert($(this).html());
            if (j == 1) { prix1 = parseInt($(this).html()); }
            if (j == 2) { qte1 = parseInt($("#inputQte" + id1).val()); prixTotal = prixTotal + (prix1 * qte1); }
            if (j == 3) { reduction = parseInt($(this).html()); prixReduit = prixReduit + (reduction*qte1); }

        });

    });
    $('#prixTotal').html(prixTotal);
    $('#prixReduit').html(prixReduit);
    $('#netTotal').html((prixTotal - prixReduit));
}

function valider_retour(employe_id) {
    //alert($("#search-reference-produit").attr("data"));
    loader(true);
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/enregistrer_retour.php",
        data: {
            idVente: $("#search-reference-produit").attr("data"),
            idEmp: employe_id
        },
       error: function (e) {
                loader(false);
            },
            success: function (data) {
            //alert(data);
            $('#tab_RetourProduit_Retourne  tr').each(function (i) {
                var id1 = $(this).attr("id");

                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/enregistrer_retour_produit.php",
                    data: {
                        id: id1,
                        qte: parseInt($("#inputQte" + id1).val())
                    },
                   error: function (e) {
                loader(false);
            },
            success: function (data) {
                        //alert(data);
                        $('#tab_RetourProduit_Retourne').empty();
                        $("#tab_RetourProduit_Achete").empty();
                        $('#search-reference-produit').val('');
                        $("#prixTotal").html("0");
                        $("#prixReduit").html("0");
                        $("#netTotal").html("0");
                        loadListProduitRetour();

                    }
                })
                loader(false);
            })

        }
    })
}

function loadListProduitRetour() {

    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/list_retour_produit.php",
        data: {
            //id: 18
        },
        dataType: "json",
       error: function (e) {
                loader(false);
            },
            success: function (data) {
            //alert(data);
            var datas = data;
            $('#tabRetourProduit').dataTable({
                destroy: true,
                searching: true,
                dFilter: true,
                bInfo: true,
                bPaginate: true,
                data: datas.data,
                columns: [
                    {data: "employe_id"},
                    {data: "vente_id"},
                    {
                        "data": "dateRetour", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="datevte">' + data + '</strong>';
                        }
                    },
                    {data: "caisse_id"},
                    {data: "list"},
                    {data: "quantite_total_produitRetour"},
                    {data: "prix"},
                    {
                        data: "id", "bSortable": false, "render": function (data) {
                            return '   <button class="btn btn-primary btn-rounded btn-sm" onClick="imprime_retour_produit(' + data + ');">Imprimer</button>  ';
                        }
                    }
                ],
                order:[[2,'desc']]
            });

        }
    })
}

function imprime_retour_produit(id) {
    var datevte = $("#" + id + " .datevte").html();
    var yo = datevte;
    var date = yo.substr(0, 10);
    var heure = yo.substr(12, 8);
    //var tab = explode(" ", datevte);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_produit_retour.php',
        data: {
            id: id
        },
        dataType: 'json',
        success: function (server_responce) {
            let retour_produits = server_responce.data;
            console.log("server_responce");
            console.log(server_responce);
            $('#iconPreviewRetourProduit .reference').html(server_responce.reference+'');
            $('#iconPreviewRetourProduit .datevente').html(server_responce.date_retour+'');
            $('#iconPreviewRetourProduit .heurevente').html(server_responce.heurevente+'');
            $('#iconPreviewRetourProduit .caissier').html(server_responce.caisse_user+'');
            $('#iconPreviewRetourProduit .employe').html(server_responce.employe+'');

            $('#iconPreviewRetourProduit .montanttotal').html(server_responce.montant+'');


            qrcode = new QRCode(document.getElementById("qrcodeTicket"), {
                width: 90,
                height: 90
            });
            qrcode.clear();
            qrcode.makeCode(id);

            $('#tab_vente_caisse').empty();
            $('#tab_BfactureImprimer  tr').each(function (i) {
                if ($(this).attr("class") == 'ligne_facture') {
                    //alert("passe");
                    $(this).remove();
                }
            });
            //$('#tab_vente_caisse').html(server_responce);
            for (i in retour_produits) {
                $('#tab_BfactureImprimer').prepend(`
                        <tr class="ligne_facture" id="${retour_produits[i].DT_RowId}">
                            <td style='background-color: white;font-family: monospace;font-size: 10px;text-align: start;'><strong class='nom'>${retour_produits[i].produit}</strong></td>
                            <td style='background-color: white;font-family: monospace;font-size: 10px;text-align: start;'><strong class='prixUnit'>${retour_produits[i].prix}</strong></td>
                            <td style='background-color: white;font-family: monospace;font-size: 10px;text-align: start;'><strong class='quantite'>${retour_produits[i].quantite_total_produitRetour}</strong></td>
                            <td style='background-color: white;font-family: monospace;font-size: 10px;text-align: start;'><strong class='total'>${retour_produits[i].total}</strong></td>
              
                        </tr>
                    `);
            };
            $("#iconPreviewListeCaisse").modal('hide');
            $('#iconPreviewRetourProduit').modal("show");
        }
    })
}