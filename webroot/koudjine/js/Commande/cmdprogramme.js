$(document).ready(function () {
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();

    //Recherche rapide
    $("#recherche_commande_prog").keyup(function (event) {
        if (event.keyCode == 13) {

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

function load_produit(id, nom, prixachat, prixvente) {

    $("#tab_BCrecherche").hide();
    $("#tab_BCrecherche").empty();
    $("#tab_GCrecherche").hide();
    $('#nom_cmdprogramme').val(nom);
    $('#recherche_commande_prog').val('');
    $('#prixachat_cmdprogramme').val(prixachat);
    $('#prixpublic_cmdprogramme').val(prixvente);
    $('#id_xr').attr("data", id);
    $("#iconPreviewForm").modal("show");
}

function enregistrer_commande_programme() {


    if($("#fournisseur_commande option:selected").val() == 0){
        $('#message-box-danger p').html('Veuillez selectionner un fournisseur !!!');
        $("#message-box-danger").modal("show");
        setTimeout(function () {
            $("#message-box-danger").modal("hide");
        }, 6000);
        $("#iconPreviewForm").modal("hide");
    }else {
        var id = $('#id_xr').attr("data");
        var nom = $('#nom_cmdprogramme').val();
        var qte = $('#qte_cmdprogramme').val();
        var prixachat = $('#prixachat_cmdprogramme').val();
        var prixpublic = $('#prixpublic_cmdprogramme').val();
        var date = $('#date_cmdprogramme').val();
        if(date == '' || qte == ''){
            alert("Vérifier les champs Quantité et Date !!!");
        }
        else{
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = yyyy  + mm  + dd;

            var codefournisseur = $('#fournisseur_commande option:selected').attr("data");



            var codebarre = id + "" + codefournisseur + "" + today;

            var data = {
                nom: nom,
                qte: qte,
                prixachat: prixachat,
                prixpublic: prixpublic,
                date: date,
            };

            var cat = '<tr id=' + codebarre + ' >'
                + ' <td class="nom" data="' + id + '" ><strong>' + nom + '</strong></td>'
                + '<td class="qte">' + qte + '</td>'
                + '<td class="prixachat">' + prixachat + '</td>'
                + '<td class="prixpublic">' + prixpublic + '</td>'
                + '<td class="date">' + date + '</td>'
                + '<td>'
                + '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_row_commande(' + codebarre + ')" ><span class="fa fa-times"></span></button>'
                + '<button class="btn btn-primary btn-rounded btn-sm" onClick="showPrintCmdProgramme(' + id + ');" >Imprimer Ticket</span></button>'
                + '</td>'
                + '</tr>';
            $('#tab_commande_programme').prepend(cat);
            var total, prixTotal = 0, qteTotal = 0;
            qte = 0;
            $('#tab_commande_programme  tr').each(function (i) {
                var id1 = $(this).attr("id");

                $("#" + id1 + " td").each(function (j) {
                    ////alert($(this).html());
                    if (j == 1) { qte = parseInt($(this).html()); qteTotal = qteTotal + qte; }
                    if (j == 2) { total = (qte * parseInt($(this).html())); prixTotal = prixTotal + total; }

                });

            });
            $('#prixTotal').html(prixTotal);
            $('#prixTotal').attr("data", qteTotal);

            //alert(JSON.stringify(data));
            $("#iconPreviewForm").modal("hide");
            $('#qte_cmdprogramme').val('');
            $('#date_cmdprogramme').val('');
        }
        //alert(id);


    }

}

function showPrintCmdProgramme(id) {

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = dd + "-" + mm + "-" + yyyy;

    var nom = $("#" + id + " .nom").html();
    var datelivraisron = $("#" + id + " .date").html();
    var codefournisseur = $('#fournisseur_commande option:selected').attr("data");

    var date = $("#" + id + " .date").html();
    date = date.replaceAll("-", "");

    var codebarre = id + "" + codefournisseur + "" + date;

    $('#iconPreviewPrintCmdProgramme .nom').html(nom);
    $("#iconPreviewPrintCmdProgramme .codefournisseur").html(codefournisseur);
    $("#iconPreviewPrintCmdProgramme .codebarre").barcode(
        codebarre, // Value barcode (dependent on the type of barcode)
        "code128" // type (string)

    );
    $("#iconPreviewPrintCmdProgramme .today").html(today);
    $("#iconPreviewPrintCmdProgramme .datelivraisron").html(datelivraisron);

    $("#iconPreviewPrintCmdProgramme").modal("show");
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

    var prixTotal = 0,qte;
    $('#tab_commande_programme  tr').each(function (i) {
        var id1 = $(this).attr("id");

        $("#" + id1 + " td").each(function (j) {
            ////alert($(this).html());
            if (j == 1) { qte = parseInt($(this).html()); }
            if (j == 2) { total = (qte * parseInt($(this).html())); prixTotal = prixTotal + total; }

        });

    });
    $('#prixTotal').html(prixTotal);
}




