var test = 0;
var startDate;
var endDate;
var idemploye = null
    ;
var idfulldepense;
$('#pharmanet_tab_vente').hide();

$(document).ready(function () {

    $("#recherche").keyup(function (event) {
        var prixTotal = 0;
        var reduction = 0;
        
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            //$("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                ////alert('yes');va
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result1.php",
                    data: {
                        motclef: $(this).val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        ////alert(data);
                        if (data.erreur == 'non') {
                            var action = 0;
                            $('#tab_vente  tr').each(function (i) {
                                var id1 = $(this).attr("id");
                                var prix, qte;
                                if (id1 == recherche) {
                                    action = 1;
                                    $("#" + id1 + " td").each(function (j) {
                                        ////alert($(this).html());
                                        if (j == 2) { qte = parseInt($(this).html()) + 1; }
                                        if (j == 6) {
                                            var stock = parseInt($(this).html());
                                            if (stock == 0) {
                                                //  alert("Quantité en stock pas suffisante pour cette opération ");
                                            } else {
                                                $("#" + id1 + " td").each(function (k) {
                                                    ////alert($(this).html());
                                                    if (k == 1) { prix = parseInt($(this).html()); }
                                                    if (k == 2) { $(this).html(qte); }
                                                    if (k == 3) { $(this).html((qte * prix)); }

                                                });
                                                $(this).html((stock - 1));
                                            }
                                        }

                                    });
                                }

                            });
                            if (action == 0) {
                                var cat = '<tr id="' + recherche + '">'
                                    + ' <td><strong>' + data.nom + '</strong></td>'
                                    + '<td>' + data.prix + '</td>'
                                    + '<td>' + 1 + '</td>'
                                    + '<td>' + data.prix + '</td>'
                                    + '<td data ="' + data.reduction + '">' + data.reduction + '</td>'
                                    + '<td>' + data.datel + '</td>'
                                    + '<td>' + data.stock + '</td>'
                                    + '<td>'
                                    + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row_vente(\'' + recherche + '\');"><span class="fa fa-times"></span></button>'
                                    + '</td>'
                                    + '</tr>';
                                $('#tab_vente').prepend(cat);
                            }

                            prixTotal = 0;
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
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
                            $("#tab_Brecherche").empty();
                            $('#prixTotal').html(prixTotal);
                            $('#prixReduit').html(prixReduit);
                            $('#netTotal').html((prixTotal - prixReduit));

                            // on verifie si le taux est coché, si oui on le décoche en chargeant le prix réduit des produits
                            if ($("#check_reductionGenerale").is(":checked")) {
                                $('#check_reductionGenerale').prop("checked", false);
                            }
                        
                        } else if (data.find == 'non') {
                            load_produit(data.id);
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
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


                    }
                })
            } else {
                //$("#resultat ul").empty();
            }
        }
        else {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef1=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result.php",
                    data: data,
                    success: function (server_responce) {
                        $("#tab_Grecherche").show();
                        $("#tab_Brecherche").html(server_responce).show();
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_Grecherche").hide();
            }
        }

    });


    $(".charger_info_employe").on("click", function () {
        var idemploye = $('#dataEmploye option:selected').val();
        //alert(idemploye);
        if (idemploye == 0) {
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/vente_info_today.php',
                data: {
                    start: 0,
                    end: 0,
                    idemploye: 0
                },
                // dataType: 'json',
                success: function (server_responce) {
                    console.log(server_responce);
                    $('#tab_employe_id').html(server_responce);

                }
            });
            $('#reportrange span').html();
            return false;
        }
        else {
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/vente_info_today.php',
                data: {
                    start: 0,
                    end: 0,
                    idemploye: idemploye
                },
                // dataType: 'json',
                success: function (server_responce) {
                    //console.log(server_responce);
                    $('#tab_employe_id').html(server_responce);

                }
            });
            return false;
        }
    });


    $(".select_client").change(function () {

        if ($(".select_client").val() == 2) {
            ////alert('coché');
            $(".clientExistant").show();
            $(".nouveauClient").hide();
        }
        else {
            ////alert('decoché');
            $(".clientExistant").hide();
            $(".nouveauClient").show();
            $('#credit').attr("disabled", "disabled");
            $("#select_vente_client option[value = '0']").prop("selected", true);
            $("#netTotal").html($("#prixTotal").html());
            $("#prixReduit").html(0);
        }
    })

    $(".select_prescripteur").change(function () {

        if ($(".select_prescripteur").val() == 1) {
            ////alert('coché');
            $(".prescripteurExistant").hide();
            $(".nouveauPrescripteur").show();
        }
        else {
            ////alert('decoché');
            $(".prescripteurExistant").show();
            $(".nouveauPrescripteur").hide();
        }
    })

    $("#select_vente_client").change(function () {

        var prixTotal = 0;
        var prixReduit = 0;
        $("#reduction_vente_client").val(parseInt($("#select_vente_client option:selected").attr("name")));
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
            $('#credit').removeAttr("disabled");

        }
        else {
            $('#credit').attr("disabled", "disabled");
        }
        $('#prixTotal').html(prixTotal);
        $('#prixReduit').html(prixReduit);
        $('#netTotal').html((prixTotal - prixReduit));

        if ($("#check_reductionGenerale").is(":checked")) {
            $('#check_reductionGenerale').prop("checked", false);
        }


    })

    $("#check_reductionGenerale").change(function () {
        var prixTotal = 0;
        var prixReduit = 0;

        if ($("#check_reductionGenerale").is(":checked")) {

            if ($("#select_vente_client").val() != 0) {

                $('#message-box-danger p').html("Impossible d'appliquer le taux quand un client est sélectionné !!!");
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 3000);
                if ($("#check_reductionGenerale").is(":checked")) {
                    $('#check_reductionGenerale').prop("checked", false);
                }

            } else {
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

                            if (parseInt($('#taux').val()) >= reduction) {
                                //reduction = reduction;

                            }
                            else {
                                reduction = parseInt($('#taux').val());
                            }

                            prixReduit = prixReduit + ((prix * qte) * reduction / 100);
                        }

                    });

                });
                if (prixReduit > parseInt($("#taux").attr("name"))) {
                    $('#message-box-danger p').html('Taux supérieur à la limite de réduction mensuelle du client');
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);
                    prixReduit = 0;
                    if ($("#check_reductionGenerale").is(":checked")) {
                        $('#check_reductionGenerale').prop("checked", false);
                    }
                }

                $('#prixTotal').html(prixTotal);
                $('#prixReduit').html(prixReduit);
                $('#netTotal').html((prixTotal - prixReduit));
            }

        }
        else {

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

                        prixReduit = prixReduit + ((prix * qte) * reduction / 100);
                    }

                });

            });

            $('#prixTotal').html(prixTotal);
            $('#prixReduit').html(0);
            $('#netTotal').html((prixTotal));
        }
    })

});


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

function showVenteCaisse(id) {
    //alert(id);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/vente.php',
        data: {
            idCaisse: id
        },
        success: function (data) {
            //alert(data);
            $("#iconPreviewListVenteCaisse").modal('show');
            $('#tab_list_vente_caisse').empty();
            $('#tab_list_vente_caisse').prepend(data);


        }
    });
    $("#previewImprimerBonCaisse").modal('show');
    return false;
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

function valider_vente(type, etat) {
    var nouveau = "";
    var idClient;
    var idPrescripteur;
    var idv, reference;
    var prix, qte, prixReduit, id1, count = 0, rec = 0;

    /**/
    // vérifier si le prix est > à 0
    if (parseInt($('#prixTotal').html()) == 0) {
        //alert("test1");
        $('#message-box-danger p').html('Le prix de la vente ne peut être nul');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 3000);
    }
    else if ($('.select_client option:selected').text() == "Client Existant" && $("#select_vente_client option:selected").val() == 0) {
        
        $('#message-box-danger p').html('Veuillez Sélectionner le client');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);

    }
    else if ($('.select_prescripteur option:selected').text() == "Prescripteur Existant" && $("#select_vente_prescripteur option:selected").val() == 0) {
        
        $('#message-box-danger p').html('Veuillez Sélectionner le prescripteur');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);
    }
    else {
        //alert("test4");
        nouveau = nouveau + $("#input_vente_nomClient").val() + "|" + $("#input_vente_phoneClient").val() + "-";
        if ($('.select_client option:selected').text() == "Client Existant") {
            idClient = $("#select_vente_client option:selected").val();
        } else {
            idClient = null;
        }
        if ($('.select_prescripteur option:selected').text() == "Prescripteur Existant") {
            idPrescripteur = $("#select_vente_prescripteur option:selected").val();
        } else {
            idPrescripteur = null;
        }

        nouveau = nouveau + $("#input_vente_nomPrescripteur").val();

        var commentaire = $("#commentaire_vente").val();


        var prixr = parseInt($('#prixReduit').html());
        //alert("Tata");

        $.ajax({
            type: "POST",
            url: "/pharmacietest/koudjine/inc/vente.php",
            data: {
                idc: idClient,
                idp: idPrescripteur,
                idemp: parseInt($("#comptant").attr("data")),
                nouveau: nouveau,
                commentaire: commentaire,
                prixt: parseInt($('#netTotal').html()),
                prixr: prixr,
                etat: etat
            },
            dataType: 'json',
            success: function (data) {
                //alert(server_responce);
                //alert(data);
                if (data.erreur == 'ok') {
                    idv = data.id;
                    reference = data.ref;
                    //alert(idv);
                    $('#tab_vente  tr').each(function (i) {
                        count++;
                    });
                    console.log(count);

                    $('#tab_vente  tr').each(function (i) {
                        id1 = $(this).attr("id");
                        $("#" + id1 + " td").each(function (j) {
                            ////alert($(this).html());
                            if (j == 1) { prix = parseInt($(this).html()); }
                            if (j == 2) { qte = parseInt($(this).html()); }
                            if (j == 4) {
                                var reduction = parseInt($(this).attr("data"));
                                //alert(reduction);
                                if ($("#select_vente_client").val() == 0 || $(".select_client").val() != 2) {
                                    reduction = 0;
                                } else {
                                    if ($("#select_vente_client option:selected").attr("name") >= reduction) {
                                        //reduction = 0;

                                    }
                                    else {
                                        reduction = parseInt($("#select_vente_client option:selected").attr("name"));
                                    }
                                }
                                if ($("#check_reductionGenerale").is(":checked")) {
                                    reduction = parseInt($(this).attr("data"));
                                    if (parseInt($('#taux').val()) >= reduction) {
                                        //reduction = 0;

                                    }
                                    else {
                                        reduction = parseInt($('#taux').val());
                                    }
                                }
                                if (type != 2) {
                                    prixReduit = ((prix * qte) * reduction / 100);
                                } else {
                                    prixReduit = 0;
                                }

                            }


                        });
                        console.log(prix + '-' + qte + '-' + prixReduit);
                        $.ajax({
                            type: "POST",
                            url: "/pharmacietest/koudjine/inc/concerner_vente.php",
                            data: {
                                idv: idv,
                                ide: id1,
                                prixu: prix,
                                qte: qte,
                                reduction: prixReduit
                            },
                            success: function (server_responce) {
                                console.log(server_responce);
                                rec++;
                                console.log(rec);
                                if (type == 2 && rec == count) {
                                    // Imprimer ticket
                                    var box = $("#mb-confirmation-print");
                                    box.addClass("open");

                                    box.find(".mb-control-yes").on("click", function () {
                                        box.removeClass("open");
                                        var today = new Date();
                                        var dd = String(today.getDate()).padStart(2, '0');
                                        var mm = String(today.getMonth() + 1).padStart(2, '0');
                                        var yyyy = today.getFullYear();
                                        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                                        today = dd + "-" + mm + "-" + yyyy;
                                        $('#ticketVente .reference').html(reference);
                                        $('#ticketVente .datevente').html(today);
                                        $('#ticketVente .heurevente').html(time);
                                        $('#ticketVente .vendeur').html($("#comptant").attr('data1'));
                                        if (idClient == null) {
                                            $('#ticketVente .acheteur').html(nouveau);
                                        } else {
                                            $('#ticketVente .acheteur').html($("#select_vente_client option:selected").text());
                                        }

                                        $('#ticketVente .netapayer').html(parseInt($('#netTotal').html()));
                                        $('#ticketVente .remise').html(0);
                                        $('#ticketVente .montantrendu').html(0);
                                        $('#ticketVente .montantpercu').html(0);
                                        $('#ticketVente .montanttotal').html(parseInt($('#netTotal').html()));

                                        $.ajax({
                                            type: "POST",
                                            url: '/pharmacietest/koudjine/inc/charger_vente.php',
                                            data: {
                                                id: idv
                                            },
                                            success: function (server_responce) {
                                                ////alert(server_responce);
                                                //$("#iconPreview .icon-preview").html(icon_preview);

                                                $('#tab_BfactureImprimer').prepend(server_responce)
                                                //$("#iconPreviewFacture").modal('show');
                                                imprimer_bloc('ticketVente', 'ticketVente');

                                                var link = '/pharmacietest/users/logout';
                                                window.location.href = link;

                                            }


                                        })

                                    });
                                    box.find(".mb-control-close").on("click", function () {
                                        box.removeClass("open");
                                        var link = '/pharmacietest/users/logout';
                                        window.location.href = link;

                                    });

                                } else {

                                    if (rec == count) {
                                        console.log('Redirige');
                                        var link = '/pharmacietest/users/logout';
                                        window.location.href = link;
                                    }
                                }

                            }
                        })

                    });


                } else {
                    //alert('3 - '+data.erreur);
                    $('#alertCaisse').modal("show");
                }

            }
        })

    }


}

function ajouter_produit() {

    //var reduction;
    var prix, qte;

    $('#tab_Bload_produit  tr').each(function (i) {
        var id1 = $(this).attr("id");
        var nom = $("#" + id1 + " .nom").html();
        var qte = parseInt($("#" + id1 + " .qte").val());
        var qterest = parseInt($("#" + id1 + " .qterest").html());
        var prix = parseInt($("#" + id1 + " .prixv").val());
        //alert(prix);
        var stockg = parseInt($("#" + id1 + " .stock").html());
        var datel = $("#" + id1 + " .datel").html();
        ////alert(qte);
        var prix1, qte1;

        if (qte > qterest || qte == 0) {
            if (qte > qterest) alert("Quantité en stock pas suffisante pour cette opération ");
        }
        else {
            var action = 0;
            ////alert(qte);
            $("#tab_vente tr").each(function (j) {

                var id = $(this).attr("id");
                if (id1 == id) {
                    action = 1;
                    $("#" + id1 + " td").each(function (j) {
                        ////alert($(this).html());
                        if (j == 1) { prix1 = parseInt($(this).html()); }
                        if (j == 2) {
                            qte1 = parseInt($(this).html()) + qte;
                            ////alert(qte);
                            if (qte1 > qterest) {
                                //  alert("Quantité en stock pas suffisante pour cette opération ");
                            } else {
                                $(this).html(qte1);
                            }
                        }
                        if (j == 3) {

                            if (qte1 > qterest) {
                                ////alert("Quantité en stock pas suffisante pour cette opération " + qte1);
                            } else {
                                $(this).html((qte1 * prix1));
                            }
                        }
                        if (j == 6) {

                            if (qte1 > qterest) {
                                ////alert("Quantité en stock pas suffisante pour cette opération " + qte1);
                            } else {
                                //stockg = stockg - qte;
                                $(this).html((parseInt(stockg)));
                            }
                        }

                    });
                }
            })
            ////alert('repasse');

            if (action == 0) {
                var cat = '<tr id="' + id1 + '">'
                    + ' <td><strong>' + nom + '</strong></td>'
                    + '<td>' + prix + '</td>'
                    + '<td>' + qte + '</td>'
                    + '<td>' + (prix * qte) + '</td>'
                    + '<td data ="' + $("#" + id1 + " .reduction").html() + '">' + $("#" + id1 + " .reduction").html() + '</td>'
                    + '<td>' + datel + '</td>'
                    + '<td>' + stockg + '</td>'
                    + '<td>'
                    + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row_vente(\'' + id1 + '\');"><span class="fa fa-times"></span></button>'
                    + '</td>'
                    + '</tr>';
                $('#tab_vente').prepend(cat);
                ////alert('trepasse');
            }



        }

    });
    $("#iconPreviewVente").modal("hide");
    var prixTotal = 0;
    var prixReduit = 0;
    $('#recherche').val("");
    $('#recherche').focus();
    $("#tab_Grecherche").hide();


    // on verifie si le taux est coché, si oui on le décoche en chargeant le prix réduit des produits
    if ($("#check_reductionGenerale").is(":checked")) {
        $('#check_reductionGenerale').prop("checked", false);
    }
    $('#tab_vente  tr').each(function (i) {
        var id1 = $(this).attr("id");
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
    $('#tab_load_produit').dataTable({
        destroy: true,
    });


    $('#prixTotal').html(prixTotal);
    $('#prixReduit').html(prixReduit);
    $('#netTotal').html((prixTotal - prixReduit));
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
            //$('#tab_vente_caisse').html(server_responce);
            $('#tab_BfactureImprimer2').prepend(server_responce);
            $('#iconPreviewFacture2').modal("show");


        }


    })


}

function load_produit(id) {

    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    }
    else {

        if ($.fn.dataTable.isDataTable('#tab_load_produit')) {
            $('#tab_load_produit').dataTable({
                destroy: true,
                // searching: false,
                // retrieve: true,
                // "processing": true,
                // "serverSide": true,
                //dom: "Bfrtip",
                ajax: {
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                },
                columns: [
                    { data: "nom" },
                    { data: "prixUnitaire" },
                    { data: "quantite" },
                    { data: "stockq" },
                    { data: "stockg" },
                    { data: "reduction" },
                    { data: "date" },
                    { data: "action" },
                ]
            });

        }
        else {
            $('#tab_load_produit').dataTable({
                destroy: true,
                // paging: false,
                // searching: false,
                // retrieve: true,
                // "processing": true,
                // "serverSide": true,
                //dom: "Bfrtip",
                ajax: {
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                },
                columns: [
                    { data: "nom" },
                    { data: "prixUnitaire" },
                    { data: "quantite" },
                    { data: "stockq" },
                    { data: "stockg" },
                    { data: "reduction" },
                    { data: "date" },
                    { data: "action" },
                ]
            });

        }

        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

    }

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