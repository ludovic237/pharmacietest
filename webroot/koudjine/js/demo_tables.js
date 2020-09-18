$(document).ready(function () {


    $(".argent").keyup(function (event) {
        ////alert($(this).val())
        var total = ($("#argent_1").val() * 500) + ($("#argent_2").val() * 10000) + ($("#argent_3").val() * 100) + ($("#argent_4").val() * 5000) + ($("#argent_5").val() * 50) + ($("#argent_6").val() * 2000) + ($("#argent_7").val() * 25) + ($("#argent_8").val() * 1000) + ($("#argent_9").val() * 10) + ($("#argent_10").val() * 500)
        var soustotal1 = ($("#argent_1").val() * 500) + ($("#argent_3").val() * 100) + ($("#argent_5").val() * 50) + ($("#argent_7").val() * 25) + ($("#argent_9").val() * 10)
        var soustotal2 = ($("#argent_2").val() * 10000) + ($("#argent_4").val() * 5000) + ($("#argent_6").val() * 2000) + ($("#argent_8").val() * 1000) + ($("#argent_10").val() * 500)
        $('.totalaisse').html(total);
        $('.soustotalaisse1').html(soustotal1);
        $('.soustotalaisse2').html(soustotal2);


    })
    $(".fargent").keyup(function (event) {
        ////alert($(this).val())
        var total = ($("#fargent_1").val() * 500) + ($("#fargent_2").val() * 10000) + ($("#fargent_3").val() * 100) + ($("#fargent_4").val() * 5000) + ($("#fargent_5").val() * 50) + ($("#fargent_6").val() * 2000) + ($("#fargent_7").val() * 25) + ($("#fargent_8").val() * 1000) + ($("#fargent_9").val() * 10) + ($("#fargent_10").val() * 500)
        var soustotal1 = ($("#fargent_1").val() * 500) + ($("#fargent_3").val() * 100) + ($("#fargent_5").val() * 50) + ($("#fargent_7").val() * 25) + ($("#fargent_9").val() * 10)
        var soustotal2 = ($("#fargent_2").val() * 10000) + ($("#fargent_4").val() * 5000) + ($("#fargent_6").val() * 2000) + ($("#fargent_8").val() * 1000) + ($("#fargent_10").val() * 500)
        $('.ftotalaisse').html(total);
        $('.fsoustotalaisse1').html(soustotal1);
        $('.fsoustotalaisse2').html(soustotal2);


    })
    $('#iconPreviewCaisse').on('hidden.bs.modal', function () {
        ////alert('passe');
        $("#iconPreviewCaisse").modal("show");
    })
    $('#iconPreviewCaisseFermer').on('hidden.bs.modal', function () {
        ////alert('passe');
        $("#iconPreviewCaisseFermer").modal("show");
    })
});

function close_caisse_row() {
    $("#iconPreviewCaisseFermer").modal("show");
    ////alert("session");
    /*$(".argent").keyup(function (event) {
        var detail_piece_billet = '($("#argent_1").val()*500)' + '($("#argent_2").val()*10000)' + '($("#argent_3").val()*100)' + '($("#argent_4").val()*5000)' + '($("#argent_5").val()*50)' + '($("#argent_6").val()*2000)' + '($("#argent_7").val()*25)' + '($("#argent_8").val()*1000)' + '($("#argent_9").val()*10)' + '($("#argent_10").val()*500)';

        var session = $('.session').html();
        //alert(detail_piece_billet)

    })*/

}

function close_caisse_row_valide(user_id) {
    ////alert("session");
    var total = parseInt($('.totalaisse').html());
    var detail_piece_billet = ($("#argent_1").val()) + "-" + ($("#argent_2").val()) + "-" + ($("#argent_3").val()) + "-" + ($("#argent_4").val()) + "-" + ($("#argent_5").val()) + "-" + ($("#argent_6").val()) + "-" + ($("#argent_7").val()) + "-" + ($("#argent_8").val()) + "-" + ($("#argent_9").val()) + "-" + ($("#argent_10").val());
    var session = $('.session option:selected').text();
    //var totals1 = $('.soustotalaisse1').val();
    //var totals2 = $('.soustotalaisse2').val();
    ////alert(session);
    ////alert(detail_piece_billet);
    ////alert( totals1);
    ////alert(session + "-" + detail_piece_billet + "-" + totals1 + "-" + totals2 + "-" +  total);
    //var dateOuvert    = now.getDate();
    if (total == 0) {
        //alert("Veuillez saisir votre fond de caisse")
    } else {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_session_caisse.php',
            data: {
                user_id: user_id,
                ouvertureCaisse:detail_piece_billet,
                session:session,
                fondCaisse:total,
                etat:"Ouvert",
            },
            success: function (server_responce) {

                ////alert(server_responce);
                var link = '/pharmacietest/bouwou/comptabilite/caisse';
                window.location.href = link;

            }
        });
    }


}

function valider_fermeture(caisse_id) {
    var total = parseInt($('.ftotalaisse').html());
    var detail_piece_billet = ($("#fargent_1").val()) + "-" + ($("#fargent_2").val()) + "-" + ($("#fargent_3").val()) + "-" + ($("#fargent_4").val()) + "-" + ($("#fargent_5").val()) + "-" + ($("#fargent_6").val()) + "-" + ($("#fargent_7").val()) + "-" + ($("#fargent_8").val()) + "-" + ($("#fargent_9").val()) + "-" + ($("#fargent_10").val());
    //var session = $('.session option:selected').text();
    //var totals1 = $('.soustotalaisse1').val();
    //var totals2 = $('.soustotalaisse2').val();
    ////alert(session);
    ////alert(detail_piece_billet);
    ////alert( totals1);
    ////alert(session + "-" + detail_piece_billet + "-" + totals1 + "-" + totals2 + "-" +  total);
    //var dateOuvert    = now.getDate();
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
                fermetureCaisse:detail_piece_billet,
                fondCaisse:total,
            },
            success: function (server_responce) {

                //alert(server_responce);
                var link = '/pharmacietest/users/logout';
                window.location.href = link;

            }
        });
    }

}
function rafraichir_vente(id) {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/rafraichir_vente.php',
            data: {
                id: id
            },
            success: function (server_responce) {
                ////alert(server_responce);
                //$("#iconPreview .icon-preview").html(icon_preview);

                $('#tab_caisse').empty();
                $('#tab_caisse').html(server_responce);

            }


        })


}
function charger_vente(id) {
    $("#facture_caisse").html($("#"+id+" .prixtotal").html());
    $("#facture_caisse").attr("data", $("#"+id+" .reduction").html());
    $('#fen_facture').attr("data", id);
    //$("#"+id).addClass("alt");
    $('#tab1 .montant').val('');
    $('#tab1 .reste').val('');
    $('#ticket .reference').html($("#"+id+" .reference").html());
    $('#ticket .datevente').html($("#"+id+" .date").html());
    $('#ticket .heurevente').html($("#"+id+" .heure").html()); 
    $('#ticket .vendeur').html($("#"+id+" .vendeur").html());
    $('#ticket .acheteur').html($("#"+id+" .client").html());
    $('#ticket .netapayer').html($("#"+id+" .prixtotal").html());
    $('#ticket .remise').html($("#"+id+" .reduction").html());
    $('#ticket .montanttotal').html(parseInt($("#"+id+" .reduction").html()) + parseInt($("#"+id+" .prixtotal").html()));



    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            ////alert(server_responce);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#tab_vente_caisse').empty();
            $('#tab_vente_caisse').html(server_responce);
            $('#tab_BfactureImprimer').prepend(server_responce);

        }


    })


}

function update_row_produit(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
    //alert(link);
    window.location.href = link;
}


function update_row_user(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/pharmanet/useradd/' + id;
    //alert(link);
    window.location.href = link;
}


function update_row_employe(int) {
    //alert("link");
    var link = '/pharmacietest/bouwou/pharmanet/employeadd/' + int;
    //alert(link);
    window.location.href = link;
}
function update_row_assureur(id) {
    var link = '/pharmacietest/bouwou/catalogue/assureuradd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_categorie(row) {

    var nom;
    // var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        // if (i == 1) {  
        //     code = $(this).html();
        // }

    });
    
    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    // $('#code').val(code);
    // var link = '/pharmacietest/bouwou/catalogue/categorieadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}
function update_row_client(id) {
    var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_fabriquant(id) {
    var link = '/pharmacietest/bouwou/catalogue/fabriquantadd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_fournisseur(id) {
    var link = '/pharmacietest/bouwou/catalogue/fournisseuradd/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_prescripteur(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/catalogue/prescripteuradd/' + id;
    //alert(link);
    window.location.href = link;
}
function update_row_codepostal(id) {
    var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
    ////alert(link);
    window.location.href = link;
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
    // var link = '/pharmacietest/bouwou/geonetliste/formeadd/' + id;
    // ////alert(link);
    // window.location.href = link;
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
    // var link = '/pharmacietest/bouwou/geonetliste/magasinadd/' + id;
    // ////alert(link);
    // window.location.href = link;
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
    // var link = '/pharmacietest/bouwou/geonetliste/rayonadd/' + id;
    // ////alert(link);
    // window.location.href = link;
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
    // var link = '/pharmacietest/bouwou/geonetliste/villeadd/' + id;
    // ////alert(link);
    // window.location.href = link;
}


function delete_row(row, controller, table, confirmation) {

    if (confirmation) {
        $("#" + row).hide("slow", function () {
            var link = '/pharmacietest/bouwou/' + controller + '/delete/' + row + '/' + table;
            ////alert(link);
            /*$.ajax({

                url: link,

                success: function (data) {
                    ////alert(data);
                    //$("#iconPreview .icon-preview").html(icon_preview);
                    $(this).remove();
                }

            })*/

        });
    }
    else {
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

function delete_row_filiere(row, action) {


    var box = $("#mb-remove-row");
    box.addClass("open");

    box.find(".mb-control-yes").on("click", function () {
        box.removeClass("open");
        $("#" + row).hide("slow", function () {
            var link = '/Site/bouwou/formations/delete/' + row + '/' + action;
            ////alert(link);
            $.ajax({

                url: link,

                success: function (data) {
                    ////alert(data);
                    //$("#iconPreview .icon-preview").html(icon_preview);
                    $(this).remove();
                }

            })

        });
    });

}
function delete_row_vente(id) {
    var total;
    var total1 = null;
    var reduction;
    // on verifie si le taux est coché, si oui on le décoche en chargeant le prix réduit des produits
    if($("#check_reductionGenerale").is(":checked")){
        $('#check_reductionGenerale').prop("checked", false);
    }

    $("#"+id+" td").each(function(i){
        ////alert(i);
        if(i==3) {total = parseInt($(this).html());}
        if(i==4)  reduction = parseInt($(this).html());

    });

    $("#"+id ).remove();

    /*$("#"+id+" td").each(function(i){
        ////alert(i);
        if(i==3) {total1 = $(this).html();}
        if(i==4)  reduction = $(this).html();

    });*/
        if(total1 == null){
            var prixTotal = 0;
            var prixReduit = 0;
            $('#tab_vente  tr').each(function(i){
                var id1 = $(this).attr("id");
                var prix,qte;
                ////alert(id1);

                $("#"+id1+" td").each(function(j){
                    ////alert($(this).html());
                    if(j==1) { prix = parseInt($(this).html());}
                    if(j==2) { qte = parseInt($(this).html()); prixTotal = prixTotal + (prix*qte);}
                    if(j==4) {
                        var reduction = parseInt($(this).attr("data"));
                        if($("#select_vente_client").val() == 0 || $(".select_client").val() !=2 ){
                            reduction = 0;
                        }else{
                            if($("#select_vente_client option:selected").attr("name") >= reduction){
                                //reduction = reduction;

                            }
                            else {
                                reduction = parseInt($("#select_vente_client option:selected").attr("name"));
                            }
                        }

                        prixReduit = prixReduit + ((prix*qte)*reduction /100);
                    }

                });

            });
            if($("#select_vente_client").val() != 0){
                //var prixReduit = parseInt($('#prixTotal').html())  - (parseInt($('#prixTotal').html())* (parseInt($("#select_vente_client option:selected").attr("name")) / 100));
                if(prixReduit > parseInt($("#select_vente_client option:selected").attr("data"))){
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

function update_row(row) {

    var nom;
    var sigle;
    var description;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) { nom = $(this).children().html(); }
        if (i == 1) sigle = $(this).html();
        if (i == 2) description = $(this).html();
    });
    ////alert(nom);
    $('.titre').html('Modifier une faculté');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.sigle').children().val(sigle);
    $('.description').children().val(description);




}
// function update_row_categorie(row) {

//     var nom;
//     var description;
//     $("#" + row + " td").each(function (i) {
//         ////alert(i);
//         if (i == 0) { nom = $(this).children().html(); }
//         if (i == 2) description = $(this).html();
//     });
//     $("#form3").scroll('slow');
//     ////alert(nom);
//     $('.titre').html('Modifier une categorie');
//     $('.button').html('Modifier');
//     $('.button').attr('href', row);
//     $('.name').children().val(nom);
//     $('.description').children().val(description);




// }
function update_row_type(row) {

    var nom;
    var description;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) description = $(this).html();
        if (i == 3) {
            certif = $(this).children().html();
        }
    });
    ////alert(nom);
    $('.titre').html('Modifier un type d\'université');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.description').children().val(description);
    if (certif == 'En attente') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '1');

    }
    else {

        $('.selectpicker').selectpicker('val', '0');
        //$('.selectpicker').val('Certifié');
        //$('.selectpicker').selectpicker('render');
    }
}
function update_row_question(row) {

    var question;
    var type;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 1) {
            question = $(this).children().html();
        }
        if (i == 2) {
            type = $(this).html();
        }
    });
    ////alert(nom);
    $('.titre').html('Modifier une question');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.question').children().val(question);
    if (type == 'General') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '0');

    } else if (type == 'Personnalite') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '1');

    }
    else {

        $('.selectpicker').selectpicker('val', '2');
    }
}

function update_row_univ(id) {
    var link = '/Site/bouwou/universites/edit/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_concours(id) {
    var link = '/Site/bouwou/concours/edit/' + id;
    ////alert(link);
    window.location.href = link;
}

function filiere_row(iduniv, idfac) {
    var link = '/Site/bouwou/formations/index/' + iduniv + '/' + idfac;
    ////alert(link);
    window.location.href = link;
}
function filiere_categorie_row(id) {
    var link = '/Site/bouwou/formations/index/0/0/' + id;
    ////alert(link);
    window.location.href = link;
}
function update_row_filiere(id) {
    var link = '/Site/bouwou/formations/edit/' + id;
    ////alert(link);
    window.location.href = link;
}
function conf_row_question(id) {
    var link = '/Site/bouwou/orientation/configuration/' + id;
    ////alert(link);
    window.location.href = link;
}
function categorie_row_question(id) {
    var link = '/Site/bouwou/orientation/recapitulatif/categorie/' + id;
    ////alert(link);
    window.location.href = link;
}

function info_row(row) {

    //var lien = $(this).attr('id');
    alert('test');

    $.ajax({
        type: "POST",
        url: '/Site/koudjine/inc/info_universite.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            ////alert(data);
            //$("#iconPreview .icon-preview").html(icon_preview);
            alert(data);
            $('#iconPreview .nom').html(data.nom);
            $("#iconPreview .ville").html(data.ville);
            $("#iconPreview .region").html(data.region);
            $("#iconPreview .statut").html(data.statut);
            $("#iconPreview .type").html(data.type);
            $("#iconPreview .responsable").html(data.responsable);
            $("#iconPreview .bp").html(data.bp);
            $("#iconPreview .email").html(data.email);
            $("#iconPreview .phone").html(data.phone);
            $("#iconPreview .site").html(data.site);
            $("#iconPreview .certif").html(data.certif);
        }

    })

    // var icon_preview = $("<i></i>").addClass(iClass);
    $("#iconPreview").modal("show");

}

// Fonctions Pharmacie

function info_row_entree(row) {

    //var lien = $(this).attr('id');
    ////alert('test');
    var code;

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/info_entree.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            alert(data);
            //$("#iconPreview .icon-preview").html(icon_preview);

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
            //$("#code").barcode(data.codebarre);
            code1 = data.codebarre;
            $("#demo").barcode(
                code1, // Value barcode (dependent on the type of barcode)
                "code128" // type (string)

            );


        }


    })
    ////alert(code);
    $(".fittext1").fitText();
    $("#demo").fitText();


    // var icon_preview = $("<i></i>").addClass(iClass);
    $("#iconPreviewEntree").modal("show");

}

function imprimer(divName) {
    //$("#iconPreviewEntree").modal("hide");
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    return true;
}
function imprimer_bloc(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet).innerHTML;

    // Ouverture du popup
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

// Fin
