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
                                    + '<button class="btn btn-primary btn-rounded btn-sm ajouter_inventaire" onClick="ajouter_row_inventaire(\'' + recherche + '\');">Ajouter</span></button>'
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
function ajouter_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'ajouter',
            id: id,
            qte: $("#" + id + " .qte_inventaire").val()
        },
        success: function (server_responce) {
            alert(server_responce);
            //$('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
        }
    })
}



