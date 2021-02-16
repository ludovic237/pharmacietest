var test = 0;
var startDate;
var endDate;
var idemploye = null
;
var idfulldepense;

var id_boncaisse_encaissement;

$(document).ready(function () {

    $("#encaisseCode").keyup(function (event) {
        $('#verification_code').html("");
        document.getElementById("btn_encaissement").disabled = true;
        if (this.value.length == 12) {
            //alert($(this).val());
            var cat = '<span class="label label-success">Code valide</span>';
            $('#verification_code').prepend(cat);
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/encaisser_bon_caisse.php',
                data: {
                    val: $(this).val(),
                    type: "check"
                },
                success: function (server_responce) {

                    if (server_responce == "OK") {
                        var cat = '<span class="label label-success">Code valide</span>';
                        $('#verification_code').prepend(cat);
                        document.getElementById("btn_encaissement").disabled = false;
                    } else {
                        var cat = '<span class="label label-danger">Code invalide</span>';
                        $('#verification_code').prepend(cat);
                        document.getElementById("btn_encaissement").disabled = true;
                    }
                }
            });
        }
        /*if (event.keyCode == 12) {
            //alert($(this).val());
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/encaisser_bon_caisse.php',
                data: {
                    val: $(this).val(),
                    type:"check"
                },
                success: function (server_responce) {
                    if (server_responce == "OK") {
                        alert("Success");
                        document.getElementById("btn_encaissement").disabled = false;
                    } else {
                        alert("Bon inexistant");
                        document.getElementById("btn_encaissement").disabled = true;
                    }
                }
            });
        }*/
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
            $(".fargent" + position).select();
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

        }


    })


    $(".argent").keyup(function (event) {
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
        }
    })


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


    $('#iconPreviewCaisse').on('hidden.bs.modal', function () {
        $("#iconPreviewCaisse").modal("show");
    })

    $('#iconPreviewCaisseFermer').on('hidden.bs.modal', function () {
        $("#iconPreviewCaisseFermer").modal("show");
    })

    $('#iconPreviewRapport').on('hidden.bs.modal', function () {
        $("#iconPreviewRapport").modal("show");
    })

});

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

function showEncaissement() {
    // Desactivé bouton generer
    document.getElementById("btn_encaissement").disabled = true;
    $("#iconPreviewBonCaisse").modal("hide");
    $("#iconPreviewEncaisserCaisse").modal("show");
}

function encaisser_bon_caisse() {
    var code_encaissement = $("#encaisseCode").val();
    var dateEncaisser = moment().format("YYYY-MM-DD HH:mm:ss");
    console.log('Encaissemnt :' + dateEncaisser + '-' + $("#tab_GBonCaisse").attr("data") + '-' + code_encaissement);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/encaisser_bon_caisse.php',
        data: {
            code: code_encaissement,
            type: "encaisser",
            caisse_id: $("#tab_GBonCaisse").attr("data"),
            dateEncaisser: dateEncaisser
        },
        success: function (server_responce) {
            if (server_responce == "OK") {
                document.getElementById("btn_encaissement").disabled = true;
                noty({text: 'Encaissement effectué', layout: 'topRight', type: 'success'});
                setTimeout(() => {
                    $("#iconPreviewBonCaisse").modal("show");
                    $("#iconPreviewEncaisserCaisse").modal("hide");
                }, 5000);


            } else {
                noty({text: "echec de l'encaissement", layout: 'topRight', type: 'danger'});
                document.getElementById("btn_encaissement").disabled = true;
            }


        }


    })
}


function gerer_bon_caisse() {
    $('#tab_GBonCaisse  tr').each(function (i) {
        var dateEncaisser, id1 = $(this).attr("id");
        if (parseInt(id1) == 0 && $("#" + id1 + " .montant").val() != "") {
            dateEncaisser = '';
            $('#nomclientimp').html($("#" + id1 + " .nom").val());
            $('#montantimp').html($("#" + id1 + " .montant").val());
            $('#dateimp').html(moment().format("YYYY-MM-DD HH:mm:ss"));
            qrcode.makeCode(moment().format("YYMMDDHHmmss"));

            $('#codebarrenulimp').html(moment().format("YYMMDDHHmmss"));

            $("#previewImprimerBonCaisse").modal("show");
        } else {
            dateEncaisser = moment().format("YYYY-MM-DD HH:mm:ss");
        }
        if (parseInt(id1) == 0 && $("#" + id1 + " .montant").val() == "") {
            alert("Veuillez entrer le montant");
        } else {
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
            $('#tab_vente_caisse').empty();
            $('#tab_BfactureImprimer2  tr').each(function (i) {
                if ($(this).attr("class") == 'ligne_facture') {
                    //alert("passe");
                    $(this).remove();
                }
            });
            $('#tab_BfactureImprimer2').prepend(server_responce);
            $('#iconPreviewFacture2').modal("show");


        }


    })


}

function open_depense(caisse_id) {
    var x = document.getElementById("savedepenseid");
    x.style.display = "none";
    //$("#savedepenseid").style.display = "none";
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_depense.php',
        data: {
            id: caisse_id,
            type: "open"
        },
        success: function (server_responce) {
            $('#tab_Gdepense').empty();
            $('#tab_Gdepense').html(server_responce);
            var total, prixTotal = 0, qteTotal = 0;
            var qte = 0;
            $('#tab_Gdepense  tr').each(function (i) {
                var id1 = $(this).attr("id");
                prixTotal = prixTotal + parseInt($("#" + id1 + " .total").val());


            });
            console.log(prixTotal);
            $("#total_depense").html('');
            $("#total_depense").html(prixTotal);

        }


    })
    $("#iconPreviewDepense").modal("show");
}

function modify_depense(caisse_id) {
    var x = document.getElementById("savedepenseid");
    x.style.display = "initial";
    var x = document.getElementById("adddepenseid");
    x.style.display = "none";
    var x = document.getElementById("modifydepenseid");
    x.style.display = "none";
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_depense.php',
        data: {
            id: caisse_id,
            type: "modify"
        },
        success: function (server_responce) {

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

    var x = document.getElementById("savedepenseid");
    var y = document.getElementById("adddepenseid");
    var z = document.getElementById("modifydepenseid");
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
    x.style.display = "initial";
    y.style.display = "none";
    z.style.display = "none";

}

function close_depense() {
    $("#iconPreviewDepense").modal("hide");
    var x = document.getElementById("savedepenseid");
    var y = document.getElementById("adddepenseid");
    var z = document.getElementById("modifydepenseid");
    x.style.display = "none";
    y.style.display = "initial";
    z.style.display = "initial";
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

function valider_facture(typePaiement, onglet, caisse_id, imprimer) {
    var telephone, montantTtc = parseInt($('#facture_caisse').html()), count = 0, rec = 0;
    var reduction = parseInt($('#facture_caisse').attr('data'));
    $('#ticketCaisse .montantpercu').html($('#' + onglet + ' .montant').val() + ' (' + typePaiement + ')');
    $('#ticketCaisse .montantrendu').html($('#' + onglet + ' .reste').val());
    //alert(reduction);
    var montantPercu = null;
    if ($('#' + onglet + ' .montant').val() != '') {
        ////alert(caisse_id);
        montantPercu = parseInt($('#' + onglet + ' .montant').val());
    }
    if (typePaiement == 'Electronique') {
        ////alert(caisse_id);
        telephone = $('#' + onglet + ' .telephone').val();
    } else {
        telephone = '';
    }
    var reste = parseInt($('#' + onglet + ' .reste').val());
    var vente_id = parseInt($('#fen_facture').attr("data"));
    ////alert(montantPercu);
    ////alert(reste);
    if (montantPercu == null || montantPercu == 0 || reste < 0) {
        // vérifier qu'on a entré le montant perçu
        $('#message-box-danger p').html('Veuillez Entrer un bon montant perçu !!!');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 3000);
    } else {
        ////alert('valide');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/valider_facture.php',
            data: {
                vente_id: vente_id,
                montant: montantTtc,
                montantPercu: montantPercu,
                reste: reste,
                telephone: telephone,
                reduction: reduction,
                typePaiement: typePaiement,
                caisse_id: parseInt(caisse_id)
            },
            success: function (server_responce) {
                //alert(server_responce);
                $('#tab_vente_caisse  tr').each(function (i) {
                    count++;
                });
                $('#tab_vente_caisse  tr').each(function (i) {
                    var id1 = $(this).attr("id");
                    var qte;
                    ////alert(id1);


                    $("#" + id1 + " td").each(function (j) {
                        ////alert($(this).html());
                        if (j == 2) {
                            qte = parseInt($(this).html());
                        }


                    });
                    ////alert('quantité : '+qte);
                    $.ajax({
                        type: "POST",
                        url: "/pharmacietest/koudjine/inc/facture_modifier_quantite_vendu.php",
                        data: {
                            id: id1,
                            qte: qte
                        },
                        success: function (server_responce) {
                            //alert(server_responce);
                            rec++;
                            rafraichir_vente(caisse_id);
                            $('#' + onglet + ' .montant').val('');
                            $('#' + onglet + ' .reste').val('');
                            $('#facture_caisse').html('0');

                            if (imprimer && rec == count) {
                                imprimer_bloc('ticketCaisse', 'ticketCaisse');
                                $('#tab_vente_caisse').empty();
                            } else {
                                $('#tab_vente_caisse').empty();
                            }
                        }
                    })

                });


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
    var x = document.getElementById("savedepenseid");
    var y = document.getElementById("adddepenseid");
    var z = document.getElementById("modifydepenseid");
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
                dateDepense: moment().format("YYYY-MM-DD HH:mm:ss"),
                new_id: parseInt(send_id),
                caisse_id: caisse_id,
                designation: $("#" + id1 + " .designation").val(),
                qte: parseInt($("#" + id1 + " .qte").val()),
                prix: parseInt($("#" + id1 + " .prix").val())
            },
            success: function (server_responce) {

                //alert(server_responce);
                x.style.display = "none";
                y.style.display = "initial";
                z.style.display = "initial";
                $("#iconPreviewDepense").modal("hide");
                //$("#iconPreview .icon-preview").html(icon_preview);


            }


        })


    });
    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
}

function rafraichir_vente(id) {

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/rafraichir_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
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

function valider_fermeture(caisse_id) {
    var total = parseInt($('.ftotalaisse').html());
    var detail_piece_billet = ($("#fargent_1").val()) + "-" + ($("#fargent_2").val()) + "-" + ($("#fargent_3").val()) + "-" + ($("#fargent_4").val()) + "-" + ($("#fargent_5").val()) + "-" + ($("#fargent_6").val()) + "-" + ($("#fargent_7").val()) + "-" + ($("#fargent_8").val()) + "-" + ($("#fargent_9").val()) + "-" + ($("#fargent_10").val());

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

function open_rapport(id) {
    var caisse_id = parseInt($("#tab_GBonCaisse").attr("data"));
    if (id != null) {
        caisse_id = id;
    }

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

function liste_caisse(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/liste_caisse.php',
        data: {
            id: id
        },
        success: function (data) {
            //alert(data);
            $("#iconPreviewListeCaisse").modal('show');
            $('#tab_Bload_produit_caisse').empty();
            $('#tab_Bload_produit_caisse').prepend(data);


        }
    })
}

function selectemploye(val, id) {
    idemploye = id;
    $("#suggesstion-employe-box-block").hide();
    $("#search-employe-box").val(val);
    $("#suggesstion-employe-box").hide();
}

function close_caisse_row_valide(user_id) {

    var total = parseInt($('.totalaisse').html());
    var detail_piece_billet = ($("#argent_1").val()) + "-" + ($("#argent_2").val()) + "-" + ($("#argent_3").val()) + "-" + ($("#argent_4").val()) + "-" + ($("#argent_5").val()) + "-" + ($("#argent_6").val()) + "-" + ($("#argent_7").val()) + "-" + ($("#argent_8").val()) + "-" + ($("#argent_9").val()) + "-" + ($("#argent_10").val());
    var session = $('.session option:selected').text();

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


function close_caisse_row() {
    $("#iconPreviewCaisseFermer").modal("show");

}


function showRapportTest(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/rapport_caisse_all.php',
        data: {
            id: 73,
        },
        dataType: 'json',
        success: function (data) {

            //recap vente par fournisseur
            $("#rapport_vente_fournisseur_grossiste").html(data.vente_fg);
            $("#rapport_vente_fournisseur_detaillant").html(data.vente_fd);
            $("#rapport_vente_fournisseur_total").html(data.vente_ft);

            //recap vente par type vente
            $("#rapport_vente_comptant").html(data.vente_comptant);
            $("#rapport_vente_credit").html(data.vente_credit);
            $("#rapport_vente_assurance").html(data.vente_assurance);
            $("#rapport_vente_total").html(data.vente_total);

            //Encaissement des ventes
            $("#rapport_ev_espece").html(data.ev_espece);
            $("#rapport_ev_electronique").html(data.ev_electronique);
            $("#rapport_ev_boncaisse").html(data.ev_boncaisse);
            $("#rapport_ev_total").html(data.ev_total);

            //Encaissement facture à credit
            $('#rapport_efc_espece').dataTable({
                destroy: true,
                searching: false,
                dFilter: false,
                bInfo: false,
                bPaginate: false,
                data: data.efc_espece,
                columns: [
                    {data: "numeroFavture"},
                    {data: "nom"},
                    {data: "total"},
                ]
            });
            $("#rapport_efc_total").html(data.efc_total);


            //Bon de caisse généré
            $('#rapport_bc_genere').dataTable({
                destroy: true,
                searching: false,
                dFilter: false,
                bInfo: false,
                bPaginate: false,
                data: data.bc_genere,
                columns: [
                    {data: "id"},
                    {data: "nom_client"},
                    {data: "montant"},
                ]
            });
            $("#rapport_bc_total").html(data.bc_total);

            //Bon de caisse encaissé
            $('#rapport_bc_encaisse').dataTable({
                destroy: true,
                searching: false,
                dFilter: false,
                bInfo: false,
                bPaginate: false,
                data: data.bc_encaisse,
                columns: [
                    {data: "id"},
                    {data: "nom_client"},
                    {data: "montant"},
                ]
            });
            $("#rapport_bc_total_genere").html(data.bc_total_genere);

            //Dépense
            $('#rapport_depense').dataTable({
                destroy: true,
                searching: false,
                dFilter: false,
                bInfo: false,
                bPaginate: false,
                data: data.depense,
                columns: [
                    {data: "id"},
                    {data: "designation"},
                    {data: "prixUnitaire"},
                    {data: "total"},
                ]
            });
            $("#rapport_total_depense").html(data.total_depense);


            // Etat caisse
            $("#rapport_ec_solde_reel").html(data.ec_solde_reel);
            $("#rapport_ec_solde_system").html(data.ec_solde_system);
            $("#rapport_ec_difference").html(data.ec_difference);
        }
    });
    $("#iconPreviewRapportTest").modal("show");

}


function imprimer_blocTest(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet);
    //alert("Hello");
    // Ouverture du popup,
    var fen = window.open("", "", "height=auto, width=auto,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=0, top=0");
    fen.document.write(
        '<html> <head><style>' +
        'body{\n' +
        '      font-size: 8px!important;\n' +
        ''+
        '    }\n' +
        'body{font-size: 6px!important;}'+
          '.divine{font-size: 6px!important;display: flex;flex-direction: row;justify-content: space-between;}'+
          'p{font-size: 6px!important;}'+
          'div{font-size: 6px!important;}'+
          'td{font-size: 6px!important;border-color: #000000;border-width: 1px;border: 1px solid #000000;}'+
          'th{font-size: 6px!important;border-color: #000000;border-width: 1px;border: 1px solid #000000;}'+
          'table{font-size: 6px!important;}'+
          '.panel-body.panel-body-table .table {margin-bottom: 0px;border: 0px;}'+
          '.panel-body.panel-body-table td, .panel-body.panel-body-table th {padding: 8px 6px;}'+
          '.table-bordered {border: 1px solid #000000;}'+
          '.table > tfoot > tr > td {border-color: #000000;border-width: 1px;}'+
          '.table-bordered>tbody>tr>td{border: 1px solid #000000;}'+
          '.table>tfoot>tr>td {padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #000000;}'+
          '.table {border-spacing: 2px;border-collapse: separate;width: 100%;border-collapse: collapse;border-spacing: 0;max-width: 100%;margin-bottom: 20px;}'+
          'tbody {display: table-row-group;vertical-align: middle;border-color: inherit;}'+
          'thead {display: table-header-group;vertical-align: middle;border-color: inherit;}'+
        '</style></head>');
    fen.document.write(
        '<body style="font-size: 8px!important;">'
    );
    fen.document.write(zone.outerHTML);
    fen.document.write(
        '</body></html>');
    fen.document.close();
    fen.focus();
    fen.print();
    fen.close();
    return true;
}
