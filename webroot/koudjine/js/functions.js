var test = 0;
var startDate;
var endDate;
var idemploye = null
;
var idfulldepense;

$(document).ready(function () { 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus

    // Pharmacie
    var netpayer;
    var reduc;
    var stock;

    getListVente();

    $('#search-caisse-box').keyup(function () {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/readcaisse.php',
            data: 'keywordcaisse=' + $(this).val(),
            beforeSend: function () {
                $("#search-caisse-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function (data) {
                //alert(data);
                $("#suggesstion-caisse-box-block").show();
                $("#suggesstion-caisse-box").html(data).show();
                $("#suggesstion-caisse-box").css("background", "#FFF");

            }
        });
    });




    $("#detailTab").hide();

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





    console.log(); (test);
    if (test != '') {
        load_produit_detail(test);
    } else {

    }

});








// Ajax
// Fonctions PHARMACIE





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








function modify_depense_row(id) {
    //alert("link");
    var link = '/pharmacietest/bouwou/pharmanet/depenseadd/?id=' + id;
    //alert(link);
    window.location.href = link;
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






// FIN



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



function imprimer_bon_caisse() {
    $("#previewImprimerBonCaisse").modal('show');
}

function getListVente() {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/list_vente.php',
        dataType: 'json',
        success: function (data) {
            console.log(data.venteActifCaisse);
            var venteActifCaisse = data.venteActifCaisse;
            var venteAll = data.venteAll;
            console.log(venteActifCaisse);
            console.log(venteAll);
            $('#customers').dataTable({
                destroy: true,
                searching: true,
                dFilter: true,
                bInfo: true,
                bPaginate: true,
                data: venteActifCaisse,
                columns: [
                    {
                        "data": "reference", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="reference">' + data + '</strong>';
                        }
                    },
                    {
                        "data": "prixTotal", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="prixt">' + data + '</strong>';
                        }
                    },
                    {
                        "data": "prixPercu", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="prixp">'+data+'</strong>';
                        }
                    },
                    {
                        "data": "commentaire", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="commentaire">'+data+'</strong>';
                        }
                    },
                    {
                        "data": "type_paiement", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="typePaiement">'+data+'</strong>';
                        }
                    },
                    {
                        "data": "dateVente", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="datevte">'+data+'</strong>';
                        }
                    },
                    {
                        "data": "etat", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="etat">'+data+'</strong>';
                        }
                    },
                    {
                        "data": "etat", "bSortable": false, "render": function (data, type, row) {
                            return '<a class="btn btn-success btn-rounded btn-sm" data-toggle="tooltip"\n' +
                                '                                                   data-placement="top" title="Modifier"\n' +
                                '                                                   onclick="reimprime_ticket('+row.DT_RowId+',\'' + row.montantfactureEspece + '\',\'' + row.montantfactureElectronique + '\',\'' + row.montantfactureTicket + '\',\'' + row.reste + '\')">Imprimer ticket</a>';
                        }
                    }
                ]
            });
            $('#customers3').dataTable({
                destroy: true,
                searching: true,
                dFilter: true,
                bInfo: true,
                bPaginate: true,
                data: venteAll,
                columns: [
                    {data: "reference"},
                    {
                        "data": "prixTotal", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="prixt">' + data + '</strong></td>';
                        }
                    },
                    {
                        "data": "prixPercu", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="prixp">'+data+'</strong></td>';
                        }
                    },
                    {
                        "data": "commentaire", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="commentaire">'+data+'</strong></td>';
                        }
                    },
                    {
                        "data": "type_paiement", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="typePaiement">'+data+'</strong></td>';
                        }
                    },
                    {
                        "data": "dateVente", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="datevte">'+data+'</strong></td>';
                        }
                    },
                    {
                        "data": "etat", "bSortable": false, "render": function (data, type, row) {
                            return '<strong class="etat">'+data+'</strong></td>';
                        }
                    },
                    {
                        "data": "etat", "bSortable": false, "render": function (data, type, row) {
                            return '<a class="btn btn-success btn-rounded btn-sm" data-toggle="tooltip"\n' +
                                '                                                   data-placement="top" title="Modifier"\n' +
                                '                                                   onclick="reimprime_ticket('+row.DT_RowId+',\'' + row.montantfactureEspece + '\',\'' + row.montantfactureElectronique + '\',\'' + row.montantfactureTicket + '\',\'' + row.reste + '\')">Imprimer ticket</a>';
                        }
                    }
                ]
            });
        }
    })
}







