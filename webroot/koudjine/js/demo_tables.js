$(document).ready(function () {

    $("#customers2").DataTable({
        bJQueryUI: false,
        bDestroy: true,
        aaSorting: [[0, 'desc']],
    });

    $('#example').DataTable({
        "order": [[3, "desc"]]
    });

    $('#datatable1').DataTable({
        "order": [[3, "desc"]]
    });

    $("#scanner_bon").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            //$("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/gerer_bon_caisse.php",
                    data: {
                        id: recherche
                    },
                    dataType: 'json',
                    success: function (data) {
                        ////alert(data);
                        if (data.erreur == 'non') {

                            $('#tab_GBonCaisse').empty();
                            var cat = '<tr id="' + data.id + '" >'
                                + ' <td> <input class=\'nom\' type="text" value="' + data.nom + '"></td>'
                                + ' <td><input class=\'montant\' type="text" value="' + data.montant + '"></td>'
                                + '<td>'
                                + '<button class="btn btn-primary btn-rounded btn-sm" onclick="gerer_bon_caisse()" >Encaisser</button>'
                                + '</td>'
                                + '</tr>';
                            $('#tab_GBonCaisse').prepend(cat);
                            $("#scanner_bon").val('');

                        }
                    }
                })
            }
        }
    });

    $(".argent").keyup(function (event) {
        ////alert($(this).val())
        var total = ($("#argent_1").val() * 500) + ($("#argent_2").val() * 10000) + ($("#argent_3").val() * 100) + ($("#argent_4").val() * 5000) + ($("#argent_5").val() * 50) + ($("#argent_6").val() * 2000) + ($("#argent_7").val() * 25) + ($("#argent_8").val() * 1000) + ($("#argent_9").val() * 10) + ($("#argent_10").val() * 500)
        var soustotal1 = ($("#argent_1").val() * 500) + ($("#argent_3").val() * 100) + ($("#argent_5").val() * 50) + ($("#argent_7").val() * 25) + ($("#argent_9").val() * 10)
        var soustotal2 = ($("#argent_2").val() * 10000) + ($("#argent_4").val() * 5000) + ($("#argent_6").val() * 2000) + ($("#argent_8").val() * 1000) + ($("#argent_10").val() * 500)
        $('.totalaisse').html(total);
        $('.soustotalaisse1').html(soustotal1);
        $('.soustotalaisse2').html(soustotal2);
        if (event.keyCode == 13) {
            //alert('passe');
            var id = $(this).attr("id");
            var position = $("#" + id).attr("data");
            position = parseInt(position);
            position = position + 1;
            $(".argent" + position).focus();
            $(".argent" + position).select();
            //$("#iconPreviewForm .champ"+position).val(position);
        }


    })
    $(".caisse").keyup(function (event) {
        ////alert($(this).val())
        if (event.keyCode == 13) {
            //alert('passe');
            var id = $(this).attr("id");
            var position = $("#" + id).attr("data");
            var type = $("#" + id).attr("data1");
            var limite = $("#" + id).attr("data2");
            console.log($("#" + id).attr("data3") + '-' + $("#facture_caisse").attr("data1"))
            position = parseInt(position);
            limite = parseInt(limite);
            if (position == limite) {
                // Imprimer ticket
                var box = $("#mb-confirmation-caisse");
                box.addClass("open");
                $("#mb-confirmation-caisse .mb-control-yes").focus();

                box.find(".mb-control-yes").on("click", function () {
                    box.removeClass("open");
                    valider_facture(type, $("#" + id).attr("data3"), $("#facture_caisse").attr("data1"), true);
                    console.log('passe1');
                });
                box.find(".mb-control-close").on("click", function () {
                    box.removeClass("open");

                });
            } else {
                position = position + 1;
                $("." + type + "caisse" + position).focus();
                $(".caisse" + position).select();
            }

            //$("#iconPreviewForm .champ"+position).val(position);
        }


    })
    $(".fargent").keyup(function (event) {
        ////alert($(this).val())
        var total = ($("#fargent_1").val() * 500) + ($("#fargent_2").val() * 10000) + ($("#fargent_3").val() * 100) + ($("#fargent_4").val() * 5000) + ($("#fargent_5").val() * 50) + ($("#fargent_6").val() * 2000) + ($("#fargent_7").val() * 25) + ($("#fargent_8").val() * 1000) + ($("#fargent_9").val() * 10) + ($("#fargent_10").val() * 500)
        var soustotal1 = ($("#fargent_1").val() * 500) + ($("#fargent_3").val() * 100) + ($("#fargent_5").val() * 50) + ($("#fargent_7").val() * 25) + ($("#fargent_9").val() * 10)
        var soustotal2 = ($("#fargent_2").val() * 10000) + ($("#fargent_4").val() * 5000) + ($("#fargent_6").val() * 2000) + ($("#fargent_8").val() * 1000) + ($("#fargent_10").val() * 500)
        $('.ftotalaisse').html(total);
        $('.fsoustotalaisse1').html(soustotal1);
        $('.fsoustotalaisse2').html(soustotal2);
        if (event.keyCode == 13) {
            //alert('passe');
            var id = $(this).attr("id");
            var position = $("#" + id).attr("data");
            position = parseInt(position);
            position = position + 1;
            //$(".fargent"+position).focus();
            $(".fargent" + position).select();
            //$("#iconPreviewForm .champ"+position).val(position);
        }

    })
    $('#iconPreviewCaisse').on('hidden.bs.modal', function () {
        ////alert('passe');
        $("#iconPreviewCaisse").modal("show");
    })
    $('#iconPreviewCaisseFermer').on('hidden.bs.modal', function () {
        ////alert('passe');
        $("#iconPreviewCaisseFermer").modal("show");
    })
    $('#iconPreviewRapport').on('hidden.bs.modal', function () {
        ////alert('passe');
        $("#iconPreviewRapport").modal("show");
    })
});

function close_caisse_row() {
    $("#iconPreviewCaisseFermer").modal("show");
    ////alert("session");
    /*$(".argent").keyup(function (event) {
        var detail_piece_billet = '($("#argent_1").val()*500)' + '($("#argent_2").val()*10000)' + '($("#argent_3").val()*100)' + '($("#argent_4").val()*5000)' + '($("#argent_5").val()*50)' + '($("#argent_6").val()*2000)' + '($("#argent_7").val()*25)' + '($("#argent_8").val()*1000)' + '($("#argent_9").val()*10)' + '($("#argent_10").val()*500)';

        var session = $('.session').html();
        //alert(detail_piece_billet)

    })*/

}



function close_caisse_row_valide(user_id) {
    ////alert("session");
    var total = parseInt($('.totalaisse').html());
    var detail_piece_billet = ($("#argent_1").val()) + "-" + ($("#argent_2").val()) + "-" + ($("#argent_3").val()) + "-" + ($("#argent_4").val()) + "-" + ($("#argent_5").val()) + "-" + ($("#argent_6").val()) + "-" + ($("#argent_7").val()) + "-" + ($("#argent_8").val()) + "-" + ($("#argent_9").val()) + "-" + ($("#argent_10").val());
    var session = $('.session option:selected').text();
    //var totals1 = $('.soustotalaisse1').val();
    //var totals2 = $('.soustotalaisse2').val();
    ////alert(session);
    ////alert(detail_piece_billet);
    ////alert( totals1);
    ////alert(session + "-" + detail_piece_billet + "-" + totals1 + "-" + totals2 + "-" +  total);
    //var dateOuvert    = now.getDate();
    if (total == 0) {
        //alert("Veuillez saisir votre fond de caisse")
    } else {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_session_caisse.php',
            data: {
                user_id: user_id,
                ouvertureCaisse: detail_piece_billet,
                session: session,
                fondCaisse: total,
                etat: "Ouvert",
            },
            success: function (server_responce) {

                ////alert(server_responce);
                var link = '/pharmacietest/bouwou/comptabilite/caisse';
                window.location.href = link;

            }
        });
    }


}

function valider_fermeture(caisse_id) {
    var total = parseInt($('.ftotalaisse').html());
    var detail_piece_billet = ($("#fargent_1").val()) + "-" + ($("#fargent_2").val()) + "-" + ($("#fargent_3").val()) + "-" + ($("#fargent_4").val()) + "-" + ($("#fargent_5").val()) + "-" + ($("#fargent_6").val()) + "-" + ($("#fargent_7").val()) + "-" + ($("#fargent_8").val()) + "-" + ($("#fargent_9").val()) + "-" + ($("#fargent_10").val());
    //var session = $('.session option:selected').text();
    //var totals1 = $('.soustotalaisse1').val();
    //var totals2 = $('.soustotalaisse2').val();
    ////alert(session);
    ////alert(detail_piece_billet);
    ////alert( totals1);
    ////alert(session + "-" + detail_piece_billet + "-" + totals1 + "-" + totals2 + "-" +  total);
    //var dateOuvert    = now.getDate();
    if (total == 0) {
        //alert("Veuillez saisir votre fond de caisse");
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_session_caisse.php',
            data: {
                id: caisse_id,
            },
            success: function (server_responce) {

                //alert(server_responce);
                var link = '/pharmacietest/users/logout';
                window.location.href = link;

            }
        });
    } else {
        //alert('passe');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_session_caisse.php',
            data: {
                id: caisse_id,
                fermetureCaisse: detail_piece_billet,
                fondCaisse: total,
            },
            success: function (server_responce) {

                //alert(server_responce);
                $("#iconPreviewCaisseFermer").modal("hide");
                open_rapport();

            }
        });
    }

}

function open_rapport() {
    var caisse_id = parseInt($("#tab_GBonCaisse").attr("data"));
    //alert(caisse_id);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/liste_depense.php',
        data: {
            id: caisse_id
        },
        success: function (server_responce) {
            //alert(server_responce);

            $('#tab_RapportDepense').empty();
            $('#tab_RapportDepense').html(server_responce);

        }


    })

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/liste_bon_caisse.php',
        data: {
            id: caisse_id
        },
        success: function (server_responce) {
            //alert(server_responce);

            $('#tab_RapportBon').empty();
            $('#tab_RapportBon').html(server_responce);

        }


    })
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/rapport_caisse.php',
        data: {
            id: caisse_id
        },
        dataType: 'json',
        success: function (data) {
            //alert(data);

            if (data.erreur == 'non') {
                //alert('passe');
                $("#espece_caisse_rapport").html(data.espece_caisse);
                $("#electronique_rapport").html(data.electronique);
                $("#total_entree_rapport_caisse").html((parseInt(data.electronique) + parseInt(data.espece_caisse)));

                // Charger tableau recapitulatif
                $("#total_entree_caisse").html((parseInt(data.electronique) + parseInt(data.espece_caisse) + parseInt($("#total_entree_rapport_bon").html())));
                $("#total_sortie_caisse").html((parseInt($("#total_rapport_depense").html()) + parseInt($("#total_sortie_rapport_bon").html())));
                $("#total_tout_caisse").html((parseInt($("#total_entree_caisse").html()) - parseInt($("#total_sortie_caisse").html())));

                //Système
                $("#total_entree_syst").html((parseInt(data.electronique) + parseInt(data.espece_syst) + parseInt($("#total_entree_rapport_bon").html())));
                $("#total_sortie_syst").html((parseInt($("#total_rapport_depense").html()) + parseInt($("#total_sortie_rapport_bon").html())));
                $("#total_tout_syst").html((parseInt($("#total_entree_syst").html()) - parseInt($("#total_sortie_syst").html())));

                //Difference
                $("#diff_entree").html((parseInt($("#total_entree_caisse").html()) - parseInt($("#total_entree_syst").html())));
                $("#diff_sortie").html((parseInt($("#total_sortie_caisse").html()) - parseInt($("#total_sortie_syst").html())));
                $("#diff_total").html((parseInt($("#total_tout_caisse").html()) - parseInt($("#total_tout_syst").html())));




            }

        }


    })
    $("#iconPreviewRapport").modal("show");
}
function valider_rapport() {
    var caisse_id = parseInt($("#tab_GBonCaisse").attr("data"));
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/enregistrer_session_caisse.php',
        data: {
            id: caisse_id,
            etat: 'Clot'
        },
        success: function (server_responce) {

            //alert(server_responce);
            var link = '/pharmacietest/users/logout';
            window.location.href = link;

        }
    });
}

function open_bon_caisse(caisse_id) {
    $('#tab_GBonCaisse').empty();
    $("#iconPreviewBonCaisse").modal("show");
}
function ajouter_bon_caisse() {
    $('#0').remove();
    var cat = '<tr id="0" >'
        + ' <td> <input class=\'nom\' type="text"></td>'
        + ' <td><input class=\'montant\' type="text"></td>'
        + '<td>'
        + '<button class="btn btn-primary btn-rounded btn-sm" onclick="gerer_bon_caisse()" >Générer</button>'
        + '</td>'
        + '</tr>';
    $('#tab_GBonCaisse').prepend(cat);

}
var qrcode = new QRCode(document.getElementById("codebarreimp"), {
    width: 30,
    height: 30
});
function gerer_bon_caisse() {
    $('#tab_GBonCaisse  tr').each(function (i) {
        var dateEncaisser, id1 = $(this).attr("id");
        if (parseInt(id1) == 0 && $("#" + id1 + " .montant").val() != "") {
            dateEncaisser = '';
            $('#nomclientimp').html($("#" + id1 + " .nom").val());
            $('#montantimp').html($("#" + id1 + " .montant").val());
            $('#dateimp').html(moment().format("YYYY-MM-DD HH:mm:ss"));
            qrcode.makeCode(moment().format("YYMMDDHHmmss"));
            // $("#codebarreimp").barcode(
            //     moment().format("YYMMDDHHmmss"), // Value barcode (dependent on the type of barcode)
            //     "code128" // type (string)
            // );
            $('#codebarrenulimp').html(moment().format("YYMMDDHHmmss"));

            $("#previewImprimerBonCaisse").modal("show");
        } else {
            dateEncaisser = moment().format("YYYY-MM-DD HH:mm:ss");
        }
        if (parseInt(id1) == 0 && $("#" + id1 + " .montant").val() == "") {
            alert("Veuillez entrer le montant");
        }
        else {
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/gerer_bon_caisse.php',
                data: {
                    new_id: parseInt(id1),
                    caisse_id: $("#tab_GBonCaisse").attr("data"),
                    nom: $("#" + id1 + " .nom").val(),
                    montant: parseInt($("#" + id1 + " .montant").val()),
                    dateEncaisser: dateEncaisser
                },
                success: function (server_responce) {
                    //alert(server_responce);

                    $('#tab_GBonCaisse').empty();
                    $("#iconPreviewBonCaisse").modal("hide");

                }


            })

        }

    });
}
function open_depense(caisse_id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_depense.php',
        data: {
            id: caisse_id
        },
        success: function (server_responce) {
            ////alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_Gdepense').empty();
            $('#tab_Gdepense').html(server_responce);
            var total, prixTotal = 0, qteTotal = 0;
            var qte = 0;
            $('#tab_Gdepense  tr').each(function (i) {
                var id1 = $(this).attr("id");
                prixTotal = prixTotal + parseInt($("#" + id1 + " .total").val());


            });
            $("#total_depense").html('');
            $("#total_depense").html(prixTotal);

        }


    })
    $("#iconPreviewDepense").modal("show");
}
function ajouter_depense() {
    var depense_id;
    $('#tab_Gdepense  tr').each(function (i) {
        //var id1 = $(this).attr("id");
        if (i == 0)
            depense_id = parseInt($(this).attr("data"));

    });
    depense_id++;
    var cat = '<tr id="' + depense_id + '" data="' + depense_id + '" >'
        + ' <td><strong> <input class=\'designation\' type="text"></strong></td>'
        + ' <td><input class=\'qte\' type="text"></td>'
        + ' <td><input class=\'prix\' type="text"></td>'
        + ' <td><input disabled class=\'total\' type="text"></td>'
        + '</tr>';
    $('#tab_Gdepense').prepend(cat);

}
function ajouter_une_depense() {
    $('#-1').remove();
    var cat = '<tr id="-1" >'
        + ' <td>0</td>'
        + ' <td><strong> <input class=\'designation\' type="text"></strong></td>'
        + ' <td><input class=\'qte\' type="text"></td>'
        + ' <td><input class=\'prix\' type="text"></td>'
        + ' <td><input disabled class=\'total\' type="text"></td>'
        + '<td>'
        + '<button class="btn btn-primary btn-rounded btn-sm" onclick="valider_une_depense()" >Valider</button>'
        + '</td>'
        + '</tr>';
    $('#tab_RapportDepense').prepend(cat);
}
function valider_une_depense() {
    var caisse_id = parseInt($("#tab_GBonCaisse").attr("data"));
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_depense.php',
        data: {
            new_id: -1,
            caisse_id: caisse_id,
            designation: $("#-1 .designation").val(),
            qte: parseInt($("#-1 .qte").val()),
            prix: parseInt($("#-1 .prix").val())
        },
        success: function (server_responce) {
            //alert(server_responce);
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/liste_depense.php',
                data: {
                    id: caisse_id
                },
                success: function (server_responce) {
                    //alert(server_responce);

                    $('#tab_RapportDepense').empty();
                    $('#tab_RapportDepense').html(server_responce);
                    open_rapport();

                }


            })


        }


    })
}
function valider_depense(caisse_id) {
    $('#tab_Gdepense  tr').each(function (i) {
        var id1 = $(this).attr("id");
        var send_id, id = $(this).attr("data");
        if (id == id1) {
            send_id = -1;
        } else {
            send_id = id1;
        }


        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/gerer_depense.php',
            data: {
                new_id: parseInt(send_id),
                caisse_id: caisse_id,
                designation: $("#" + id1 + " .designation").val(),
                qte: parseInt($("#" + id1 + " .qte").val()),
                prix: parseInt($("#" + id1 + " .prix").val())
            },
            success: function (server_responce) {
                //alert(server_responce);
                $("#iconPreviewDepense").modal("hide");
                //$("#iconPreview .icon-preview").html(icon_preview);


            }


        })


    });
}
function rafraichir_vente(id) {

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/rafraichir_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            ////alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_caisse').empty();
            $('#tab_caisse').html(server_responce);

        }


    })


}
function charger_vente(id) {
    $("#facture_caisse").html($("#" + id + " .prixtotal").html());
    $("#facture_caisse").attr("data", $("#" + id + " .reduction").html());
    $('#fen_facture').attr("data", id);
    //$("#"+id).addClass("alt");
    $('#tab1 .montant').val('');
    $('#tab1 .reste').val('');
    $('#ticketCaisse .reference').html($("#" + id + " .reference").html());
    $('#ticketCaisse .datevente').html($("#" + id + " .date").html());
    $('#ticketCaisse .heurevente').html($("#" + id + " .heure").html());
    $('#ticketCaisse .vendeur').html($("#" + id + " .vendeur").html());
    $('#ticketCaisse .acheteur').html($("#" + id + " .client").html());
    $('#ticketCaisse .netapayer').html($("#" + id + " .prixtotal").html());
    $('#ticketCaisse .remise').html($("#" + id + " .reduction").html());
    $('#ticketCaisse .montanttotal').html(parseInt($("#" + id + " .reduction").html()) + parseInt($("#" + id + " .prixtotal").html()));



    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            ////alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_vente_caisse').empty();
            $('#tab_GGBfactureImprimer  tr').each(function (i) {
                if ($(this).attr("class") == 'ligne_facture') {
                    //alert("passe");
                    $(this).remove();
                }
            });
            $('#tab_vente_caisse').html(server_responce);
            $('#tab_BfactureImprimer').prepend(server_responce);
            $('.Espècecaisse1').focus();


        }


    })


}

function reimprime_ticket(id) {
    var datevte = $("#" + id + " .datevte").html();
    var yo = datevte;
    var date = yo.substr(0, 10);
    var heure = yo.substr(12, 8);
    //var tab = explode(" ", datevte);
    $('#ticketListe .reference').html($("#" + id + " .reference").html());
    $('#ticketListe .datevente').html(date);
    $('#ticketListe .heurevente').html(heure);
    $('#ticketListe .vendeur').html($("#" + id + " .seller").html());
    $('#ticketListe .acheteur').html($("#" + id + " .client").html());
    $('#ticketListe .netapayer').html($("#" + id + " .prixp").html());
    $('#ticketListe .montanttotal').html($("#" + id + " .prixt").html());
    $('#ticketListe .remise').html(parseInt($("#" + id + " .prixt").html()) - parseInt($("#" + id + " .prixp").html()));



    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            ////alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_vente_caisse').empty();
            $('#tab_BfactureImprimer  tr').each(function (i) {
                if ($(this).attr("class") == 'ligne_facture') {
                    //alert("passe");
                    $(this).remove();
                }
            });
            //$('#tab_vente_caisse').html(server_responce);
            $('#tab_BfactureImprimer').prepend(server_responce);
            $('#iconPreviewFacture').modal("show");


        }


    })


}

function reimprime_ticket_caisse(id) {
    var datevte = $("#" + id + " .datevte").html();
    var yo = datevte;
    var date = yo.substr(0, 10);
    var heure = yo.substr(12, 8);
    //var tab = explode(" ", datevte);
    $('#ticketListe2 .reference').html($("#" + id + " .reference").html());
    $('#ticketListe2 .datevente').html(date);
    $('#ticketListe2 .heurevente').html(heure);
    $('#ticketListe2 .vendeur').html($("#" + id + " .seller").html());
    $('#ticketListe2 .acheteur').html($("#" + id + " .client").html());
    $('#ticketListe2 .netapayer').html($("#" + id + " .prixp").html());
    $('#ticketListe2 .montanttotal').html($("#" + id + " .prixt").html());
    $('#ticketListe2 .remise').html(parseInt($("#" + id + " .prixt").html()) - parseInt($("#" + id + " .prixp").html()));



    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            ////alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_vente_caisse').empty();
            $('#tab_BfactureImprimer2  tr').each(function (i) {
                if ($(this).attr("class") == 'ligne_facture') {
                    //alert("passe");
                    $(this).remove();
                }
            });
            //$('#tab_vente_caisse').html(server_responce);
            $('#tab_BfactureImprimer2').prepend(server_responce);
            $('#iconPreviewFacture2').modal("show");


        }


    })


}

function update_row_produit(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
    //alert(link);
    window.location.href = link;
}


function update_row_user(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/pharmanet/useradd/' + id;
    //alert(link);
    window.location.href = link;
}


function update_row_employe(int) {
    //alert("link");
    var link = '/pharmacietest/bouwou/pharmanet/employeadd/' + int;
    //alert(link);
    window.location.href = link;
}
function update_row_assureur(id) {
    var link = '/pharmacietest/bouwou/catalogue/assureuradd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_categorie(row) {

    var nom;
    // var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        // if (i == 1) {  
        //     code = $(this).html();
        // }

    });

    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    // $('#code').val(code);
    // var link = '/pharmacietest/bouwou/catalogue/categorieadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}
function update_row_client(id) {
    var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_fabriquant(id) {
    var link = '/pharmacietest/bouwou/catalogue/fabriquantadd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_fournisseur(id) {
    var link = '/pharmacietest/bouwou/catalogue/fournisseuradd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_prescripteur(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/catalogue/prescripteuradd/' + id;
    //alert(link);
    window.location.href = link;
}
function update_row_codepostal(id) {
    var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_forme(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) {
            code = $(this).html();
        }

    });

    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
    // var link = '/pharmacietest/bouwou/geonetliste/formeadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}
function update_row_magasin(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) {
            code = $(this).html();
        }

    });

    $('.titre').html('Modifier magasin');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
    // var link = '/pharmacietest/bouwou/geonetliste/magasinadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}
function update_row_rayon(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
            //alert(nom);
        }
        if (i == 1) {
            code = $(this).html();
            //alert(code);
        }

    });

    $('.titre').html('Modifier rayon');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
    // var link = '/pharmacietest/bouwou/geonetliste/rayonadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}
function update_row_unite(row) {

    var nom;
    var libelle;
    $("#" + row + " td").each(function (i) {

        if (i == 0) {
            nom = $(this).children().html();
            //alert(nom);
        }
        if (i == 1) {
            libelle = $(this).html();
            //alert(libelle);
        }

    });
    //alert(row);
    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#libelle').val(libelle);
    // var link = '/pharmacietest/bouwou/geonetliste/uniteadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}
function update_row_ville(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {

        if (i == 0) {
            nom = $(this).children().html();
            //alert(nom);
        }
        if (i == 1) {
            code = $(this).html();
            //alert(code);
        }

    });
    //alert(row);
    $('.titre').html('Modifier ville');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
    // var link = '/pharmacietest/bouwou/geonetliste/villeadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}


function delete_row(row, controller, table, confirmation) {

    if (confirmation) {
        $("#" + row).hide("slow", function () {
            var link = '/pharmacietest/bouwou/' + controller + '/delete/' + row + '/' + table;
            ////alert(link);
            /*$.ajax({

                url: link,

                success: function (data) {
                    ////alert(data);
                    //$("#iconPreview .icon-preview").html(icon_preview);
                    $(this).remove();
                }

            })*/

        });
    }
    else {
        var box = $("#mb-remove-row");
        box.addClass("open");

        box.find(".mb-control-yes").on("click", function () {
            box.removeClass("open");
            $("#" + row).hide("slow", function () {
                var link = '/pharmacietest/bouwou/' + controller + '/delete/' + row + '/' + table;
                //alert(link);
                $.ajax({

                    url: link,

                    success: function (data) {
                        //alert(data);
                        //$("#iconPreview .icon-preview").html(icon_preview);
                        $(this).remove();
                    }

                })

            });
        });
    }

}

function delete_row_filiere(row, action) {


    var box = $("#mb-remove-row");
    box.addClass("open");

    box.find(".mb-control-yes").on("click", function () {
        box.removeClass("open");
        $("#" + row).hide("slow", function () {
            var link = '/Site/bouwou/formations/delete/' + row + '/' + action;
            ////alert(link);
            $.ajax({

                url: link,

                success: function (data) {
                    ////alert(data);
                    //$("#iconPreview .icon-preview").html(icon_preview);
                    $(this).remove();
                }

            })

        });
    });

}
function delete_row_vente(id) {
    var total;
    var total1 = null;
    var reduction;
    // on verifie si le taux est coché, si oui on le décoche en chargeant le prix réduit des produits
    if ($("#check_reductionGenerale").is(":checked")) {
        $('#check_reductionGenerale').prop("checked", false);
    }

    $("#" + id + " td").each(function (i) {
        ////alert(i);
        if (i == 3) { total = parseInt($(this).html()); }
        if (i == 4) reduction = parseInt($(this).html());

    });

    $("#" + id).remove();

    /*$("#"+id+" td").each(function(i){
        ////alert(i);
        if(i==3) {total1 = $(this).html();}
        if(i==4)  reduction = $(this).html();

    });*/
    if (total1 == null) {
        var prixTotal = 0;
        var prixReduit = 0;
        $('#tab_vente  tr').each(function (i) {
            var id1 = $(this).attr("id");
            var prix, qte;
            ////alert(id1);

            $("#" + id1 + " td").each(function (j) {
                ////alert($(this).html());
                if (j == 1) { prix = parseInt($(this).html()); }
                if (j == 2) { qte = parseInt($(this).html()); prixTotal = prixTotal + (prix * qte); }
                if (j == 4) {
                    var reduction = parseInt($(this).attr("data"));
                    if ($("#select_vente_client").val() == 0 || $(".select_client").val() != 2) {
                        reduction = 0;
                    } else {
                        if ($("#select_vente_client option:selected").attr("name") >= reduction) {
                            //reduction = reduction;

                        }
                        else {
                            reduction = parseInt($("#select_vente_client option:selected").attr("name"));
                        }
                    }

                    prixReduit = prixReduit + ((prix * qte) * reduction / 100);
                }

            });

        });
        if ($("#select_vente_client").val() != 0) {
            //var prixReduit = parseInt($('#prixTotal').html())  - (parseInt($('#prixTotal').html())* (parseInt($("#select_vente_client option:selected").attr("name")) / 100));
            if (prixReduit > parseInt($("#select_vente_client option:selected").attr("data"))) {
                $('#message-box-danger p').html('Taux supérieur à la limite de réduction mensuelle du client');
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 3000);
                prixReduit = 0;
            }

        }
        $('#prixTotal').html(prixTotal);
        $('#prixReduit').html(prixReduit);
        $('#netTotal').html((prixTotal - prixReduit));

    }



}

function update_row(row) {

    var nom;
    var sigle;
    var description;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) { nom = $(this).children().html(); }
        if (i == 1) sigle = $(this).html();
        if (i == 2) description = $(this).html();
    });
    ////alert(nom);
    $('.titre').html('Modifier une faculté');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.sigle').children().val(sigle);
    $('.description').children().val(description);




}
// function update_row_categorie(row) {

//     var nom;
//     var description;
//     $("#" + row + " td").each(function (i) {
//         ////alert(i);
//         if (i == 0) { nom = $(this).children().html(); }
//         if (i == 2) description = $(this).html();
//     });
//     $("#form3").scroll('slow');
//     ////alert(nom);
//     $('.titre').html('Modifier une categorie');
//     $('.button').html('Modifier');
//     $('.button').attr('href', row);
//     $('.name').children().val(nom);
//     $('.description').children().val(description);




// }
function update_row_type(row) {

    var nom;
    var description;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) description = $(this).html();
        if (i == 3) {
            certif = $(this).children().html();
        }
    });
    ////alert(nom);
    $('.titre').html('Modifier un type d\'université');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.description').children().val(description);
    if (certif == 'En attente') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '1');

    }
    else {

        $('.selectpicker').selectpicker('val', '0');
        //$('.selectpicker').val('Certifié');
        //$('.selectpicker').selectpicker('render');
    }
}
function update_row_question(row) {

    var question;
    var type;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 1) {
            question = $(this).children().html();
        }
        if (i == 2) {
            type = $(this).html();
        }
    });
    ////alert(nom);
    $('.titre').html('Modifier une question');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.question').children().val(question);
    if (type == 'General') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '0');

    } else if (type == 'Personnalite') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '1');

    }
    else {

        $('.selectpicker').selectpicker('val', '2');
    }
}

function update_row_univ(id) {
    var link = '/Site/bouwou/universites/edit/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_concours(id) {
    var link = '/Site/bouwou/concours/edit/' + id;
    ////alert(link);
    window.location.href = link;
}

function filiere_row(iduniv, idfac) {
    var link = '/Site/bouwou/formations/index/' + iduniv + '/' + idfac;
    ////alert(link);
    window.location.href = link;
}
function filiere_categorie_row(id) {
    var link = '/Site/bouwou/formations/index/0/0/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_filiere(id) {
    var link = '/Site/bouwou/formations/edit/' + id;
    ////alert(link);
    window.location.href = link;
}
function conf_row_question(id) {
    var link = '/Site/bouwou/orientation/configuration/' + id;
    ////alert(link);
    window.location.href = link;
}
function categorie_row_question(id) {
    var link = '/Site/bouwou/orientation/recapitulatif/categorie/' + id;
    ////alert(link);
    window.location.href = link;
}

function info_row(row) {

    //var lien = $(this).attr('id');
    //alert('test');

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/info_produit.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            //alert(data);
            //$("#iconPreview .icon-preview").html(icon_preview);
            //alert(data);
            $('#iconPreview .ean13p').html(data.ean13A);
            $('#iconPreview .referencep').html(data.referenceA);
            $('#iconPreview .nomp').html(data.nomA);
            $('#iconPreview .codelaborexp').html(data.codelaborexA);
            $('#iconPreview .codeubiformp').html(data.codeubiformA);
            $('#iconPreview .stockp').html(data.stockA);
            $('#iconPreview .stockmaxp').html(data.stockmaxA);
            $('#iconPreview .stockminp').html(data.stockminA);
            $('#iconPreview .reductionmaxp').html(data.reductionmaxA);
            $('#iconPreview .contenudetailp').html(data.contenudetailA);
            $("#iconPreview .categoriep").html(data.categorieA);
            $("#iconPreview .rayonp").html(data.rayonA);
            $("#iconPreview .etagerep").html(data.etagereA);
            $("#iconPreview .magasinp").html(data.magasinA);
            $("#iconPreview .formep").html(data.formeA);
            $("#iconPreview .fabriquantp").html(data.fabriquantA);
            $("#iconPreview .fournisseurp").html(data.fournisseurA);
            $("#iconPreview .produitp").html(data.produitA);
            $("#iconPreview .prixdetailp").html(data.prixdetailA);
            $("#iconPreview .etatp").html(data.etatA);
        }

    })

    // var icon_preview = $("<i></i>").addClass(iClass);
    $("#iconPreview").modal("show");

}

// Fonctions Pharmacie

function info_row_entree(row) {

    //var lien = $(this).attr('id');
    ////alert('test');
    var code;

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/info_entree.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            //alert(data);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#iconPreviewEntree .nomp').html(data.nomP);
            $("#iconPreviewEntree .nomf").html(data.nomF);
            $("#iconPreviewEntree .code").html(data.code);
            $("#iconPreviewEntree .codebarre").html(row);
            $("#iconPreviewEntree .datel").html(data.datel);
            $("#iconPreviewEntree .datep").html(data.datep);
            $("#iconPreviewEntree .prixv").html(data.prixv);
            $("#iconPreviewEntree .quantite").html(data.quantite);
            $("#iconPreviewEntree .quantiter").html(data.quantiter);
            $("#iconPreviewEntree .reduction").html(data.reduction);
            $("#iconPreviewEntree .prixa").html(data.prixa);
            //$("#code").barcode(data.codebarre);
            code1 = data.codebarre;
            $("#demo").barcode(
                code1, // Value barcode (dependent on the type of barcode)
                "code128" // type (string)

            );


        }


    })
    ////alert(code);
    //$(".fittext1").fitText();
    //$("#demo").fitText();


    // var icon_preview = $("<i></i>").addClass(iClass);
    $("#iconPreviewEntree").modal("show");

}

function imprimer(divName) {
    //$("#iconPreviewEntree").modal("hide");
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    return true;
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

// Fin
