$(document).ready(function(){
    //$("#div_inventaire").hide();

    $("#recherche_inventaire").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
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
                            $('#tab_BIinventaire  tr').each(function (i) {
                                var id1 = $(this).attr("id");
                                if (id1 == recherche) {
                                    action = 1;
                                    if($("#" + id1 + " .valider_inventaire").attr("disabled") == "disabled"){
                                        $('#message-box-danger p').html("Ce produit a déjà été inventorié, veuillez contacter l'administrateur pour toute modification !!!");
                                        $("#message-box-danger").modal("show");
                                        setTimeout(function () {
                                            $("#message-box-danger").modal("hide");
                                        }, 5000);
                                    }
                                }

                            });
                            $('#tab_Binventaire  tr').each(function (i) {
                                var id1 = $(this).attr("id");
                                if (id1 == recherche) {
                                    action = 1;
                                    if($("#" + id1 + " .valider_inventaire").attr("disabled") == "disabled"){
                                        $('#message-box-danger p').html("Ce produit a déjà été inventorié, veuillez contacter l'administrateur pour toute modification !!!");
                                        $("#message-box-danger").modal("show");
                                        setTimeout(function () {
                                            $("#message-box-danger").modal("hide");
                                        }, 5000);
                                    }else
                                        $("#" + id1 + " .qte_inventaire").val(parseInt($("#" + id1 + " .qte_inventaire").val() )+ 1);
                                }

                            });
                            if (action == 0) {
                                var cat = '<tr id="' + recherche + '">'
                                    + ' <td><strong>' + data.nom + '</strong></td>'
                                    + '<td>' + data.prix + '</td>'
                                    + '<td class="qte_restante">' + data.quantiteRestante + '</td>'
                                    + '<td class="qte_restante">' + data.quantiteRestante + '</td>'
                                    + '<td>' + data.datel + '</td>'
                                    + '<td>' + $("#recherche_inventaire").attr("data1")+ '</td>'
                                    + '<td><input class=\'qte_inventaire\' style="width: 50px;" type="number" value=\'1\'></td>'
                                    + '<td>'
                                    + '<button class="btn btn-success btn-rounded btn-sm valider_inventaire" onClick="valider_row_inventaire(\'' + recherche + '\');">Valider</span></button>'
                                    + '</td>'
                                    + '</tr>';
                                $('#tab_Binventaire').prepend(cat);
                                if($("#recherche_inventaire").attr("name") != 'Administrateur'){
                                    $('.ajouter_inventaire').hide();
                                }
                            }

                            $('#recherche_inventaire').val("");
                            $("#div_inventaire").show();
                            $('#recherche_inventaire').focus();

                        }
                        else {
                            $('#message-box-danger p').html(data.erreur);
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                            $('#recherche_inventaire').val("");
                        }


                    }
                })
            }
        }
    })
});

function valider_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'creer',
            id: id,
            qte: $("#" + id + " .qte_inventaire").val(),
            employe_id: $("#recherche_inventaire").attr("data"),
            qteRestante: parseInt($("#" + id + " .qte_restante").html())
        },
        success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function validers_row_inventaire() {
    $('#tab_Binventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");

            if($("#" + id1 + " .valider_inventaire").attr("disabled") != "disabled"){
                valider_row_inventaire(id1);
            }

    });
}
function inventorier_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'creer',
            id: id,
            qte: 0,
            employe_id: $("#recherche_inventaire").attr("data"),
            qteRestante: 0
        },
        success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .inventorier_inventaire').attr("disabled", "disabled");
            $('#' + id + ' .exclure_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function inventoriers_row_inventaire() {
    $('#tab_BNIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");

        if($("#" + id1 + " .inventorier_inventaire").attr("disabled") != "disabled"){
            inventorier_row_inventaire(id1);
        }

    });
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function exclure_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/exclure_inventaire.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .exclure_inventaire').attr("disabled", "disabled");
            $('#' + id + ' .inventorier_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function exclures_row_inventaire() {
    $('#tab_BNIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");
        //alert(id1);
        //if(id1 == '')
        if($("#" + id1 + " .exclure_inventaire").attr("disabled") != "disabled"){
            //alert('paasa');
            exclure_row_inventaire(id1);
        }

    });
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function ajouter_inventaire(id) {
    $("#quantiteajoute").attr("data", id);
    $("#iconPreviewInventaire").modal("show");
}
function ajouter_row_inventaire() {
    var id = $("#quantiteajoute").attr("data");
    var qte = parseInt($("#quantiteajoute").val());
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'ajouter',
            id: id,
            qte: qte
        },
        success: function (server_responce) {
            //alert(id);
            var val = ''+id;
            //alert($('#'+ id + ' .qteinventaire').html());
            //$('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
            $("#iconPreviewInventaire").modal("hide");
            var link = '/pharmacietest/bouwou/stock/inventaire';
            window.location.href=link;
            //$("#"+id+" .qtevalide").html(parseInt($("#"+id+" .qtevalide").html())+ qte);
        }
    })
}
function charger_inventaire() {
    id= $('#select_inventaire').val();
    var link = '/pharmacietest/bouwou/stock/inventaire/'+id;
    window.location.href=link;
}


