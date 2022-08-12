$(document).ready(function () {
    $('#closemodal').click(function () {
        $('#message-alert-prod').modal('hide');
    });
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();

    $("#iconPreviewForm .champ").keyup(function (event) {
        if (event.keyCode == 13) {
            //alert('passe');
            var id = $(this).attr("id");
            var position = $("#" + id).attr("data");
            position = parseInt(position);
            position = position + 1;
            $("#iconPreviewForm .champ" + position).focus();
            //$("#iconPreviewForm .champ"+position).val(position);
        }
    })

    $('#iconPreviewForm').on('show.bs.modal', function () {
        ////alert('passe');
        $("#tab_BCrecherche").hide();
        $("#tab_GCrecherche").hide();
    })

    //Recherche rapide
    $("#recherche_commande_prog").keyup(function (event) {
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "POST",
                    url: "/pharmacietest/koudjine/inc/result_commande_prog2.php",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if (data.erreur == "non") {
                            load_produit(data.id, data.nom, data.prixA, data.prixV, data.reduction);
                            $('#recherche').val("");
                            $("#tab_BCrecherche").empty();
                            $("#tab_GCrecherche").hide();
                        } else {
                            $('#message-box-danger p').html(data.erreur);
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                            $('#recherche').val("");
                            $("#tab_Grecherche").hide();
                        }
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_BCrecherche").empty();
                $("#tab_GCrecherche").hide();
            }
        } else {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef1=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result_commande_prog.php",
                    data: data,
                    success: function (server_responce) {
                        $("#tab_GCrecherche").show();
                        $("#tab_BCrecherche").html(server_responce).show();
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_BCrecherche").empty();
                $("#tab_GCrecherche").hide();
            }
        }
    })

});

function load_produit(id, nom, prixachat, prixvente, reduction) {

    $("#tab_BCrecherche").hide();
    $("#tab_BCrecherche").empty();
    $("#tab_GCrecherche").hide();
    $('#nom_cmdprogramme').val(nom);
    $('#reduction_max').val(reduction);
    $('#recherche_commande_prog').val('');
    $('#prixachat_cmdprogramme').val(prixachat);
    $('#prixpublic_cmdprogramme').val(prixvente);
    $('#id_xr').attr("data", id);
    $("#iconPreviewForm").modal("show");
}

var tableId = [];

function enregistrer_commande_programme() {


    if ($("#fournisseur_commande option:selected").val() == 0 || $("#numero_bon_livraison").val() == '') {
        $('#message-box-danger p').html("Veuillez selectionner un fournisseur et entrer le numero de Livraison !!!");
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);
        $("#iconPreviewForm").modal("hide");
    } else {
        var id = $('#id_xr').attr("data");
        var nom = $('#nom_cmdprogramme').val();
        var ug, qte = $('#qte_cmdprogramme').val();
        if ($('#ug_cmdprogramme').val() != '')
            ug = $('#ug_cmdprogramme').val();
        else
            ug = 0;
        var prixachat = $('#prixachat_cmdprogramme').val();
        var prixpublic = $('#prixpublic_cmdprogramme').val();
        var reduction = $('#reduction_max').val();
        var date = $('#date_cmdprogramme').val();
        if (date == '' || qte == '') {
            alert("Vérifier les champs Quantité et Date !!!");
        } else {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = yyyy + mm + dd;

            var codefournisseur = $('#fournisseur_commande option:selected').attr("data");


            var codebarre = id + "" + codefournisseur + "" + today;

            var data = {
                nom: nom,
                qte: qte,
                ug: ug,
                prixachat: prixachat,
                prixpublic: prixpublic,
                date: date,
            };
            tableId.push(id);

            var cat = '<tr id=' + codebarre + ' >'
                + ' <td class="nom" data="' + id + '" ><strong>' + nom + '</strong></td>'
                + '<td class="qte">' + qte + '</td>'
                + '<td class="ug">' + ug + '</td>'
                + '<td class="prixachat">' + prixachat + '</td>'
                + '<td class="prixpublic">' + prixpublic + '</td>'
                + '<td class="date">' + date + '</td>'
                + '<td class="reduction">' + reduction + '</td>'
                + '<td class="mycodeBar">' + reduction + '</td>'
                + '<td>'
                + '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_row_commande(' + codebarre + ')" ><span class="fa fa-times"></span></button>'
                + '<button class="btn btn-primary btn-rounded btn-sm" onClick="showPrintCmdProgramme(' + codebarre + ');" >Imprimer Ticket</span></button>'
                + '<button class="btn btn-success btn-sm" onClick="printOneTicket(' + codebarre + ');" >Tous Imprimer</span></button>'
                + '</td>'
                + '</tr>';
            $('#tab_commande_programme').prepend(cat);
            var total, prixTotal = 0, qteTotal = 0, ugTotal = 0;
            qte = 0;
            ug = 0;
            $('#tab_commande_programme  tr').each(function (i) {
                var id1 = $(this).attr("id");

                $("#" + id1 + " td").each(function (j) {
                    ////alert($(this).html());
                    if (j == 1) {
                        qte = parseInt($(this).html());
                        qteTotal = qteTotal + qte;
                    }
                    if (j == 2) {
                        ug = parseInt($(this).html());
                        ugTotal = ugTotal + ug;
                        //alert(ugTotal);
                    }
                    if (j == 3) {
                        total = (qte * parseInt($(this).html()));
                        prixTotal = prixTotal + total;
                    }

                });

            });
            $('#prixTotal').html(prixTotal);
            $('#prixTotal').attr("data", qteTotal);
            $('#prixTotal').attr("data1", ugTotal);

            //alert(JSON.stringify(data));
            $("#iconPreviewForm").modal("hide");
            $('#qte_cmdprogramme').val('');
            $('#date_cmdprogramme').val('');
            console.log($('#' + codebarre + ' .mycodeBar'));
            qrcode = new QRCode($('#' + codebarre + ' tr .mycodeBar'), {
                width: 30,
                height: 30
            });
            qrcode.clear()
            qrcode.makeCode(codebarre);
        }
        //alert(id);


    }

}

function imprimer_cmdProgramme(titre, objet) {
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

function showRecu() {
    $("#iconPreviewRecu").modal("show");
}


function imprimer_bon(titre, objet) {
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

function imprimer_recu(titre, objet) {
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

function delete_row_commande(id) {
    var total;
    $("#" + id).remove();

    var prixTotal = 0, qte;
    $('#tab_commande_programme  tr').each(function (i) {
        var id1 = $(this).attr("id");

        $("#" + id1 + " td").each(function (j) {
            ////alert($(this).html());
            if (j == 1) {
                qte = parseInt($(this).html());
            }
            if (j == 2) {
                total = (qte * parseInt($(this).html()));
                prixTotal = prixTotal + total;
            }

        });

    });
    $('#prixTotal').html(prixTotal);
}

function valider_commande(imprimer) {
    var prixTotal, idc, ref;
    var prix, qte, ug, prixPublic, reduction, datep, nomP, count = 0, rec = 0;
    var h = 1, total = 0, nbre = 0;
    prixTotal = parseInt($('#prixTotal').html());
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    today = yyyy + "-" + mm + "-" + dd + "  " + time;
    //alert(parseInt($("#prixTotal").attr("data1")));
    $("#date").html(today);
    if (prixTotal == 0) {
        alert('Veuillez sélectionner des produits !!!');
    } else if ($("#fournisseur_commande").val() == 0) {
        alert('Veuillez sélectionner un fournisseur!!!');
    } else {
        $.ajax({
            type: "POST",
            url: "/pharmacietest/koudjine/inc/enregistrer_commande.php",
            data: {
                idf: parseInt($("#fournisseur_commande").val()),
                numLivraison: $("#numero_bon_livraison").val(),
                montant: prixTotal,
                datel: today,
                qte: parseInt($("#prixTotal").attr("data")),
                ug: parseInt($("#prixTotal").attr("data1"))
            },
            dataType: 'json',
            success: function (data) {
                //alert(data);
                //alert('tpasse');
                //alert(data.erreur);
                if (data.erreur == 'ok') {
                    //alert('passe');
                    idc = data.id;
                    ref = data.ref;
                    //alert(idc);
                    $('#tab_commande_programme  tr').each(function (i) {
                        count++;
                    });
                    console.log(count);
                    $('#tab_commande_programme  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        var id2 = $("#" + id1 + " .nom").attr("data");
                        //alert(id2);

                        ////alert(id1);


                        $("#" + id1 + " td").each(function (j) {
                            ////alert($(this).html());
                            if (j == 0) {
                                nomP = $(this).html();
                            }
                            if (j == 1) {
                                qte = parseInt($(this).html());
                            }
                            if (j == 2) {
                                ug = parseInt($(this).html());
                            }
                            if (j == 3) {
                                prix = parseInt($(this).html());
                            }
                            if (j == 4) {
                                prixPublic = parseInt($(this).html());
                            }
                            if (j == 5) {
                                datep = $(this).html();
                            }
                            if (j == 6) {
                                reduction = $(this).html();
                            }

                        });
                        var cat = '<tr>'
                            + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + h + '</td>'
                            + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;font-size: 10px;">' + nomP + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + qte + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + qte + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + ug + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + prix + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + prixPublic + '</td>'
                            + '<td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">' + (prix * qte) + '</td>'
                            + '</tr>';
                        $('#tab_Bcommande_Recu').append(cat);
                        h++;
                        total = total + (prix * qte);
                        nbre = nbre + qte;
                        //alert(prix+'-'+qte+'-'+prixPublic);
                        $.ajax({
                            type: "POST",
                            url: "/pharmacietest/koudjine/inc/produit_commande.php",
                            data: {
                                idc: idc,
                                idp: id2,
                                ide: id1,
                                prixu: prix,
                                prixp: prixPublic,
                                datep: datep,
                                qte: qte,
                                ug: ug,
                                reduction: reduction
                            },
                            success: function (server_responce) {
                                alert(server_responce);
                                //alert(idc);
                                //alert("OK");
                                rec++;

                                $("#mb-confirmation").attr("data", idc);
                                //alert($("#mb-confirmation").attr("data"));
                                if (imprimer && rec == count) {
                                    //imprimer_com(idc, ref, $('#fournisseur_commande option:selected').text());
                                    var cat = '<tr>'
                                        + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="6">Total</td>'
                                        + ' <td  style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"><strong>' + total + '</strong></td>'
                                        + '</tr>';
                                    $('#tab_Bcommande_Recu').append(cat);
                                    //$("#totalRecu").html(total);
                                    $("#article_commande").html(h - 1);
                                    $("#produit_commande").html(nbre);
                                    var yo = ref;
                                    var one = yo.substr(0, 9);
                                    var three = yo.substr(12, 3);

                                    var chaine = one + "REC" + three;

                                    var today = new Date();
                                    var dd = String(today.getDate()).padStart(2, '0');
                                    var mm = String(today.getMonth() + 1).padStart(2, '0');
                                    var yyyy = today.getFullYear();
                                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                                    today = dd + "-" + mm + "-" + yyyy + "  " + time
                                    $("#date").html(today);
                                    $("#bordereau_livraison").html($("#numero_bon_livraison").val());
                                    $("#rec_commande").html(chaine);
                                    $("#ref_commande").html(ref);
                                    $("#nomf_commande").html($('#fournisseur_commande option:selected').text());
                                    $("#date_commande").html(today);
                                    $("#iconPreviewRecu").modal("show");
                                } else {

                                    if (rec == count) {
                                        console.log('Redirige');
                                        var link = '/pharmacietest/bouwou/commande/list';
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

                }


            }
        })
    }
}

var etiquetteNomP;
var etiquetteNomF;
var etiquetteCode;
var etiquetteDatel;
var etiquetteDatep;
var etiquettePrix;
var etiquetteQte;
var qrcode;

function showPrintCmdProgramme(id) {
    $('#qrcode img').remove();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = dd + "-" + mm + "-" + yyyy;
    var todayCode = dd + "" + mm + "" + yyyy;
    var nom = $("#" + id + " .nom strong").html();
    var datelivraisron = $("#" + id + " .date").html();
    var prix = $("#" + id + " .prixpublic").html();
    var codefournisseur = $('#fournisseur_commande option:selected').attr("data");
    etiquetteQte = parseInt($("#" + id + " .qte").html()) + parseInt($("#" + id + " .ug").html());
    //var date = $("#" + id + " .date").html();
    //date = date.replaceAll("-", "");

    var codebarre = id + "" + codefournisseur + "" + todayCode;

    //etiquetteNomF = nom;
    etiquetteNomP = nom;
    etiquetteNomF = codefournisseur;
    etiquetteCode = codebarre;
    etiquetteDatel = today;
    etiquetteDatep = datelivraisron;
    etiquettePrix = prix;

    $('#iconPreviewPrintCmdProgramme .nomp').html(nom);
    $("#iconPreviewPrintCmdProgramme .nomf").html(nom);
    $("#iconPreviewPrintCmdProgramme .code").html(codefournisseur);
    $("#iconPreviewPrintCmdProgramme .codebarre").html(codebarre);
    $("#iconPreviewPrintCmdProgramme .datel").html(today);
    $("#iconPreviewPrintCmdProgramme .datep").html(datelivraisron);
    $("#iconPreviewPrintCmdProgramme .prixv").html(prix);
    code1 = codebarre;

    qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 30,
        height: 30
    });
    qrcode.clear();
    qrcode.makeCode(code1);

    $("#iconPreviewPrintCmdProgramme").modal("show");
}

function imprimer_bloc(titre, objet) {
    let base64Image = $('#qrcode img').attr('src');
    console.log(base64Image);
    console.log(base64Image);
    var doc = new jspdf.jsPDF({
        orientation: 'landscape', unit: 'mm', format: [30, 17
        ]
    });
    //var doc = new jsPDF('l', 'mm', [30, 15]);
    doc.cell(0, 0, 30, 17, ' ', 1, "center");
    doc.setFontSize(4);
    doc.text(1, 5, etiquetteNomP);
    doc.setFontSize(7);
    doc.text(1, 9, etiquettePrix + ' FCFA');
    doc.addImage(base64Image, "JPEG", 20, 6, 9, 9);
    doc.setFontSize(5);
    doc.text(2, 14, etiquetteNomF);
    doc.setFontSize(4);
    doc.text(2, 16, etiquetteDatel + ' / ' + etiquetteDatep);
    doc.save('hello.pdf');
    //doc.print('hello');
    return true;
}

function showPrintAllTicket() {
    $("#iconPreviewPrintAllCmdProgramme").modal("show");
}

function printAllTicket() {
    //gets table
    var oTable = document.getElementById('tab_commande_programme');
    //gets rows of table
    var rowLength = oTable.rows.length;
    var jsonData = {};
    //loops through rows
    var tableNew = [];

    if (rowLength > 0) {
        for (i = 0; i < rowLength; i++) {

            //gets cells of current row
            var oCells = oTable.rows.item(i).cells;
            var id = oTable.rows.item(i).id;
            //gets amount of cells of current row
            var cellLength = oCells.length;

            //loops through each cell in current row
            var line = {};
            for (var j = 0; j < cellLength; j++) {

                // get your cell info here
                // console.log(oCells.item(j));
                var cellVal = oCells.item(j).innerHTML;
                switch (j) {
                    case 0:
                        var name = cellVal.replace("<strong>", "").replace("</strong>", "")
                        line.name = name;
                        break;
                    case 1:
                        line.qte = parseInt(cellVal);
                        break;
                    case 2:
                        line.unit = parseInt(cellVal);
                        break;
                    case 3:
                        line.prixa = parseInt(cellVal);
                        break;
                    case 4:
                        line.prixp = parseInt(cellVal);
                        break;
                    case 5:
                        line.date = "" + cellVal;
                        break;
                    case 6:
                        line.red = cellVal;
                        break;
                }
            }
            line.id = id
            tableNew.push({...line});
        }
        showAllPrintCmdProgramme(tableNew)
    } else {
        $("#message-alert-prod").modal("show");
    }
    //console.log(JSON.stringify(tableNew));
}

function printOneTicket(id) {
    var doc = new jspdf.jsPDF({
        orientation: 'landscape', unit: 'mm', format: [30, 17
        ]
    });
    $('#qrcode').empty();
    $('#productNameId').empty();

    var nom = $("#" + id + " .nom strong").html();
    var qte = parseInt($("#" + id + " .qte").html()) + parseInt($("#" + id + " .ug").html());
    var datePerem = $("#" + id + " .date").html();
    var prix = $("#" + id + " .prixpublic").html();

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = dd + "-" + mm + "-" + yyyy;
    var todayCode = dd + "" + mm + "" + yyyy;
    var codefournisseur = $('#fournisseur_commande option:selected').attr("data");
    qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 30,
        height: 30
    });
    // qrcode.clear()
    qrcode.makeCode(""+id);
    console.log(""+id);
    /*console.log(tableNew[ind]);
    console.log($('#qrcode img').attr('src'));
    console.log("ind: "+ind);*/
    setTimeout(function () {
        /*console.log("i2: "+ind);
        console.log($('#qrcode img').attr('src'));*/
        for (let i = 0; i < qte; i++) {
            let base64Image = $('#qrcode img').attr('src');

            console.log(base64Image);

            //var doc = new jsPDF('l', 'mm', [30, 15]);
            doc.cell(0, 0, 30, 17, ' ', 1, "center");
            doc.setFontSize(4);
            doc.text(1, 5, nom);
            doc.setFontSize(7);
            doc.text(1, 9, prix + ' FCFA');
            doc.addImage(base64Image, "JPEG", 0, 0, 10, 10);
            doc.setFontSize(5);
            doc.text(2, 14, codefournisseur);
            doc.setFontSize(4);
            doc.text(2, 16, today + ' / ' + datePerem);
            doc.cellAddPage([30, 17], "l");

        }
        doc.save('hello.pdf');
    }, 2500);

}

function showAllPrintCmdProgramme(tableNew) {
    console.log(tableNew);
    var doc = new jspdf.jsPDF({
        orientation: 'landscape', unit: 'mm', format: [30, 20
        ]
    });
    for (var i = 0; i < tableNew.length; i++) {
        (function (ind) {
            setTimeout(function () {
                $('#qrcode').empty();
                $('#productNameId').empty();
                var id = tableNew[ind].id;
                var nom = tableNew[ind].name;
                $('#productNameId').html(ind + " - " + nom);
                var qte = (tableNew[ind].qte + tableNew[ind].unit)
                var datePerem = tableNew[ind].date;
                var prix = tableNew[ind].prixp;

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();
                today = dd + "-" + mm + "-" + yyyy;
                var todayCode = dd + "" + mm + "" + yyyy;
                var codefournisseur = $('#fournisseur_commande option:selected').attr("data");
                qrcode = new QRCode(document.getElementById("qrcode"), {
                    width: 30,
                    height: 30
                });
                // qrcode.clear()
                qrcode.makeCode(id);
                console.log(id);
                /*console.log(tableNew[ind]);
                console.log($('#qrcode img').attr('src'));
                console.log("ind: "+ind);*/
                setTimeout(function () {
                    /*console.log("i2: "+ind);
                    console.log($('#qrcode img').attr('src'));*/
                    for (let i = 0; i < qte; i++) {
                        let base64Image = $('#qrcode img').attr('src');

                        console.log(base64Image);

                        //var doc = new jsPDF('l', 'mm', [30, 15]);
                        doc.cell(0, 0, 30, 20, ' ', 1, "center");
                        doc.setFontSize(2);
                        doc.setFontSize(7);
                        doc.text(19, 6, prix + ' F');
                        doc.addImage(base64Image, "JPEG", 1, 1, 17, 17);
                        doc.setFontSize(5);
                        doc.text(19, 8, codefournisseur);
                        doc.setFontSize(4);
                        doc.text(19, 10, today );
                        doc.text(19, 12,  datePerem);
                        doc.text(19, 16, nom);
                        doc.cellAddPage([30, 20], "l");

                    }
                    if (ind === tableNew.length - 1) {
                        doc.save('hello.pdf');
                    }
                }, 500);
            }, 1000 + (3000 * ind));
        })(i);

    }
}

function imprimer_bloc_new(nom, datePerem, prix, codefournisseur, date) {
    let base64Image = $('#qrcode img').attr('src');

    console.log(base64Image);
    var doc = new jspdf.jsPDF({
        orientation: 'landscape', unit: 'mm', format: [30, 20
        ]
    });
    //var doc = new jsPDF('l', 'mm', [30, 15]);
    doc.cell(0, 0, 30, 20, ' ', 1, "center");
    /*doc.setFontSize(4);
    doc.text(1, 5, nom);
    doc.setFontSize(7);
    doc.text(1, 9, prix + ' FCFA');*/
    doc.addImage(base64Image, "JPEG", 0, 0, 10, 10);
    /*doc.setFontSize(5);
    doc.text(2, 14, codefournisseur);
    doc.setFontSize(4);
    doc.text(2, 16, date + ' / ' + datePerem);*/
    doc.save('hello.pdf');
    //doc.print('hello');
    return true;
}
