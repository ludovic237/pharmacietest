$(document).ready(function(){
    $("#tab_Grecherche").hide();
    $(".contenu").show();

    $("#parent").change(function () {

        if($("#parent option:selected").val() != 0){
            $("#contenu").val($("#parent option:selected").attr("data"));
        }else{
            //$("#tab_Bsortie").empty();
            $("#contenu").val('');
        }
    })
    $("#recherche_parent").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            //$("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                //alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result_sortie_parent.php",
                    data: {
                        motclef: $(this).val(),
                        id_detail: $("#recherche").attr("data2")
                    },
                    dataType: 'json',
                    success: function (data) {
                        ////alert(data);
                        if (data.erreur == 'non') {
                            var action = 0;
                            $('#tab_Bsortie  tr').each(function (i) {
                                var id1 = $(this).attr("id");
                                var qte;
                                if (id1 == recherche) {
                                    action = 1;
                                    $("#" + id1 + " td").each(function (j) {
                                        ////alert($(this).html());
                                        if (j == 1) { qte = parseInt($(this).html()) + 1; }
                                        if (j == 3) {
                                            var stock = parseInt($(this).html());
                                            if (stock == 0) {
                                                //  alert("Quantité en stock pas suffisante pour cette opération ");
                                            } else {
                                                $("#" + id1 + " td").each(function (k) {
                                                    if (k == 1) { $(this).html(qte); }

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
                                    + '<td class="qte">' + 1 + '</td>'
                                    + '<td class="contenu">' + data.contenu + '</td>'
                                    + '<td>' + data.stock + '</td>'
                                    + '<td>' + data.datel + '</td>'
                                    + '<td>'
                                    + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row_vente(\'' + recherche + '\');"><span class="fa fa-times"></span></button>'
                                    + '</td>'
                                    + '</tr>';
                                $('#tab_Bsortie').prepend(cat);
                            }

                        } /*else if (data.find == 'non') {
                            load_produit(data.id);
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
                        }*/
                        else {
                            $('#message-box-danger p').html(data.erreur);
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
                        }
                        $('#recherche_parent').val("");

                        $('#tab_Bsortie  tr').each(function (i) {
                            var id1 = $(this).attr("id");
                            var contenu, qte, total = 0;
                            ////alert(id1);
                            $("#" + id1 + " td").each(function (j) {
                                ////alert($(this).html());
                                if (j == 1) { qte = parseInt($(this).html()); }
                                if (j == 2) { contenu = parseInt($(this).html()); }

                            });
                            total = total + (qte * contenu);
                            $("#stock_detail").val((total + parseInt($("#stock_detail").attr("data"))));
                        });


                    }
                })
            } else {
                //$("#resultat ul").empty();
            }
        }
    })
    $("#recherche").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var link = '/pharmacietest/bouwou/comptabilite/sortie/'+recherche;
            window.location.href = link;
        }
        else {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef1=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result_sortie.php",
                    data: {
                        motclef1: recherche,
                        action: $(this).attr("data1")
                    },
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


});
function valider_produit_sortie() {
    $('#tab_Bsortie  tr').each(function (i) {
        var id1 = $(this).attr("id");
        var qte = parseInt($("#" + id1 + " .qte").html());
        var contenu = parseInt($("#" + id1 + " .contenu").html());
        ////alert(qte);
        if(qte != 0){
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/enregistrer_sortie_stock.php',
                data: {
                    id: id1,
                    qte: qte,
                    contenu: contenu,
                    detail_id:$("#recherche").attr('data')
                },
                success: function (server_responce) {
                    //alert(server_responce);
                    var link = '/pharmacietest/bouwou/comptabilite/sortie';
                    window.location.href = link;


                }


            })
        }


    });
}
function valider_sortie() {
    var qteT = parseInt($("#qte_sortie").val());
    //alert(qteT);
    if(false){
        $('#message-box-danger p').html('Veuillez Entrer une quantité valide !!!');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);
    } else {
        if($("#choix option:selected").val() == 1){
            var qte_total = 0, statut = 1;
            $('#tab_Bsortie  tr').each(function (i) {
                var id1 = $(this).attr("id");
                var qte = parseInt($("#" + id1 + " .qte").val());
                var qterest = parseInt($("#" + id1 + " .qterest").html());
                if (qte > qterest) {
                    statut = 0;
                    //alert("Quantité en stock pas suffisante pour cette opération ");
                    $('#message-box-danger p').html('Quantité en stock pas suffisante pour cette opération');
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 6000);
                }
                qte_total = qte_total + qte;
            })
            if(qte_total == qteT && statut == 1 && $('#contenu').val() != ''){
                $('#tab_Bsortie  tr').each(function (i) {
                    var id1 = $(this).attr("id");
                    var qte = parseInt($("#" + id1 + " .qte").val());
                    var contenu = parseInt($("#" + id1 + " .contenu").html());
                    ////alert(qte);
                    if(qte != 0){
                        $.ajax({
                            type: "POST",
                            url: '/pharmacietest/koudjine/inc/enregistrer_sortie_stock.php',
                            data: {
                                id: id1,
                                qte: qte,
                                contenu: contenu,
                                detail_id:$("#recherche").attr('data')
                            },
                            success: function (server_responce) {
                                //alert(server_responce);
                                var link = '/pharmacietest/bouwou/comptabilite/sortie';
                                window.location.href = link;


                            }


                        })
                    }


                });
            }else{
                $('#message-box-danger p').html("Veuillez vérifier que la quantité saisie et les quantités du tableau correspondent \n Vérifier aussi que 'Contenu' n'est pas vide !!!");
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 6000);
            }
        }else{
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/enregistrer_sortie_stock.php',
                data: {
                    id: $("#recherche").attr('data'),
                    qte: qteT,
                    detail_id:null
                },
                success: function (server_responce) {
                    //alert(server_responce);
                    var link = '/pharmacietest/bouwou/comptabilite/sortie';
                    window.location.href = link;

                }
            })
        }
    }
}
function load_produit(id, action) {
    //alert(id)

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_sortie.php',
            data: {
                id: id,
                action: action
            },
            success: function (server_responce) {
                
                $('#tab_Bload_produit').html(server_responce);
                //$("#code").barcode(data.codebarre);


            }


        })
        $("#iconPreviewVente").modal("show");

}
function load_produit_parent() {
    //alert(id)
    if($("#qte_sortie").val() == '' || $("#parent option:selected").val() == 0){
        alert('Veuillez entrer la quantité ou sélectionner une parent !!!');
    }else{
        var id = $("#parent option:selected").val();

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_sortie.php',
            data: {
                id: id,
                action: 'sortie1'
            },
            success: function (server_responce) {

                $('#tab_Bload_produit_sortie').html(server_responce);
                //$("#code").barcode(data.codebarre);

            }


        })
        $("#iconPreviewSortie").modal("show");
    }


}
function valider_stock_detail(id) {
    //alert('passe');
    $("#iconPreviewSortie").modal("hide");

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/charger_sortie_produit.php',
            data: {
                id: id,
                qte: $("#qte_sortie").val()
            },
            dataType: 'json',
            success: function (data) {
                //$("#tab_Bsortie").empty();
                //alert(data);
                var total = 0;

                if (data.erreur == 'non') {
                    var action = 0;
                    $('#tab_Bsortie  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        var qte;
                        if (id1 == id) {
                            action = 1;
                            $("#" + id1 + " td").each(function (j) {
                                ////alert($(this).html());
                                if (j == 1) { qte = parseInt($(this).html()) + parseInt($("#qte_sortie").val()); }
                                if (j == 3) {
                                    var stock = parseInt($(this).html());
                                    if (stock == 0) {
                                        //  alert("Quantité en stock pas suffisante pour cette opération ");
                                    } else {
                                        $("#" + id1 + " td").each(function (k) {
                                            if (k == 1) { $(this).html(qte); }

                                        });
                                        $(this).html((stock - parseInt($("#qte_sortie").val())));
                                    }
                                }

                            });
                        }

                    });
                    if (action == 0) {
                        var cat = '<tr id="' + id + '">'
                            + ' <td><strong>' + data.nom + '</strong></td>'
                            + '<td class="qte">' + parseInt($("#qte_sortie").val()) + '</td>'
                            + '<td class="contenu">' + data.contenu + '</td>'
                            + '<td>' + data.stock + '</td>'
                            + '<td>' + data.datel + '</td>'
                            + '<td>'
                            + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row_vente(\'' + id + '\');"><span class="fa fa-times"></span></button>'
                            + '</td>'
                            + '</tr>';
                        $('#tab_Bsortie').prepend(cat);
                        /*total = total + (parseInt($("#qte_sortie").val()) * data.contenu);
                        $("#stock_detail").val((total + parseInt($("#stock_detail").attr("data"))));*/
                    }

                } /*else if (data.find == 'non') {
                            load_produit(data.id);
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
                        }*/
                else {
                    $('#message-box-danger p').html(data.erreur);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);
                    $('#recherche').val("");
                    $("#tab_Grecherche").hide();
                }
                /*$('#recherche_parent').val("");
                $("#tab_Bsortie").prepend(data);*/
                $("#contenu").val('');
                $("#qte_sortie").val('');
                $('#parent option[value="0"]').prop('selected', true);
                //$("#parent").setSelected(0);
                $('#tab_Bsortie  tr').each(function (i) {
                    var id1 = $(this).attr("id");
                    var contenu, qte, total = 0;
                    ////alert(id1);
                    $("#" + id1 + " td").each(function (j) {
                        ////alert($(this).html());
                        if (j == 1) { qte = parseInt($(this).html()); }
                        if (j == 2) { contenu = parseInt($(this).html()); }

                    });
                    total = total + (qte * contenu);
                    $("#stock_detail").val((total + parseInt($("#stock_detail").attr("data"))));
                });
            }
        })
}

