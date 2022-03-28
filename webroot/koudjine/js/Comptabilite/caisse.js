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
            //console.log($("#" + id).attr("data3") + '-' + $("#facture_caisse").attr("data1"))
            position = parseInt(position);
            limite = parseInt(limite);
            if (id === "Ticketcaisse1" || id === "Mixtecaisse4") {
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/info_bon_caisse.php",
                    data: {
                        code: $("#" + id).val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.data);
                        var montantTtc = parseInt($('#facture_caisse').html());
                        if (data.etat != 'Encaisser') {
                            if (id === "Ticketcaisse1") {
                                $('#Ticketcaisse2').val(data.data);
                                $('#tab3 .reste').val(parseInt(data.data) - montantTtc);
                            } else {
                                $('#tab4 .montant_ticket').val(data.data);
                                calcul_montant_mixte();
                            }


                        } else {
                            $('#message-box-danger p').html('Ce ticket a deja ete encaisser !!!');
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                            $('#tab3 .montant').val('');
                            $('#tab3 .reste').val('');
                            $('#tab4 .montant_ticket').val('');
                        }


                    }
                })
            }
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
    $(".mixte").keyup(function (event) {
        calcul_montant_mixte();
    })


    $("#scanner_bon").keyup(function (event) {
        var recherche
        if (event.keyCode == 13) {
            recherche = $(this).val();
            //$("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                //alert('yes');
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/gerer_bon_caisse.php",
                    data: {
                        id: recherche
                    },
                    dataType: 'json',
                    success: function (data) {
                        //alert(data);
                        if (data.erreur == 'non') {
                            if (data.dateE != null) {
                                $('#tab_GBonCaisse').empty();
                                var cat = '<tr id="' + data.id + '" >'
                                    + ' <td> <input class=\'nom\' type="text" value="' + data.nom + '"></td>'
                                    + ' <td><input class=\'montant\' type="text" value="' + data.montant + '"></td>'
                                    + '<td>'
                                    + '<button disabled class="btn btn-primary btn-rounded btn-sm" onclick="gerer_bon_caisse()" >déjà Encaisser</button>'
                                    + '</td>'
                                    + '</tr>';
                                $('#tab_GBonCaisse').prepend(cat);
                                $("#scanner_bon").val('');
                            } else {
                                $('#tab_GBonCaisse').empty();
                                var cat = '<tr id="' + data.id + '" >'
                                    + ' <td> <input class=\'nom\' type="text" value="' + data.nom + '"></td>'
                                    + ' <td><input class=\'montant\' type="text" value="' + data.montant + '"></td>'
                                    + '<td>'
                                    + '<button class="btn btn-primary btn-rounded btn-sm" onclick="gerer_bon_caisse()" >Encaisser</button>'
                                    + '</td>'
                                    + '</tr>';
                                $('#ta' +
                                    '' +
                                    'b_GBonCaisse').prepend(cat);
                                $("#scanner_bon").val('');
                            }
                            //alert('passe');


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

function open_bon_caisse() {
    $('#tab_GBonCaisse').empty();
    $("#scanner_bon").select();
    $("#iconPreviewBonCaisse").modal("show");
}

function calcul_montant_mixte() {
    var montant_espece, montant_electronique, montant_ticket;
    if ($('#tab4 .montant_espece').val() == '') {
        montant_espece = 0;
    } else {
        montant_espece = parseInt($('#tab4 .montant_espece').val());
    }
    if ($('#tab4 .montant_electronique').val() == '') {
        montant_electronique = 0;
    } else {
        montant_electronique = parseInt($('#tab4 .montant_electronique').val());
    }
    if ($('#tab4 .montant_ticket').val() == '') {
        montant_ticket = 0;
    } else {
        montant_ticket = parseInt($('#tab4 .montant_ticket').val());
    }
    $('#tab4 .montant').val(montant_espece + montant_electronique + montant_ticket);
    var montantTtc = parseInt($('#facture_caisse').html());
    $('#tab4 .reste').val(montant_espece + montant_electronique + montant_ticket - montantTtc);
}

function ajouter_bon_caisse() {
    $('#0').remove();
    var cat = '<tr id="0" >'
        + ' <td> <input class=\'nom nom_client_bon\' type="text"></td>'
        + ' <td><input class=\'montant\' type="text"></td>'
        + '<td>'
        + '<button class="btn btn-primary btn-rounded btn-sm" onclick="gerer_bon_caisse()" >Générer</button>'
        + '</td>'
        + '</tr>';
    $('#tab_GBonCaisse').prepend(cat);
    $(".nom_client_bon").select();

}

function showConfirmationBon() {
    $("#mb-bom-caisse").modal("show");
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

function encaisser_liste_bon(bon_id) {
    var dateEncaisser = moment().format("YYYY-MM-DD HH:mm:ss");
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_bon_caisse.php',
        data: {
            new_id: bon_id,
            caisse_id: $("#tab_GBonCaisse").attr("data"),
            nom: '',
            montant: null,
            dateEncaisser: dateEncaisser
        },
        success: function (server_responce) {
            //alert(server_responce);

            $("#bon" + bon_id).hide("slow");

        }


    })
}

function newDate() {
    var datas;
    var startDate = moment().subtract('days', 29);
    var endDate = moment();
    var a_ = startDate.format("YYYY-MM-DD HH:mm:ss");
    var b_ = endDate.format("YYYY-MM-DD HH:mm:ss");
    console.log(a_ + ' - ' + b_);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/dashboard_info_today2.php',
        data: {
            start: a_,
            end: b_
        },
        dataType: 'json',
        success: function (server_responce) {
            console.log(server_responce);
        }


    });
}


function gerer_bon_caisse() {
    $('#tab_GBonCaisse  tr').each(function (i) {
        var dateEncaisser, id1 = $(this).attr("id");
        if (parseInt(id1) == 0 && $("#" + id1 + " .montant").val() != "") {
            dateEncaisser = '';
            $('#nomclientimp').html($("#" + id1 + " .nom").val());
            $('#montantimp').html($("#" + id1 + " .montant").val());
            $('#dateimp').html(moment().format("YYYY-MM-DD HH:mm:ss"));
            //qrcode.makeCode(moment().format("YYMMDDHHmmss"));
            $("#codebarreimp").barcode(
                moment().format("YYMMDDHHmmss"), // Value barcode (dependent on the type of barcode)
                "code128" // type (string)

            );

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
                dataType: 'json',
                success: function (data) {
                    //alert(data)
                    //$('#list_bon_caisse').empty();
                    //Bon de caisse généré
                    $('#list_bon_caisse').dataTable({
                        destroy: true,
                        searching: false,
                        dFilter: false,
                        bInfo: false,
                        bPaginate: false,
                        data: data.listeBon,
                        fnCreatedRow: function (nRow, aData, iDataIndex) {
                            console.log(aData[0])
                            var id1 = aData['id'];
                            $(nRow).attr('id', 'bon' + id1 + '');
                        },
                        columns: [
                            {data: "nom_client"},
                            {data: "montant"},
                            {data: "date_creation"},
                            {data: "caisse"},
                            {
                                data: "id", "bSortable": false, "render": function (data) {
                                    return '   <button class="btn btn-primary btn-rounded btn-sm" onClick="encaisser_liste_bon(' + data + ');">Encaisser</button>  ';
                                }
                            }
                        ]
                    });
                    $('#mb-bom-caisse').hide()
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
    var telephone, ticket_id, montantTtc = parseInt($('#facture_caisse').html()), count = 0, rec = 0;
    var reduction = parseInt($('#facture_caisse').attr('data'));
    var dateEncaisser = moment().format("YYYY-MM-DD HH:mm:ss");
    var copytypePaiement = typePaiement;
    $('#ticketCaisse .montantpercu').html($('#' + onglet + ' .montant').val() + ' (' + copytypePaiement + ')');
    $('#ticketCaisse .montantrendu').html($('#' + onglet + ' .reste').val());
    //alert(reduction);
    var montantPercu = null;
    var reste = parseInt($('#' + onglet + ' .reste').val());
    var vente_id = parseInt($('#fen_facture').attr("data"));
    console.log($('#' + onglet + ' .numero').val());
    // Traitement Mixte
    var typePaiementFinal = 'Mixtes';
    if (typePaiement == 'Mixte') {

        if (parseInt($('#' + onglet + ' .montant_espece').val()) > 0 && parseInt($('#' + onglet + ' .montant_electronique').val()) > 0
            && parseInt($('#' + onglet + ' .montant_ticket').val()) > 0) {
            typePaiementFinal = "Mixte Espèce Electronique Ticketcaisse";
        } else if (parseInt($('#' + onglet + ' .montant_espece').val()) > 0 && parseInt($('#' + onglet + ' .montant_electronique').val()) > 0) {
            typePaiementFinal = "Mixte Espèce Electronique";
        } else if (parseInt($('#' + onglet + ' .montant_electronique').val()) > 0 && parseInt($('#' + onglet + ' .montant_ticket').val()) > 0) {
            typePaiementFinal = "Mixte Electronique Ticketcaisse";
        } else if (parseInt($('#' + onglet + ' .montant_espece').val()) > 0 && parseInt($('#' + onglet + ' .montant_ticket').val()) > 0) {
            typePaiementFinal = "Mixte Espèce Ticketcaisse";
        } else if (parseInt($('#' + onglet + ' .montant_espece').val()) > 0) {
            typePaiementFinal = "Mixte Espèce";
        } else if (parseInt($('#' + onglet + ' .montant_electronique').val()) > 0) {
            typePaiementFinal = "Mixte Electronique";
        } else if (parseInt($('#' + onglet + ' .montant_ticket').val()) > 0) {
            typePaiementFinal = "Mixte Ticketcaisse";
        }
        typePaiement = typePaiementFinal;
    }
    if ($('#' + onglet + ' .montant').val() != '') {
        ////alert(caisse_id);
        montantPercu = parseInt($('#' + onglet + ' .montant').val());
    }
    if (typePaiement == 'Electronique' || typePaiement == 'Mixte Electronique') {
        ////alert(caisse_id);
        telephone = $('#' + onglet + ' .telephone').val();
    } else {
        telephone = '';
    }
    if (typePaiement == 'Ticketcaisse' || typePaiement == 'Mixte Ticketcaisse' || typePaiement == "Mixte Espèce Electronique Ticketcaisse" || typePaiement == "Mixte Electronique Ticketcaisse" || typePaiement == "Mixte Espèce Ticketcaisse") {
        ticket_id = $('#' + onglet + ' .numero').val();
    } else {
        ticket_id = 'pour';
    }
    var montant_espece = null;
    if ($('#' + onglet + ' .montant_espece').val() != '') {
        montant_espece = parseInt($('#' + onglet + ' .montant_espece').val());
    }
    var montant_electronique = null;
    if ($('#' + onglet + ' .montant_electronique').val() != '') {
        montant_electronique = parseInt($('#' + onglet + ' .montant_electronique').val());
    }
    var montant_ticket = null;
    if ($('#' + onglet + ' .montant_ticket').val() != '') {
        montant_ticket = parseInt($('#' + onglet + ' .montant_ticket').val());
    }
    if (typePaiement == 'Mixte Espèce') {
        montantTtc = parseInt($('#' + onglet + ' .montant_espece').val());
    }
    if (typePaiement == 'Mixte Electronique') {
        montantTtc = parseInt($('#' + onglet + ' .montant_electronique').val());
    }
    if (typePaiement == 'Mixte Ticketcaisse') {
        montantTtc = parseInt($('#' + onglet + ' .montant_ticket').val());
    }
    if (typePaiement == "Mixte Espèce Electronique Ticketcaisse") {
        montantTtc = parseInt($('#' + onglet + ' .montant_espece').val()) + parseInt($('#' + onglet + ' .montant_electronique').val()) + parseInt($('#' + onglet + ' .montant_ticket').val());
    }
    if (typePaiement == "Mixte Espèce Electronique") {
        montantTtc = parseInt($('#' + onglet + ' .montant_espece').val()) + parseInt($('#' + onglet + ' .montant_electronique').val());
    }
    if (typePaiement == "Mixte Electronique Ticketcaisse") {
        montantTtc = parseInt($('#' + onglet + ' .montant_electronique').val()) + parseInt($('#' + onglet + ' .montant_ticket').val());
    }
    if (typePaiement == "Mixte Espèce Ticketcaisse") {
        montantTtc = parseInt($('#' + onglet + ' .montant_espece').val()) + parseInt($('#' + onglet + ' .montant_ticket').val());
    }

    console.log(copytypePaiement);
    ////alert(reste);
    if (copytypePaiement == 'Mixte') {
        if (montant_espece != null && montant_electronique != null || montant_espece != null && montant_ticket != null || montant_ticket != null && montant_electronique != null) {
            if (montantPercu == null || montantPercu == 0 || reste < 0) {
                // vérifier qu'on a entré le montant perçu
                $('#message-box-danger p').html('Veuillez Entrer un bon montant perçu !!!');
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 3000);
            } else {
                $('#montantespece').html(montant_espece);
                $('#montantelectronique').html(montant_electronique);
                $('#montantticket').html(montant_ticket);
                if (typePaiement == "Mixte Espèce Electronique Ticketcaisse") {
                    $('#montantespece').html(montant_espece);
                    $('#montantelectronique').html(montant_electronique);
                    $('#montantticket').html(montant_ticket);
                    $('#rowmontantelectronique').show();
                    $('#rowmontantespece').show();
                    $('#rowmontantticket').show();
                }
                if (typePaiement == "Mixte Espèce Electronique") {
                    $('#montantespece').html(montant_espece);
                    $('#montantelectronique').html(montant_electronique);
                    $('#rowmontantelectronique').show();
                    $('#rowmontantespece').show();
                    $('#rowmontantticket').hide();
                }
                if (typePaiement == "Mixte Electronique Ticketcaisse") {
                    $('#montantelectronique').html(montant_electronique);
                    $('#montantticket').html(montant_ticket);
                    $('#rowmontantelectronique').show();
                    $('#rowmontantespece').hide();
                    $('#rowmontantticket').show();
                }
                if (typePaiement == "Mixte Espèce Ticketcaisse") {
                    $('#montantespece').html(montant_espece);
                    $('#montantticket').html(montant_ticket);
                    $('#rowmontantelectronique').hide();
                    $('#rowmontantespece').show();
                    $('#rowmontantticket').show();
                }
                console.log("mixte 1");
                console.log(copytypePaiement);
                $.ajax({
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/valider_facture.php',
                    data: {
                        montant_espece: montant_espece,
                        montant_electronique: montant_electronique,
                        montant_ticket: montant_ticket,
                        vente_id: vente_id,
                        montant: montantTtc,
                        montantPercu: montantPercu,
                        reste: reste,
                        telephone: telephone,
                        ticket_id: ticket_id,
                        reduction: reduction,
                        dateEncaisser: dateEncaisser,
                        typePaiement: typePaiement,
                        caisse_id: parseInt(caisse_id)
                    },
                    success: function (server_responce) {
                        //alert(server_responce);
                        if (typePaiement == 'Mixte Espèce' || typePaiement == 'Mixte Electronique' || typePaiement == 'Mixte Ticketcaisse') {
                            console.log('payement mixte');
                        } else {
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
                                        console.log(rec);
                                        console.log(imprimer);
                                        if (imprimer && rec == count) {
                                            imprimer_bloc('ticketCaisse', 'ticketCaisse', typePaiement);
                                            $('#tab_vente_caisse').empty();
                                        } else {
                                            $('#tab_vente_caisse').empty();
                                        }
                                    }
                                })

                            });
                        }


                    }


                })
            }
        } else {
            $('#message-box-danger p').html('veillez a utiliser au moins 02 types de paiement sinon changer de mode de paiement !!!');
            $("#message-box-danger").modal("show");
            setTimeout(function () {
                $("#message-box-danger").modal("hide");
            }, 3000);
        }
    } else {
        if (montantPercu == null || montantPercu == 0 || reste < 0) {
            // vérifier qu'on a entré le montant perçu
            $('#message-box-danger p').html('Veuillez Entrer un bon montant perçu !!!');
            $("#message-box-danger").modal("show");
            setTimeout(function () {
                $("#message-box-danger").modal("hide");
            }, 3000);
        } else {
            console.log("autre");
            console.log(copytypePaiement);
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/valider_facture.php',
                data: {
                    montant_espece: montant_espece,
                    montant_electronique: montant_electronique,
                    montant_ticket: montant_ticket,
                    vente_id: vente_id,
                    montant: montantTtc,
                    montantPercu: montantPercu,
                    reste: reste,
                    telephone: telephone,
                    ticket_id: ticket_id,
                    reduction: reduction,
                    dateEncaisser: dateEncaisser,
                    typePaiement: typePaiement,
                    caisse_id: parseInt(caisse_id)
                },
                success: function (server_responce) {
                    //alert(server_responce);
                    if (typePaiement == 'Mixte Espèce' || typePaiement == 'Mixte Electronique' || typePaiement == 'Mixte Ticketcaisse') {
                        console.log('payement mixte');
                    } else {
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
                                    rec++;
                                    rafraichir_vente(caisse_id);
                                    $('#' + onglet + ' .montant').val('');
                                    $('#' + onglet + ' .reste').val('');
                                    $('#facture_caisse').html('0');
                                    console.log(rec);
                                    console.log(imprimer);
                                    if (imprimer && rec == count) {
                                        imprimer_bloc('ticketCaisse', 'ticketCaisse', typePaiement);
                                        $('#tab_vente_caisse').empty();
                                    } else {
                                        $('#tab_vente_caisse').empty();
                                    }
                                }
                            })

                        });
                    }


                }


            })
        }
    }


}

function imprimer_bloc(titre, objet, typePaiement) {
    if (typePaiement == "Mixte Espèce Electronique Ticketcaisse") {
        $('#rowmontantelectronique').show();
        $('#rowmontantespece').show();
        $('#rowmontantticket').show();
    }
    if (typePaiement == "Mixte Espèce Electronique") {
        $('#rowmontantelectronique').show();
        $('#rowmontantespece').show();
        $('#rowmontantticket').hide();
    }
    if (typePaiement == "Mixte Electronique Ticketcaisse") {
        $('#rowmontantelectronique').show();
        $('#rowmontantespece').hide();
        $('#rowmontantticket').show();
    }
    if (typePaiement == "Mixte Espèce Ticketcaisse") {
        $('#rowmontantelectronique').hide();
        $('#rowmontantespece').show();
        $('#rowmontantticket').show();
    }
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
    $(".caisse").val('');
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
    //alert(caisse_id)
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

            $('#tab_Bload_produit_caisse_liste').empty();
            $('#tab_Bload_produit_caisse_liste').prepend(data);
            $("#iconPreviewListeCaisse").modal('show');


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
    console.log("YO");
    var caisse_id = parseInt($("#tab_GBonCaisse").attr("data"));
    if (id != null) {
        caisse_id = id;
    }
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/rapport_caisse_all.php',
        data: {
            id: caisse_id,
        },
        dataType: 'json',
        success: function (data) {
            //alert(data)
            //recap vente par fournisseur
            $("#rapport_vente_fournisseur_grossiste").html(data.vente_fg);
            $("#rapport_vente_fournisseur_detaillant").html(data.vente_fd);
            $("#rapport_vente_produit_detaille").html(data.vente_fpd);
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
            //alert(data.efc_espece)
            if (data.efc_espece != 0)
                $('#rapport_efc_espece').dataTable({
                    destroy: true,
                    searching: false,
                    dFilter: false,
                    bInfo: false,
                    bPaginate: false,
                    data: data.efc_espece,
                    columns: [
                        {data: "reference"},
                        {data: "client"},
                        {data: "prixPercu"},
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
                    {data: "quantite"},
                    {data: "prixUnitaire"},
                    {data: "total"},
                ]
            });
            $("#rapport_total_depense").html(data.total_depense);

            //retour produit
            $('#rapport_retour').dataTable({
                destroy: true,
                searching: false,
                dFilter: false,
                bInfo: false,
                bPaginate: false,
                data: data.tf_retourproduit,
                columns: [
                    {data: "quantite_total_produitRetour"},
                    {data: "prix"},
                ]
            });
            $("#rapport_retour_total").html(data.tf_retourtotal);

            // Etat caisse
            $("#rapport_ec_solde_reel").html(data.ec_solde_reel);
            $("#rapport_ec_solde_system").html(data.ec_solde_system);
            $("#rapport_ec_difference").html(data.ec_difference);
        }
    });

}


function imprimer_blocTest(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet);
    //alert("Hello");
    // Ouverture du popup,
    var fen = window.open("", "", "height=auto, width=auto,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=0, top=0");
    fen.document.write(
        '<html> <head>' +
        '' +
        '<style>' +
        'body{\n' +
        '      font-size: 8px!important;\n' +
        '' +
        '    }\n' +
        '.row {\n' +
        '    margin-left: 0px;\n' +
        '    margin-right: 0px;\n' +
        '}' +
        '.col-md-6 {\n' +
        '    width: 50%;\n' +
        'min-height: 1px;\n' +
        '    padding-left: 10px;\n' +
        '    padding-right: 10px;' +
        'float: left;' +
        '}' +

        '.panel.panel-default {\n' +
        '    border-top-color: #F5F5F5;\n' +
        '    border-top-width: 1px;\n' +
        '}' +
        '.panel .panel-heading, .panel .panel-footer, .panel .panel-body {\n' +
        '    float: left;\n' +
        '    width: 100%;\n' +
        '}' +
        '.panel {\n' +
        '    float: left;\n' +
        '    width: 100%;\n' +
        '    -moz-border-radius: 0px;\n' +
        '    -webkit-border-radius: 5px;\n' +
        '    border-radius: 0px;\n' +
        '    border: 0px;\n' +
        '    border-top: 2px solid #E5E5E5;\n' +
        '    margin-bottom: 20px;\n' +
        '    position: relative;\n' +
        '    -moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.2);\n' +
        '    -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.2);\n' +
        '    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.2);\n' +
        '}' +
        'body{font-size: 6px!important;}' +
        '.divine{font-size: 6px!important;display: flex;flex-direction: row;justify-content: space-between;}' +
        'p{font-size: 6px!important;}' +
        'div{font-size: 6px!important;}' +
        'td{font-size: 6px!important;}' +
        'th{font-size: 6px!important;}' +
        'table{font-size: 6px!important;}' +
        '.panel-body.panel-body-table .table {margin-bottom: 0px;border: 0px;}' +
        '.panel-body.panel-body-table td, .panel-body.panel-body-table th {padding: 8px 6px;}' +
        '.table > thead > tr > th,\n' +
        '.table > tbody > tr > th,\n' +
        '.table > tfoot > tr > th,\n' +
        '.table > thead > tr > td,\n' +
        '.table > tbody > tr > td,\n' +
        '.table > tfoot > tr > td {\n' +
        '  border-color: #E5E5E5;\n' +
        '  border-width: 1px;\n' +
        '}\n' +
        '.table-striped > tbody > tr:nth-child(odd) > td,\n' +
        '.table-striped > tbody > tr:nth-child(odd) > th {\n' +
        '  background: #F8FAFC;\n' +
        '}\n' +
        '.table > thead > tr > th {\n' +
        '  background: #f1f5f9;\n' +
        '  color: #56688A;\n' +
        '  font-size: 12px;\n' +
        '}\n' +
        '.panel-body.panel-body-table {\n' +
        '  padding: 0px;\n' +
        '}\n' +
        '.panel-body.panel-body-table h1,\n' +
        '.panel-body.panel-body-table h2,\n' +
        '.panel-body.panel-body-table h3,\n' +
        '.panel-body.panel-body-table h4,\n' +
        '.panel-body.panel-body-table h5,\n' +
        '.panel-body.panel-body-table h6 {\n' +
        '  padding-left: 10px;\n' +
        '  margin-bottom: 10px;\n' +
        '}\n' +
        '.panel-body.panel-body-table .table {\n' +
        '  margin-bottom: 0px;\n' +
        '  border: 0px;\n' +
        '}\n' +
        '.panel-body.panel-body-table .table tr > td:first-child,\n' +
        '.panel-body.panel-body-table .table tr > th:first-child {\n' +
        '  border-left: 0px;\n' +
        '}\n' +
        '.panel-body.panel-body-table .table tr > td:last-child,\n' +
        '.panel-body.panel-body-table .table tr > th:last-child {\n' +
        '  border-right: 0px;\n' +
        '}\n' +
        '.panel-body.panel-body-table .table > tbody > tr:last-child > td {\n' +
        '  border-bottom: 0px;\n' +
        '}\n' +
        '.panel-body.panel-body-table td,\n' +
        '.panel-body.panel-body-table th {\n' +
        '  padding: 2px 4px;\n' +
        '}\n' +
        '.table.table-actions td {\n' +
        '  line-height: 28px;\n' +
        '}\n' +
        '.table .progress-small {\n' +
        '  margin: 7px 0px 8px;\n' +
        '}\n' +
        '.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {\n' +
        '    border: 1px solid #ddd;\n' +
        '        border-top-color: rgb(221, 221, 221);\n' +
        '        border-top-width: 1px;\n' +
        '        border-right-color: rgb(221, 221, 221);\n' +
        '        border-right-width: 1px;\n' +
        '        border-bottom-color: rgb(221, 221, 221);\n' +
        '        border-bottom-width: 1px;\n' +
        '        border-left-color: rgb(221, 221, 221);\n' +
        '        border-left-style: solid;\n' +
        '        border-left-width: 1px;\n' +
        '}' +
        '.panel .panel-heading .panel-title-box h3 {\n' +
        'margin-left: 10px;\n' +
        '    font-size: 7px;\n' +
        '    font-weight: 600;\n' +
        '    line-height: 18px;\n' +
        '    color: #434a54;\n' +
        '    padding: 0px;\n' +
        '    margin: 0px;\n' +
        '}' +
        '.table {\n' +
        '    width: 100%;\n' +
        '    max-width: 100%;\n' +
        'border-spacing: 0;\n' +
        'border-collapse: collapse;' +
        '}' +
        '/* EOF TABLES */\n' +
        '/* Datatables */\n' +
        '.dataTable {\n' +
        '  float: left;\n' +
        '  border-bottom: 1px solid #E5E5E5 !important;\n' +
        '  margin-bottom: 5px;\n' +
        '}\n' +
        '.dataTable div.checker,\n' +
        '.dataTable div.radio {\n' +
        '  display: inherit;\n' +
        '}\n' +
        '.dataTables_wrapper {\n' +
        '  float: left;\n' +
        '  width: 100%;\n' +
        '}\n' +
        '.dataTables_length {\n' +
        '  width: 50%;\n' +
        '  float: left;\n' +
        '  padding: 0px 0px 5px;\n' +
        '  border-bottom: 1px solid #E5E5E5;\n' +
        '  font-size: 12px;\n' +
        '}\n' +
        '.dataTables_length label,\n' +
        '.dataTables_filter label {\n' +
        '  padding: 0px;\n' +
        '  line-height: 26px;\n' +
        '  height: auto;\n' +
        '  margin: 0px;\n' +
        '  font-weight: normal;\n' +
        '}\n' +
        '.dataTables_length select {\n' +
        '  width: 70px;\n' +
        '  display: inline;\n' +
        '  margin: 0px 5px;\n' +
        '}\n' +
        '.dataTables_filter {\n' +
        '  width: 50%;\n' +
        '  float: right;\n' +
        '  padding-left: 5px;\n' +
        '  padding: 0px 0px 5px;\n' +
        '  border-bottom: 1px solid #E5E5E5;\n' +
        '  font-size: 12px;\n' +
        '}\n' +
        '.dataTables_filter label {\n' +
        '  float: right;\n' +
        '}\n' +
        '.dataTables_filter label input {\n' +
        '  width: 150px;\n' +
        '  display: inline;\n' +
        '  margin-left: 5px;\n' +
        '}\n' +
        'td.dataTables_empty {\n' +
        '  font-size: 11px;\n' +
        '  text-align: center;\n' +
        '  color: #333;\n' +
        '}\n' +
        '.dataTables_info {\n' +
        '  float: left;\n' +
        '  font-size: 12px;\n' +
        '  padding: 0px;\n' +
        '  line-height: 30px;\n' +
        '}\n' +
        '.dataTables_paginate {\n' +
        '  padding: 0px;\n' +
        '  text-align: right;\n' +
        '  float: right;\n' +
        '}\n' +
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
