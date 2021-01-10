var test = 0;
var startDate;
var endDate;
var idemploye = null
    ;
var idfulldepense;

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

    idfulldepense = idfulldepense;
    if (idfulldepense!=null) {
        load_depense_info(idfulldepense);
    }
    
});


function load_produit(id) {

    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    }
    else {
        alert(id);
        if ($.fn.dataTable.isDataTable('#tab_load_produit')) {
            $('#tab_load_produit').dataTable({
                destroy: true,
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

function load_depense_info(id) {
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/add_full_depense.php",
        data: {
            id: id,
            type: "modify"
        },
        dataType: 'json',
        success: function (data) {
            //alert(data.depense_objet);
            $('#depense_type').val(data.depense_type);
            $('#depense_quantite').val(data.depense_quantite);
            $('#depense_prixunitaire').val(data.depense_prixunitaire);
            $('#depense_objet').val(data.depense_objet);
            $('#depense_remis').val(data.depense_remis);
            $('#depense_lieu').val(data.depense_lieu);
            $('#depense_societe').val(data.depense_societe);
            $('#depense_datedepense').val(data.depense_datedepense);
            $('#depense_date').val(data.depense_date);
            $('#depense_cni').val(data.depense_cni);
        }
    })
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