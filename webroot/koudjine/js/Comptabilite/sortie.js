$(document).ready(function(){
    $("#tab_Grecherche").hide();
    $(".contenu").hide();
    $("#choix").change(function () {

        if ($("#choix").val() == 1) {
            ////alert('coché');
            $(".contenu").show();
        }
        else {
            $(".contenu").hide();
        }
    })
    $("#parent").change(function () {

        if($("#parent option:selected").val() != 0){
            $("#contenu").val($("#parent option:selected").attr("data"));
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/charger_sortie_produit.php',
                data: {
                    id: $("#parent option:selected").val()
                },
                success: function (data) {
                    $("#tab_Bsortie").empty();
                    $("#tab_Bsortie").prepend(data);

                }
            })
        }else{
            $("#tab_Bsortie").empty();
            $("#contenu").val('');
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


});
function valider_sortie() {
    var qteT = parseInt($("#qte_sortie").val());
    //alert(qteT);
    if($("#qte_sortie").val() == '' || !$.isNumeric(qteT)){
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
                    var qterest = parseInt($("#" + id1 + " .qterest").html());
                    ////alert(qte);
                    if(qte != 0){
                        $.ajax({
                            type: "POST",
                            url: '/pharmacietest/koudjine/inc/enregistrer_sortie_stock.php',
                            data: {
                                id: id1,
                                qte: qte,
                                contenu: parseInt($('#contenu').val()),
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
function load_produit(id) {
    //alert(id)

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/load_produit_sortie.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                
                $('#tab_Bload_produit').html(server_responce);
                //$("#code").barcode(data.codebarre);


            }


        })
        $("#iconPreviewVente").modal("show");

}

