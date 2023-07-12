var test = 0;
var startDate;
var endDate;
var endDate;
/*var _startDetailVente = moment().subtract('days', 29).format("YYYY-MM-DD HH:mm:ss");
var _endDetailVente = moment().format("YYYY-MM-DD HH:mm:ss");
var _startDetailCommande = moment().subtract('days', 29).format("YYYY-MM-DD HH:mm:ss");
var _endDetailCommande = moment().format("YYYY-MM-DD HH:mm:ss");*/
var idemploye = null
;
var idfulldepense;
$('#pharmanet_tab_vente').hide();

$(document).ready(function () {


    $("#detailTab").hide();
    if ($("#reportRangeDateVente").length > 0) {
        $("#reportRangeDateVente").daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM.DD.YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()
        }, function (start, end) {
            _startCaisse = start;
            _endCaisse = end;
            var a_ = start.format("YYYY-MM-DD HH:mm:ss");
            var b_ = end.format("YYYY-MM-DD HH:mm:ss");
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/load_produit_detail_table.php',
                data: {
                    id: _idprod,
                    start: a_,
                    end: b_,
                },
                dataType: 'json',
                success: function (responce) {
                    //alert(responce);
                    var datas = responce;
                    $('#qte_vente_total').html(datas.qteVenteTotal);
                    $('#reduction_vente_total').html(datas.reductionVenteTotal);
                    $('#prix_vente_total').html(datas.prixVenteTotal);
                    $('#produit_detail_b').empty();
                    $('#produit_detail_b').dataTable({
                        destroy: true,
                        data: datas.data,
                        columns: [
                            {data: "datevente"},
                            {data: "vendeur"},
                            {data: "client"},
                            {data: "prixunit"},
                            {data: "quantite"},
                            {data: "prixTotal"},
                            {data: "reduction"},
                            {data: "prixVente"}
                        ]
                    });
                }
            });
            $('#reportRangeDateVente span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $("#reportRangeDateVente span").html(moment().subtract('days', 29).format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));

    }

    if ($("#reportRangeDateCommande").length > 0) {
        $("#reportRangeDateCommande").daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM.DD.YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()
        }, function (start, end) {
            _startCaisse = start;
            _endCaisse = end;
            var a_ = start.format("YYYY-MM-DD HH:mm:ss");
            var b_ = end.format("YYYY-MM-DD HH:mm:ss");
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/load_produit_commande_detail_table.php',
                data: {
                    id: _idprod,
                    start: a_,
                    end: b_,
                },
                dataType: 'json',
                success: function (responce) {
                    var datas = responce;
                    $('#prix_cmd_total').html(datas.prixCommandeCmdTotal);
                    $('#prix_recu_total').html(datas.prixCommandeRecuTotal);
                    $('#qte_recu_total').html(datas.qteCommandeRecu);
                    $('#qte_cmd_total').html(datas.qteCommandeCmd);
                    $('#produit_commande_detail_b').dataTable({
                        destroy: true,
                        data: datas.data,
                        columns: [
                            {data: "date"},
                            {data: "produit_id"},
                            {data: "commande_id"},
                            {data: "fournisseur"},
                            {data: "prixAchat"},
                            {data: "prixVente"},
                            {data: "qtiteCmd"},
                            {data: "qtiteRecu"},
                            {data: "totalCmd"},
                            {data: "TotalRecu"},
                            {
                                data: "etat", "render": function (data, type, row) {
                                    if (data == "Livré") {
                                        return '<span class="label label-success">' + data + '</span>';
                                    } else {
                                        if (data == "Commandé") {
                                            return '<span class="label label-warning">' + data + '</span>';
                                        } else {
                                            return '<strong >' + data + '</strong>';
                                        }
                                    }
                                }
                            },
                            {
                                data: "action", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return '<a class="btn btn-success btn-rounded btn-sm "  onclick="modifier_commande(' + data + ',' + row.produit_cmd_id + ')"><span class="">Modifier</span></a>' +
                                            '<a class="btn btn-primary btn-rounded btn-sm " onclick="delete_row_commande(' + data + ')"  ><span class="">Supprimer</span></a>';
                                        ;
                                    }
                                }
                            },
                        ]
                    });
                }
            });
            $('#reportRangeDateCommande span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $("#reportRangeDateCommande span").html(moment().subtract('days', 29).format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));

    }

    $("#tab_produit_detail").hide();

    $("#detail_recherche").keyup(function (event) {
        $("#tab_produit_detail").hide();
        var recherche = $(this).val();
        recherche = $.trim(recherche);
        var data = 'motclef1=' + recherche;
        if (recherche.length > 1) {
            ////alert('yes');
            $.ajax({
                type: "GET",
                url: "/pharmacietest/koudjine/inc/resultdetail.php",
                data: data,
                success: function (server_responce) {

                    $("#tab_produit_detail").show();
                    $("#tab_produit_detail_data").html(server_responce).show();
                    ////alert(server_responce);
                }
            })
        } else {
            $("#tab_produit_detail").hide();
        }

    });

    if (test == 0) {
        //console.log("No id");
    } else {
        //console.log("id exist");
        load_produit_detail(test, null);
    }

});


function delete_row(row, controller, table, confirmation) {

    if (confirmation) {
        $("#" + row).hide("slow", function () {
            var link = '/pharmacietest/bouwou/' + controller + '/delete/' + row + '/' + table;
        });
    } else {
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

function enregistrer_fabriquant(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();
    var codepostal = $('#codepostal').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();
    var email = $('#email').val()

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fabriquant.php',
            data: {
                nom: nom,
                code: code,
                codepostal: codepostal,
                adresse: adresse,
                telephone: telephone,
                email: email
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/fabriquant/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fabriquant.php',
            data: {
                nom: nom,
                code: code,
                codepostal: codepostal,
                adresse: adresse,
                telephone: telephone,
                email: email,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/fabriquantadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_fabriquant(id) {
    var link = '/pharmacietest/bouwou/catalogue/fabriquantadd/' + id;
    ////alert(link);
    window.location.href = link;
}

function enregistrer_produit(option, id) {
    // Informations produit
    var nom = $('#nom').val();
    var ean13 = $('#ean13').val();
    var reference = $('#reference').val();
    var laborex = $('#laborex').val();
    var ubipharm = $('#ubipharm').val();
    ////alert(type);
    var stock = $('#stock').val();
    var etat = $('#pdt_etat').val();
    var etagere = $('#etagere').val();
    var contenu = $('#contenu').val();
    var prixDetail = parseInt($('#prixDetail').val());
    var stockmin = $('#stockmin').val();
    var stockmax = $('#stockmax').val();
    var reduction = $('#reduction').val();
    var cat = $('#catproduit option:selected').val();
    var ray = $('#rayonproduit option:selected').val();
    var fab = $('#fabproduit option:selected').val();
    var mag = $('#magproduit option:selected').val();
    var forme = $('#formeproduit option:selected').val();
    var prod = $('#produits').val();
    console.log(prod);
    //alert(contenu);
    if (contenu == '') contenu = null;
    var newprod = ""
    if (prod == null || prod == "") {

    } else {
        for (index = 0; index < prod.length; index++) {

            if (index == prod.length - 1) {
                newprod = newprod + "" + prod[index];
            } else {
                newprod = newprod + "" + prod[index] + "-";
            }
        }
    }


    console.log(newprod);
    prod = newprod;

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit.php',
            data: {
                nom: nom,
                etat: etat,
                etagere: etagere,
                contenu: contenu,
                prix: prixDetail,
                ean13: ean13,
                reference: reference,
                laborex: laborex,
                ubipharm: ubipharm,
                stock: stock,
                stockmin: stockmin,
                stockmax: stockmax,
                reduction: reduction,
                cat: cat,
                forme: forme,
                ray: ray,
                fab: fab,
                parrain: prod,
                mag: mag
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Ajout effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        var link = '/pharmacietest/bouwou/catalogue/produitadd';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    } else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit.php',
            data: {
                nom: nom,
                etat: etat,
                etagere: etagere,
                contenu: contenu,
                prix: prixDetail,
                ean13: ean13,
                reference: reference,
                laborex: laborex,
                ubipharm: ubipharm,
                stock: stock,
                stockmin: stockmin,
                stockmax: stockmax,
                reduction: reduction,
                cat: cat,
                forme: forme,
                ray: ray,
                fab: fab,
                mag: mag,
                parrain: prod,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);

                if (data == 'ok') {
                    noty({text: 'Modification effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        //var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
                        var link = '/pharmacietest/bouwou/catalogue/produitadd';
                        window.location.href = link;
                    }, 5000);
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_produit(id) {
    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
    //alert(link);
    window.location.href = link;
}

function init_rayon(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/rayon.php',
        data: {
            id: id
        },
        success: function (data) {
            if (data == 'ok') {
                noty({text: 'Modification effectué', layout: 'topRight', type: 'success'});
               /* setTimeout(function () {
                    var link = '/pharmacietest/bouwou/catalogue/produit/';
                    window.location.href = link;
                }, 3000);*/
                $('#' + id + ' .btn-success').css('display','none');

            } else {
                noty({text: data, layout: 'topRight', type: 'error'});
            }
        }
    });
}


function enregistrer_assureur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var taux = $('#taux').val();
    var CodePostal_id = $('#CodePostal_id').val();
    var telephone = $('#telephone').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_assureur.php',
            data: {
                nom: nom,
                taux: taux,
                CodePostal_id: CodePostal_id,
                telephone: telephone
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/assureur/';
                    }, 5000);

                    window.location.href = link;
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_assureur.php',
            data: {
                id: id,
                nom: nom,
                taux: taux,
                CodePostal_id: CodePostal_id,
                telephone: telephone,
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/assureuradd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_assureur(id) {
    var link = '/pharmacietest/bouwou/catalogue/assureuradd/' + id;
    ////alert(link);
    window.location.href = link;
}

function enregistrer_categorie(option, id) {

    var nom = $('#nom').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_categorie.php',
            data: {
                nom: nom,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/categorie/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_categorie.php',
            data: {
                nom: nom,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/categorieadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_categorie(row) {

    var nom;
    // var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }

    });

    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
}

function enregistrer_commande(option, id) {

    var dateCreation = $('#dateCreation').val();
    var dateLivraison = $('#dateLivraison').val();
    var note = $('#note').val();
    var qtiteCmd = $('#qtiteCmd').val();
    var qtiteRecu = $('#qtiteRecu').val();
    var montantCmd = $('#montantCmd').val();
    var montantRecu = $('#montantRecu').val();
    var etat = $('#etat').val();
    var ref = $('#ref').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_commande.php',
            data: {
                dateCreation: dateCreation,
                dateLivraison: dateLivraison,
                note: note,
                qtiteCmd: qtiteCmd,
                qtiteRecu: qtiteRecu,
                montantCmd: montantCmd,
                montantRecu: montantRecu,
                etat: etat,
                ref: ref,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/commande/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_commande.php',
            data: {
                dateCreation: dateCreation,
                dateLivraison: dateLivraison,
                note: note,
                qtiteCmd: qtiteCmd,
                qtiteRecu: qtiteRecu,
                montantCmd: montantCmd,
                montantRecu: montantRecu,
                etat: etat,
                ref: ref,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/commandeadd/' + id;
                    window.location.href = link;
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function enregistrer_client(option, id) {

    var nom = $('#nom').val();
    var telephone = $('#telephone').val();
    var modeReglement = $('#modeReglement').val();
    var poid = $('#poid').val();
    var taille = $('#taille').val();
    var reduction = $('#reduction').val();
    var assureur_id = $('#assureur_id').val();
    var CodePostal_id = $('#CodePostal_id').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_client.php',
            data: {
                nom: nom,
                telephone: telephone,
                modeReglement: modeReglement,
                poid: poid,
                taille: taille,
                reduction: reduction,
                assureur_id: assureur_id,
                CodePostal_id: CodePostal_id
            },
            success: function (data) {

                if (data == 'ok') {

                    noty({text: 'Ajout effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        var link = '/pharmacietest/bouwou/catalogue/client/';
                        window.location.href = link;
                    }, 5000);
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_client.php',
            data: {
                nom: nom,
                telephone: telephone,
                modeReglement: modeReglement,
                poid: poid,
                taille: taille,
                reduction: reduction,
                assureur_id: assureur_id,
                CodePostal_id: CodePostal_id,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {

                    noty({text: 'Modification effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
                        window.location.href = link;
                    }, 5000);
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_client(id) {
    var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
    ////alert(link);
    window.location.href = link;
}

function enregistrer_codepostal(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_codepostal.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/codepostal/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_codepostal.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_codepostal(id) {
    var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
    ////alert(link);
    window.location.href = link;
}

function enregistrer_forme(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_forme.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/forme/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_forme.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/formeadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

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
}

function enregistrer_fournisseur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();
    var codepostal = $('#codepostal').val();
    var statut = $('#statut').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();
    var email = $('#email').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fournisseur.php',
            data: {
                nom: nom,
                code: code,
                codepostal: codepostal,
                statut: statut,
                adresse: adresse,
                telephone: telephone,
                email: email,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/fournisseur/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fournisseur.php',
            data: {
                nom: nom,
                code: code,
                codepostal: codepostal,
                statut: statut,
                adresse: adresse,
                telephone: telephone,
                email: email,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/fournisseuradd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_fournisseur(id) {
    var link = '/pharmacietest/bouwou/catalogue/fournisseuradd/' + id;
    ////alert(link);
    window.location.href = link;
}

function enregistrer_magasin(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_magasin.php',
            data: {
                nom: nom,
                code: code,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/magasin/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_magasin.php',
            data: {
                nom: nom,
                code: code,
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/magasinadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

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
}

function enregistrer_prescripteur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var structure = $('#structure').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_prescripteur.php',
            data: {
                Nom: nom,
                Structure: structure,
                Adresse: adresse,
                Telephone: telephone
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/prescripteur/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_prescripteur.php',
            data: {
                Nom: nom,
                Structure: structure,
                Adresse: adresse,
                Telephone: telephone,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/catalogue/prescripteuradd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_prescripteur(id) {
    var link = '/pharmacietest/bouwou/catalogue/prescripteuradd/' + id;
    window.location.href = link;
}

function enregistrer_ville(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_ville.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/ville/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_ville.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/villeadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

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
}

function enregistrer_unite(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var libelle = $('#libelle').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_unite.php',
            data: {
                nom: nom,
                libelle: libelle
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/unite/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_unite.php',
            data: {
                nom: nom,
                libelle: libelle,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/uniteadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

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

function enregistrer_rayon(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();


    if (option == 'Ajouter') {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_rayon.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/rayon/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_rayon.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {

                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/rayonadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

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
}

function enregistrer_en_rayon(option, id) {
    // Informations université
    var produit_id = $('#produit_id').val();
    var fournisseur_id = $('#fournisseur_id').val();
    var dateLivraison = $('#dateLivraison').val();
    var datePeremption = $('#datePeremption').val();
    var prixAchat = $('#prixAchat').val();
    var prixVente = $('#prixVente').val();
    var reduction = $('#reduction').val();
    var quantite = $('#quantite').val();
    var quantiteRestante = $('#quantiteRestante').val();

    if (option == 'Ajouter') {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_en_rayon.php',
            data: {
                produit_id: produit_id,
                fournisseur_id: fournisseur_id,
                dateLivraison: dateLivraison,
                datePeremption: datePeremption,
                prixAchat: prixAchat,
                prixVente: prixVente,
                reduction: reduction,
                quantite: quantite,
                quantiteRestante: quantiteRestante
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/en_rayon/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_en_rayon.php',
            data: {
                produit_id: produit_id,
                fournisseur_id: fournisseur_id,
                dateLivraison: dateLivraison,
                datePeremption: datePeremption,
                prixAchat: prixAchat,
                prixVente: prixVente,
                reduction: reduction,
                quantite: quantite,
                quantiteRestante: quantiteRestante,
                id: id
            },
            success: function (data) {

                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/en_rayonadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function enregistrer_utilisateur(option, id) {
    // Informations utilisateur
    //e.preventDefault();
    var nom = $('#noms').val();
    var prenom = $('#prenoms').val();
    var identifiant = $('#identifiant').val();
    var password = $('#password').val();
    ////alert(password);
    var daten = $('#dp-3').val();
    var statut = $('#statut option:selected').text();
    var fonction = $('#fonction').val();
    var photo_profil = $('#photo_profil').val();
    if (photo_profil == '') {
        photo_profil = 'no-image.jpg';
    }
    var file_data = $("#photo_profil").prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    //  alert(form_data);

    // Informations contact
    var bp = $('#bp').val();
    var email = $('#email').val();
    var telephone_1 = $('#telephone_1').val();
    var telephone_2 = $('#telephone_2').val();
    var site = $('#site').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_utilisateur.php',
            data: {
                nom: nom,
                prenom: prenom,
                identifiant: identifiant,
                password: password,
                daten: daten,
                statut: statut,
                fonction: fonction,
                photo_profil: photo_profil,
                bp: bp,
                telephone_1: telephone_1,
                telephone_2: telephone_2,
                email: email,
                site: site,
                option: option
            },
            success: function (data) {
                if (data == 'ok') {
                    var link = '/Site/bouwou/users';
                    window.location.href = link;
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);
                }
            }
        });
    } else if (option == 'Modifier') {
        ////alert('test2');
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_utilisateur.php',
            data: {
                nom: nom,
                prenom: prenom,
                identifiant: identifiant,
                password: null,
                daten: daten,
                statut: statut,
                fonction: fonction,
                photo_profil: photo_profil,
                bp: bp,
                telephone_1: telephone_1,
                telephone_2: telephone_2,
                email: email,
                site: site,
                option: option,
                id: id
            },
            success: function (data) {
                if (data == 'ok') {
                    var link = '/Site/bouwou/users';
                    window.location.href = link;
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);

                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_utilisateur.php',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            //dataType: 'json',
            data: {
                nom: nom,
                prenom: prenom,
                identifiant: identifiant,
                password: password,
                daten: daten,
                statut: null,
                fonction: fonction,
                photo_profil: photo_profil,
                bp: bp,
                telephone_1: telephone_1,
                telephone_2: telephone_2,
                email: email,
                site: site,
                option: option,
                id: id,
                data: form_data
            },
            success: function (data) {
                if (data == 'ok') {
                    var link = '/Site/bouwou/users';
                    window.location.href = link;
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);

                }
            }
        });
    }

}

function update_row_user(id) {
    var link = '/pharmacietest/bouwou/pharmanet/useradd/' + id;
    window.location.href = link;
}

function enregistrer_employe(option, id) {
    // Informations université
    var identifiant = $('#identifiant').val();
    var password = $('#password').val();
    var type = $('#type').val();
    var etat = $('#etat').val();
    var user_id = $('#user_id').val();
    var codebarre_id = $('#codebarre_id').val();
    ////alert(type);
    var faireReductionMax = $('#faireReductionMax').val();
    /*$("#magproduit").change(function () {
        v = $('#magproduit option:selected').val();
      //  alert(v);
    })*/
    //.trigger('change');
    ////alert(mag);

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_employe.php',
            data: {
                identifiant: identifiant,
                password: password,
                type: type,
                etat: etat,
                user_id: user_id,
                codebarre_id: codebarre_id,
                faireReductionMax: faireReductionMax,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/pharmanet/employe';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_employe.php',
            data: {
                identifiant: identifiant,
                password: password,
                type: type,
                etat: etat,
                user_id: user_id,
                codebarre_id: codebarre_id,
                faireReductionMax: faireReductionMax,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/pharmanet/employeadd/' + id;
                    window.location.href = link;
                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_employe(int) {
    var link = '/pharmacietest/bouwou/pharmanet/employeadd/' + int;
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

var _idprod;
var _nameprod;

function load_produit_detail(id, nomp) {
    _idprod = id;
    _nameprod = nomp;
    //alert(id + "" + nomp);
    $('#detail_recherche').val(nomp);
    $("#tab_produit_detail").hide();
    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    } else {
        $("#detailTab").show();
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_detail.php',
            data: {
                id: id,
                start: moment().startOf('month').format("YYYY-MM-DD HH:mm:ss"),
                end: moment().endOf('month').format("YYYY-MM-DD HH:mm:ss"),
            },
            dataType: 'json',
            success: function (responce) {
                var datas = responce;
                console.log(datas);
                $('#qte_vente_total').html(datas.qteVenteTotal);
                $('#reduction_vente_total').html(datas.reductionVenteTotal);
                $('#prix_vente_total').html(datas.prixVenteTotal);
                $('#produit_detail_mois_a').dataTable({
                    destroy: true,
                    searching: false,
                    dFilter: false,
                    bInfo: false,
                    bPaginate: false,
                    data: datas.data,
                    columns: [
                        {data: "nomProduit"},
                        {data: "qteVenteMois"},
                        {data: "redVenteMois"},
                        {data: "prixVenteMois"},
                    ]
                });
                $('#produit_detail_total_a').dataTable({
                    destroy: true,
                    searching: false,
                    dFilter: false,
                    bInfo: false,
                    bPaginate: false,
                    data: datas.data,
                    columns: [
                        {data: "nomProduit"},
                        {data: "qteVenteTotal"},
                        {data: "redVenteTotal"},
                        {data: "prixVenteTotal"},
                    ]
                });
            }
        });

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_detail_table.php',
            data: {
                id: id,
                start: _startDetailVente,
                end: _endDetailVente,
            },
            dataType: 'json',
            success: function (responce) {
                var datas = responce;
                $('#qte_vente_total').html(datas.qteVenteTotal);
                $('#reduction_vente_total').html(datas.reductionVenteTotal);
                $('#prix_vente_total').html(datas.prixVenteTotal);
                $('#produit_detail_b').empty();
                $('#produit_detail_b').dataTable({
                    destroy: true,
                    data: datas.data,
                    columns: [
                        {data: "datevente"},
                        {data: "vendeur"},
                        {data: "client"},
                        {data: "prixunit"},
                        {data: "quantite"},
                        {data: "prixTotal"},
                        {data: "reduction"},
                        {data: "prixVente"}
                    ]
                });
            }
        });

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_commande_detail.php',
            data: {
                id: id,
                start: _startDetailVente,
                end: _endDetailVente,
            },
            dataType: 'json',
            success: function (responce) {
                var datas = responce;
                $('#produit_commande_detail_mois_a').dataTable({
                    destroy: true,
                    searching: false,
                    dFilter: false,
                    bInfo: false,
                    bPaginate: false,
                    data: datas.data,
                    columns: [
                        {data: "nom"},
                        {data: "nbrCommandeMois"},
                        {data: "prixCommandeMois"},
                    ]
                });
                $('#produit_commande_detail_total_a').dataTable({
                    destroy: true,
                    searching: false,
                    dFilter: false,
                    bInfo: false,
                    bPaginate: false,
                    data: datas.data,
                    columns: [
                        {data: "nom"},
                        {data: "nbrCommandeTotal"},
                        {data: "prixCommandeTotal"},
                    ]
                });
            }
        });

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_commande_detail_table.php',
            data: {
                id: id,
                start: _startDetailVente,
                end: _endDetailVente,
            },
            dataType: 'json',
            success: function (responce) {
                var datas = responce;
                $('#prix_cmd_total').html(datas.prixCommandeCmdTotal);
                $('#prix_recu_total').html(datas.prixCommandeRecuTotal);
                $('#qte_recu_total').html(datas.qteCommandeRecu);
                $('#qte_cmd_total').html(datas.qteCommandeCmd);
                $('#produit_commande_detail_b').dataTable({
                    destroy: true,
                    data: datas.data,
                    columns: [
                        {data: "date"},
                        {data: "produit_id"},
                        {data: "commande_id"},
                        {data: "fournisseur"},
                        {data: "prixAchat"},
                        {data: "prixVente"},
                        {data: "qtiteCmd"},
                        {data: "qtiteRecu"},
                        {data: "totalCmd"},
                        {data: "TotalRecu"},
                        {
                            data: "etat", "render": function (data, type, row) {
                                if (data == "Livré") {
                                    return '<span class="label label-success">' + data + '</span>';
                                } else {
                                    if (data == "Commandé") {
                                        return '<span class="label label-warning">' + data + '</span>';
                                    } else {
                                        return '<strong >' + data + '</strong>';
                                    }
                                }
                            }
                        },
                        {
                            data: "action", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<a class="btn btn-success btn-rounded btn-sm "  onclick="modifier_commande(' + data + ',' + row.produit_cmd_id + ')"><span class="">Modifier</span></a>' +
                                        '<a class="btn btn-primary btn-rounded btn-sm " onclick="delete_row_commande(' + data + ')"  ><span class="">Supprimer</span></a>';
                                    ;
                                }
                            }
                        },
                    ]
                });
            }
        })

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_stock_detail_table.php',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (responce) {
                var datas = responce;
                $('#tab_produit_stock_detail_total').html(datas.stockTotal);
                $('#tab_produit_stock_detail_restant').html(datas.stockRestant);
                $('#produit_stock_detail_b').dataTable({
                    destroy: true,
                    data: datas.data,
                    columns: [
                        {data: "nom"},
                        {data: "fournisseur"},
                        {data: "dateLivraison"},
                        {data: "datePeremption"},
                        {data: "prixAchat"},
                        {data: "prixVente"},
                        {data: "reduction"},
                        {data: "quantite"},
                        {data: "quantiteRestante"},
                        {
                            data: "id", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<a class="btn btn-success btn-rounded btn-sm"  onclick="show_modif_enrayon(' + data + ')"><span class="">Modifier</span></a>' +
                                        '<a class="btn btn-primary btn-rounded btn-sm "   onclick="show_modif_sortie(' + data + ')"><span class="">Périmé & Stock détail</span></a>' +
                                        '<a class="btn btn-primary btn-rounded btn-sm "   onclick="info_row_entree(' + data + ')"><span class="">Imprimer etiquette</span></a>'+
                                        '<a class="btn btn-danger btn-rounded btn-sm "   onclick="delete_row(\'' + data + '\',\'catalogue\',\'en_rayon\',false)"><span class="">Supprimer</span></a>';
                                }
                            }
                        },
                    ]
                });
            }
        })

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_detail_sortie.php',
            data: {
                id: id
            },
            success: function (responce) {
                $('#tab_produit_stock_detail_sortie_a').html(responce);
                $("#produit_stock_detail_sortie_a").show();
                $("#tab_produit_stock_detail_sortie_a").show();
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/load_produit_sortie_stock.php",
                    data: {
                        id: id
                    },
                    success: function (responce) {
                        $('#tab_produit_stock_detail_sortie_b').html(responce);
                        $("#produit_stock_detail_sortie_b").show();
                        $("#tab_produit_stock_detail_b").show();
                    }
                })
            }
        })
        if ($.fn.dataTable.isDataTable('#produit_stock_detail_b')) {

            $('#produit_stock_detail_sortie_b').dataTable({
                destroy: true,
                ajax: {
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit_sortie_stock.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                },
                columns: [
                    {data: "nom"},
                    {data: "quantite"},
                    {data: "nomproduitdetail"},
                    {data: "forme"},
                    {data: "dateSortie"},
                    {data: "operation"}
                ]
            });
        } else {
            $('#produit_stock_detail_sortie_b').dataTable({
                destroy: true,
                ajax: {
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit_sortie_stock.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                },
                columns: [
                    {data: "nom"},
                    {data: "quantite"},
                    {data: "nomproduitdetail"},
                    {data: "forme"},
                    {data: "dateSortie"},
                    {data: "operation"}
                ]
            });
        }

        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

    }

}

function modifier_commande(id, produitCmdId) {
    $("#iconPreviewDetailPdtCmdModif").modal('show');
    $("#" + produitCmdId + " td").each(function (j) {
        ////alert($(this).html());
        $("#idPdtCmd").html(produitCmdId);
        if (j === 4) {
            $("#pdtCmdprixachat").val(parseInt($(this).html()));
            qte = parseInt($(this).html());
        }
        if (j === 5) {
            $("#pdtCmdprixvente").val(parseInt($(this).html()));
        }
        if (j === 7) {
            $("#pdtCmdquantite").val(parseInt($(this).html()));
        }
    });
}

function save_commande() {
    var id = $('#idPdtCmd').html();
    //alert(id);
    var pdtCmdprixachat = $('#pdtCmdprixachat').val();
    var pdtCmdprixvente = $('#pdtCmdprixvente').val();
    var pdtCmdquantite = $('#pdtCmdquantite').val();
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/produit_commande.php',
        data: {
            id: id,
            prixachat: pdtCmdprixachat,
            prixvente: pdtCmdprixvente,
            quantite: pdtCmdquantite,
        },
        dataType: 'json',
        success: function (data) {
            console.log('count:' + data.count)
            noty({text: 'Enregistrement effectué' + data, layout: 'topRight', type: 'success'});
            load_produit_detail(_idprod, _nameprod);
            setTimeout(function () {
                $("#iconPreviewDetailPdtCmdModif").modal('hide');
            }, 3000);
        }
    });
    //$("#iconPreviewDetailPdtCmdModif").modal('hide');
}

function save_produit_detail() {
    var id = $('#id').val();
    //alert(id);
    var erprixachat = $('#erprixachat').val();
    var erprixvente = $('#erprixvente').val();
    var erquantite = $('#erquantite').val();
    var erreduction = $('#erreduction').val();
    //var erquantitecm = $('#erquantitecm').val();
    var erdatePeremption = moment($('#erdatePeremption').val()).format("YYYY-MM-DD HH:MM:SS");
    //var erdatePeremption = $('#erdatePeremption').val();
    console.log(erdatePeremption);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/enregistrer_enrayon.php',
        data: {
            id: id,
            prixAchat: erprixachat,
            prixVente: erprixvente,
            datePeremption: erdatePeremption,
            quantiteRestante: erquantite,
            reduction: erreduction,
            //quantite: erquantitecm
        },
        success: function (data) {
            noty({text: 'Enregistrement effectué' + data, layout: 'topRight', type: 'success'});
            load_produit_detail(_idprod, _nameprod);
            setTimeout(function () {
                $("#iconPreviewDetailModif").modal('hide');
            }, 3000);
        }
    });

}

function show_modif_sortie(id) {
    var link = '/pharmacietest/bouwou/comptabilite/sortie/' + id;
    window.location.href = link;
}

function show_modif_enrayon(id) {
    $("#iconPreviewDetailModif").modal('show');
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/enregistrer_enrayon.php',
        data: {
            id: id,
            prixAchat: 0,
            prixVente: 0,
            datePeremption: 0,
            quantite: 0,
            reduction: 0,
            quantiteRestante: 0
        },
        dataType: 'json',
        success: function (data) {
            $("#id").val(data.data.id);
            $("#erprixachat").val(data.data.prixAchat);
            $("#erprixvente").val(data.data.prixVente);
            $("#erdatePeremption").val(data.data.datePeremption);
            $("#erquantite").val(data.data.quantiteRestante);
            $("#erquantitecm").val(data.data.quantite);
            $("#erreduction").val(data.data.reduction);
        }
    });

}

var etiquetteNomP;
var etiquetteNomF;
var etiquetteCode;
var etiquetteDatel;
var etiquetteDatep;
var etiquettePrix;
var qrcode;

function info_row_entree(row) {

    var code;
    $('#qte_etiquette_table').val('');

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/info_entree.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            $('#qrcode').empty();
            etiquetteNomP = data.nomP;
            etiquetteNomF = data.code;
            etiquetteCode = data.code;
            etiquetteDatel = data.datel;
            etiquetteDatep = data.datep;
            etiquettePrix = data.prixv;

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
            code1 = data.codebarre;
            qrcode = new QRCode(document.getElementById("qrcode"), {
                width: 30,
                height: 30
            });
            qrcode.makeCode(code1);

        }
    })
    $("#iconPreviewEntree").modal("show");

}

function imprimer_bloc(titre, objet) {
    var qte = parseInt($("#qte_etiquette_table").val());
    var doc = new jspdf.jsPDF({
        orientation: 'landscape', unit: 'mm', format: [30, 20
        ]
    });
    console.log(qte);
    if (qte > 0) {
        setTimeout(function () {
            /*console.log("i2: "+ind);
            console.log($('#qrcode img').attr('src'));*/
            for (let i = 0; i < qte; i++) {
                console.log(i)
                let base64Image = $('#qrcode img').attr('src');
                console.log(base64Image);


                doc.cell(0, 0, 30, 20, ' ', 1, "center");
                doc.setFontSize(2);
                doc.setFontSize(7);
                doc.text(19, 6, etiquettePrix + ' F');
                doc.addImage(base64Image, "JPEG", 1, 1, 17, 17);
                doc.setFontSize(5);
                doc.text(19, 8, etiquetteNomF);
                doc.setFontSize(4);
                doc.text(19, 10, etiquetteDatel);
                doc.text(19, 12, etiquetteDatep);
                doc.text(19, 16, etiquetteNomP);
                if (i < qte - 1) {
                    doc.cellAddPage([30, 20], "l");
                }
            }
            doc.save(etiquetteNomP + '.pdf');
        }, 2500);
    } else {
        let base64Image = $('#qrcode img').attr('src');
        console.log(base64Image);
        //var doc = new jsPDF('l', 'mm', [30, 15]);
        doc.cell(0, 0, 30, 20, ' ', 1, "center");
        doc.setFontSize(2);
        doc.setFontSize(7);
        doc.text(19, 6, etiquettePrix + ' F');
        doc.addImage(base64Image, "JPEG", 1, 1, 17, 17);
        doc.setFontSize(5);
        doc.text(19, 8, etiquetteNomF);
        doc.setFontSize(4);
        doc.text(19, 10, etiquetteDatel);
        doc.text(19, 12, etiquetteDatep);
        doc.text(19, 16, etiquetteNomP);
        doc.save('hello.pdf');
        //doc.print('hello');
    }

    return true;
}

function charger_select_produit() {
    var nom = $('#nom').val();
    //alert('pass')
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_select_produit.php',
        data: {
            nom: nom
        },
        success: function (data) {
            console.log(data);
            $('ul.dropdown-menu ')
                .find('li')
                .remove()
                .end()
                .append(data)

            ;
            /*$.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/charger_select_produit1.php',
                data: {
                    nom: nom
                },
                success: function (data) {
                    $('#produits').empty();
                    $('#produits').append(data);
                    console.log(data);

                }
            })*/

        }
    })
}
