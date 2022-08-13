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
                    success: function (data) {
                        //alert(data);
                        $('#tab_RetourProduit_Retourne').empty();
                        $("#tab_RetourProduit_Achete").empty();
                        $('#search-reference-produit').val('');
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
    var prixTotal = 0, prixReduit = 0, nom = $("#R" + en_rayon_id + " .nom").html();
    //alert(qte);
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
        + '<td>' + (reduc/qte) + '</td>'
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
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/enregistrer_retour.php",
        data: {
            idVente: $("#search-reference-produit").attr("data"),
            idEmp: employe_id
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
                    success: function (data) {
                        //alert(data);
                        $('#tab_RetourProduit_Retourne').empty();
                        $("#tab_RetourProduit_Achete").empty();
                        $('#search-reference-produit').val('');
                        $("#prixTotal").html("0");
                        $("#prixReduit").html("0");
                        $("#netTotal").html("0");

                    }
                })
            })

        }
    })
}

function loadListProduitRetour() {

    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/list_retour_produit.php",
        data: {
            id: 18
        },
        dataType: "json",
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
                    {data: "dateRetour"},
                    {data: "caisse_id"},
                    {data: "list"},
                    {data: "quantite_total_produitRetour"},
                    {data: "prix"},
                ]
            });

        }
    })
}