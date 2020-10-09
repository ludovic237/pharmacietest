$(document).ready(function () { 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus

    // Pharmacie
    var netpayer;
    var reduc;
    var stock;

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
        else{
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

    if ($("#tab_produit_detail_a").attr("data") == '') {
        $("#tab_produit_stock_detail").hide();
        $("#produit_stock_detail_a").hide();
        $("#produit_stock_detail_b").hide();

        $("#tab_produit_detail").hide();
        $("#produit_detail_a").hide();
        $("#produit_detail_b").hide();

        $("#tab_produit_commande_detail").hide();
        $("#produit_commande_detail_a").hide();
        $("#produit_commande_detail_b").hide();
    }

    $("#tab_GrechercheEntre").hide();
    $("#tab_Grecherche").hide();
    $(".clientExistant").hide();
    $(".prescripteurExistant").hide();

    /*$('#tab_Bload_produit').on('show.bs.modal', function () {
        ////alert('passe');
        $("#tab_BCrecherche").hide();
        $("#tab_GCrecherche").hide();
        $("#recherche").focus();
    });*/
    $('#tab_Bload_produit').on('show.bs.modal', function () {
        ////alert('passe');
        $("#recherche").val('');
        $("#tab_GCrecherche").hide();
        $("#recherche").focus();
    });



    $('#tab1 .montant').keyup(function (e) {
        ////alert('passe');
        $('#tab1 .reste').val($('#tab1 .montant').val() - parseInt($('#facture_caisse').html()));
    })
    $('#tab2 .montant').keyup(function (e) {
        ////alert('passe');
        $('#tab2 .reste').val($('#tab2 .montant').val() - parseInt($('#facture_caisse').html()));
    })
    $("#credit").hover(function () {
        netpayer = $("#netTotal").html();
        reduc = $("#prixReduit").html();
        $("#netTotal").html($("#prixTotal").html());
        $("#prixReduit").html(0);
    }, function () {
        $("#netTotal").html(netpayer);
        $("#prixReduit").html(reduc);
    })

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

        /*if($("#select_vente_client").val() != 0){
            ////alert('coché');
            ////alert($("#select_vente_client option:selected").attr("data"));
            var prixReduit = parseInt($('#prixTotal').html())  - (parseInt($('#prixTotal').html())* (parseInt($("#select_vente_client option:selected").attr("name")) / 100));
            if((parseInt($('#prixTotal').html()) - prixReduit) > parseInt($("#select_vente_client option:selected").attr("data"))){
                $('#message-box-danger p').html('Taux supérieur à la limite de réduction mensuelle du client');
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 3000);
                $('#prixReduit').html($(".option_nouveauClient").val());
            }
            else{
                $('#prixReduit').html(prixReduit);
            }
        }
        else if($("#select_vente_client").val() == 0 || $(".select_client").val() != 2){
            $('#prixReduit').html($(".option_nouveauClient").val());
        }*/

    })

    $("#recherche").keyup(function (event) {
        var prixTotal = 0;
        var reduction = 0;
        /*var rowCount = $('#tab_generale_vente >tbody >tr').length;
        if(rowCount == 0){
            ////alert("vide");
            $('#prixTotal').html(0);
            $('#prixReduit').html(0);
        }
        else{
            ////alert(" ne vide pas");
        }*/
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
                            // on vérifie si un utilisateur est sélectionné
                            /*if($("#select_vente_client").val() != 0){
                                $('#recherche').val("");
                                var prixTotal1 = parseInt($('#prixTotal').html()) + parseInt(prixTotal);
                                $('#prixTotal').html(prixTotal1);
                                var prixReduit = parseInt($('#prixReduit').html()) + (parseInt(prixTotal) - (parseInt(prixTotal) * $("#select_vente_client option:selected").attr("name") / 100));
                                $('#prixReduit').html(prixReduit);
                                prixReduit = parseInt($('#prixReduit').html()) + (parseInt(prixTotal) - (parseInt(prixTotal) * reduction / 100));
                                $(".option_nouveauClient").val(prixReduit);
                            }
                            else{
                                $('#recherche').val("");
                                var prixTotal1 = parseInt($('#prixTotal').html()) + parseInt(prixTotal);
                                $('#prixTotal').html(prixTotal1);
                                var prixReduit = parseInt($(".option_nouveauClient").val()) + (parseInt(prixTotal) - (parseInt(prixTotal) * reduction / 100));
                                $('#prixReduit').html(prixReduit);
                                $(".option_nouveauClient").val(prixReduit);
                                ////alert($(".option_nouveauClient").val());
                            }*/
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

    $("#detail_recherche").keyup(function (event) {
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
    $("#recherches").keyup(function (event) {
        var prixTotal = 0;
        var reduction = 0;
        /*var rowCount = $('#tab_generale_vente >tbody >tr').length;
        if(rowCount == 0){
            ////alert("vide");
            $('#prixTotal').html(0);
            $('#prixReduit').html(0);
        }
        else{
            ////alert(" ne vide pas");
        }*/
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            //$("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                ////alert('yes');
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
                            $('#prixTotal').html(prixTotal);
                            $('#prixReduit').html(prixReduit);
                            $('#netTotal').html((prixTotal - prixReduit));

                            // on verifie si le taux est coché, si oui on le décoche en chargeant le prix réduit des produits
                            if ($("#check_reductionGenerale").is(":checked")) {
                                $('#check_reductionGenerale').prop("checked", false);
                            }
                            // on vérifie si un utilisateur est sélectionné
                            /*if($("#select_vente_client").val() != 0){
                                $('#recherche').val("");
                                var prixTotal1 = parseInt($('#prixTotal').html()) + parseInt(prixTotal);
                                $('#prixTotal').html(prixTotal1);
                                var prixReduit = parseInt($('#prixReduit').html()) + (parseInt(prixTotal) - (parseInt(prixTotal) * $("#select_vente_client option:selected").attr("name") / 100));
                                $('#prixReduit').html(prixReduit);
                                prixReduit = parseInt($('#prixReduit').html()) + (parseInt(prixTotal) - (parseInt(prixTotal) * reduction / 100));
                                $(".option_nouveauClient").val(prixReduit);
                            }
                            else{
                                $('#recherche').val("");
                                var prixTotal1 = parseInt($('#prixTotal').html()) + parseInt(prixTotal);
                                $('#prixTotal').html(prixTotal1);
                                var prixReduit = parseInt($(".option_nouveauClient").val()) + (parseInt(prixTotal) - (parseInt(prixTotal) * reduction / 100));
                                $('#prixReduit').html(prixReduit);
                                $(".option_nouveauClient").val(prixReduit);
                                ////alert($(".option_nouveauClient").val());
                            }*/
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

    $("#rechercheEntre").keyup(function (event) {
        $("#tab_GrechercheEntre").hide();
        var recherche = $(this).val();
        recherche = $.trim(recherche);
        var data = 'motclef1=' + recherche;
        if (recherche.length > 1) {
            //alert('yes');
            $.ajax({
                type: "GET",
                url: "/pharmacietest/koudjine/inc/result_entre.php",
                data: data,
                success: function (server_responce) {
                    $("#tab_GrechercheEntre").show();
                    $("#tab_BRechercheEntre").html(server_responce).show();
                    //alert(server_responce);
                }
            })
        } else {
            $("#tab_Grecherche").hide();
        }
    });
});
// Ajax
// Fonctions PHARMACIE
function load_produit(id) {

    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    }
    else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                ////alert(data);
                //$("#iconPreview .icon-preview").html(icon_preview);

                $('#tab_Bload_produit').html(server_responce);
                //$("#code").barcode(data.codebarre);


            }


        })



        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

    }

}

function load_produit_detail(id, nomp) {
    $('#detail_recherche').val(nomp);
    $("#tab_produit_detail").hide();
    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    }
    else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_detail.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                $('#tab_produit_detail_a').html(server_responce);
                $("#produit_detail_a").show();
                $("#tab_produit_detail_a").show();
                $.ajax({
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit_detail_table.php',
                    data: {
                        id: id
                    },
                    success: function (server_responce) {
                        $('#tab_produit_detail_b').html(server_responce);
                        $("#produit_detail_b").show();
                        $("#tab_produit_detail_b").show();
                    }
                })
            }


        })

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_commande_detail.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                $('#tab_produit_commande_detail_a').html(server_responce);
                $("#produit_commande_detail_a").show();
                $("#tab_produit_commande_detail_a").show();
                $.ajax({
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit_commande_detail_table.php',
                    data: {
                        id: id
                    },
                    success: function (server_responce) {
                        $('#tab_produit_commande_detail_b').html(server_responce);
                        $("#produit_commande_detail_b").show();
                        $("#tab_produit_commande_detail_b").show();
                    }
                })
            }


        })

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_stock_detail.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                $('#tab_produit_stock_detail_a').html(server_responce);
                $("#produit_stock_detail_a").show();
                $("#tab_produit_stock_detail_a").show();
                $.ajax({
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/load_produit_stock_detail_table.php',
                    data: {
                        id: id
                    },
                    success: function (server_responce) {
                        $('#tab_produit_stock_detail_b').html(server_responce);
                        $("#produit_stock_detail_b").show();
                        $("#tab_produit_stock_detail_b").show();
                    }
                })
            }


        })



        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

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
                ////alert(stock);
                //stockg = stockg-qte;
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
    $('#prixTotal').html(prixTotal);
    $('#prixReduit').html(prixReduit);
    $('#netTotal').html((prixTotal - prixReduit));
}
function focus_recherche() {
    $('#recherche').val("");
    $('#recherche').focus();
    $("#tab_Grecherche").hide();
    $("#iconPreviewVente").modal("hide");
    $('#iconPreviewVente').on('hidden.bs.modal', function () {
        ////alert('passe');
        $("#tab_BCrecherche").hide();
        $("#tab_GCrecherche").hide();
        $("#recherche").focus();
    });
}

function envoyer_en_caisse(vente_id, caisse_id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/envoyer_en_caisse.php',
        data: {
            caisse_id: caisse_id,
            vente_id: vente_id
        },
        success: function (server_responce) {
            //alert(server_responce);
            var link = '/pharmacietest/bouwou/comptabilite/caisse';
            window.location.href = link;

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
        //alert("test2");
        // vérifier qu'on a sélectionné le client existant
        $('#message-box-danger p').html('Veuillez Sélectionner le client');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);

    }
    else if ($('.select_prescripteur option:selected').text() == "Prescripteur Existant" && $("#select_vente_prescripteur option:selected").val() == 0) {
        //alert("test3");
        // vérifier qu'on a sélectionné le prescripteur existant
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
                        //count++;
                        //alert(id1);


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

                                /*if(data1.erreur == 'ok'){
                                    var link = '/pharmacietest/users/logout';
                                    ////alert(link);
                                    window.location.href = link;
                                }*/
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

function valider_facture(typePaiement, onglet, caisse_id, imprimer) {
    var telephone,montantTtc = parseInt($('#facture_caisse').html()), count = 0, rec = 0;
    var reduction = parseInt($('#facture_caisse').attr('data'));
    $('#ticketCaisse .montantpercu').html($('#' + onglet + ' .montant').val()+' ('+typePaiement+')');
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
    }else {
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
    }
    else {
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
                  alert(server_responce);
                $('#tab_vente_caisse  tr').each(function (i) {
                    count++;
                });
                $('#tab_vente_caisse  tr').each(function (i) {
                    var id1 = $(this).attr("id");
                    var qte;
                    ////alert(id1);


                    $("#" + id1 + " td").each(function (j) {
                        ////alert($(this).html());
                        if (j == 2) { qte = parseInt($(this).html()); }


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
                            //var link = '/pharmacietest/users/logout';
                            //window.location.href = link;
                            /*if(data1.erreur == 'ok'){
                                var link = '/pharmacietest/users/logout';
                                ////alert(link);
                                window.location.href = link;
                            }*/
                        }
                    })

                });


            }


        })
    }


}

function enregistrer_user(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var email = $('#email').val();
    var fonction = $('#fonction').val();
    var telephone = $('#telephone').val();
    ////alert(type);
    var reduction = $('#reduction').val();
    var reductionMax = $('#reductionMax').val();
    /*$("#magproduit").change(function () {
        v = $('#magproduit option:selected').val();
      //  alert(v);
    })*/
    //.trigger('change');
    ////alert(mag);

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_user.php',
            data: {
                nom: nom,
                prenom: prenom,
                email: email,
                fonction: fonction,
                telephone: telephone,
                reduction: reduction,
                reductionMax: reductionMax
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/pharmanet/user/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_user.php',
            data: {
                nom: nom,
                prenom: prenom,
                email: email,
                fonction: fonction,
                telephone: telephone,
                reduction: reduction,
                reductionMax: reductionMax,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/pharmanet/user/';
                    //var link = '/pharmacietest/bouwou/pharmanet/useradd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/pharmanet/employe/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    }
    else {
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
                }
                else {
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
            $('ul.dropdown-menu ').append(data);
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/charger_select_produit1.php',
                data: {
                    nom: nom
                },
                success: function (data) {
                    $('#produits').append(data);
                    //alert(data);

                }
            })

        }
    })
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
    prod = newprod
    //alert(prod)
    /*$("#magproduit").change(function () {
        v = $('#magproduit option:selected').val();
      //  alert(v);
    })*/
    //.trigger('change');
    ////alert(mag);

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
                    var link = '/pharmacietest/bouwou/catalogue/produit/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    }
    else {
        ////alert('test');
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
                    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
                    window.location.href = link;
                }
                else {
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

function enregistrer_assureur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var taux = $('#taux').val();
    var CodePostal_id = $('#CodePostal_id').val();
    var telephone = $('#telephone').val();
    /*$("#magassureur").change(function () {
        v = $('#magassureur option:selected').val();
      //  alert(v);
    })*/
    //.trigger('change');
    ////alert(mag);

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
                    var link = '/pharmacietest/bouwou/catalogue/assureur/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/catalogue/assureuradd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/catalogue/categorie/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/catalogue/categorieadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/catalogue/commande/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                }
                else {
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
                    var link = '/pharmacietest/bouwou/catalogue/client/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/codepostal/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/catalogue/fabriquant/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/catalogue/fabriquantadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/forme/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/formeadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/catalogue/fournisseur/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/catalogue/fournisseuradd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/magasin/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/magasinadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/catalogue/prescripteur/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/catalogue/prescripteuradd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/ville/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/villeadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/unite/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/uniteadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/rayon/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {

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
                    var link = '/pharmacietest/bouwou/geonetliste/rayonadd/' + id;
                    window.location.href = link;
                }
                else {
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
                    var link = '/pharmacietest/bouwou/geonetliste/en_rayon/';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {

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
                    var link = '/pharmacietest/bouwou/geonetliste/en_rayonadd/' + id;
                    window.location.href = link;
                }
                else {
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


// FIN

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
    ////alert("passe");

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
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);
                }
            }
        });
    }
    else if (option == 'Modifier') {
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
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);

                }
            }
        });
    }
    else {
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
                }
                else {
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

function afterSuccess() {
    $('#submit-btn').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit() {

    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        if (!$('#img_presentation').val() || !$('#logo').val()) //check empty input filed
        {
            /*$("#output").html("Are you kidding me?");
            $('.alert').removeClass('hidden');
            return false*/
        }

        if ($('#img_presentation').val()) {
            var fsize = $('#img_presentation')[0].files[0].size; //get file size
            var ftype = $('#img_presentation')[0].files[0].type; // get file type


            //allow only valid image file types
            switch (ftype) {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
                    break;
                default:
                    $("#output").html("<b>" + ftype + "</b> Unsupported file type!");
                    $('.alert').removeClass('hidden');
                    return false
            }

            //Allowed file size is less than 2 MB (1048576*2)
            if (fsize > (1048576 * 2)) {
                $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                $('.alert').removeClass('hidden');
                return false
            }

        }
        if ($('#logo').val()) {
            var fsize2 = $('#logo')[0].files[0].size; //get file size
            var ftype2 = $('#logo')[0].files[0].type; // get file type


            //allow only valid image file types
            switch (ftype2) {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
                    break;
                default:
                    $("#output").html("<b>" + ftype2 + "</b> Unsupported file type!");
                    $('.alert').removeClass('hidden');
                    return false
            }

            //Allowed file size is less than 2 MB (1048576*2)
            if (fsize2 > (1048576 * 2)) {
                $("#output").html("<b>" + bytesToSize(fsize2) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                $('.alert').removeClass('hidden');
                return false
            }


        }

        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
        $('.alert').removeClass('hidden');


    }
    else {
        //Output error to older browsers that do not support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        $('.alert').removeClass('hidden');
        return false;
    }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
function fileBrowser(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: 'http://google.cm',
        title: 'Gallerie',
        width: 420,
        height: 400,
        resizable: 'yes',
        inline: 'no',
        close_previous: 'no'
    }, {
        window: win,
        input: field_name
    });
    return false;
}
function change_input(option, id) {
    if (option == 'plus') {
        if ($("#" + id).val() == '' || $("#" + id).val() == null)
            $("#" + id).val(1);
        else
            $("#" + id).val(parseInt($("#" + id).val()) + 1);
    }
    else {
        if (parseInt($("#" + id).val()) != 0)
            $("#" + id).val(parseInt($("#" + id).val()) - 1);
    }
    var prixTotal = 0, qte, prix;
    $("#tab_produit_commande tr").each(function (j) {

        var id = $(this).attr("id");
        if (parseInt($("#inputQteRecu" + id).val()) != 0) {
            prixTotal = prixTotal + (parseInt($("#inputQteRecu" + id).val()) * parseInt($("#prixCmd" + id).val()))
        }
        $('#facture_commande').html(prixTotal);
    })
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

function imprimer_bon_caisse() {
    $("#previewImprimerBonCaisse").modal('show');
}

function showVenteCaisse(id) {
    alert(id);
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
    })
    $("#previewImprimerBonCaisse").modal('show');
    return false;
}

