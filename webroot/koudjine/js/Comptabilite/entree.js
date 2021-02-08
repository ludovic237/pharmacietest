var test = 0;
var startDate;
var endDate;
var idemploye = null
;
var idfulldepense;

$(document).ready(function () {

});

function info_row_entree(row) {

    var code;

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/info_entree.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            //alert(data);
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
            qrcode.makeCode(code1);

        }


    })
    $("#iconPreviewEntree").modal("show");

}

function imprimer_bloc(titre, objet) {
    // Définition de la zone à imprimer
    var zone = document.getElementById(objet).innerHTML;
    //alert("Hello");
    // Ouverture du popup,
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

function enregistrer_en_rayon(option, id) {
    // Informations université
    var produit_id = $('#produit_id').val();
    var fournisseur_id = $('#fournisseur_id').val();
    var dateLivraison = $('#dateLivraison').val();
    var datePeremption = $('#datePeremption').val();
    var prixAchat = $('#prixAchat').val();
    var prixVente = $('#prixVente').val();
    var reduction = $('#reduction').val();
    var quantite = $('#quantite').val();
    var quantiteRestante = $('#quantiteRestante').val();

    if (option == 'Ajouter') {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_en_rayon.php',
            data: {
                produit_id: produit_id,
                fournisseur_id: fournisseur_id,
                dateLivraison: dateLivraison,
                datePeremption: datePeremption,
                prixAchat: prixAchat,
                prixVente: prixVente,
                reduction: reduction,
                quantite: quantite,
                quantiteRestante: quantiteRestante
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/en_rayon/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_en_rayon.php',
            data: {
                produit_id: produit_id,
                fournisseur_id: fournisseur_id,
                dateLivraison: dateLivraison,
                datePeremption: datePeremption,
                prixAchat: prixAchat,
                prixVente: prixVente,
                reduction: reduction,
                quantite: quantite,
                quantiteRestante: quantiteRestante,
                id: id
            },
            success: function (data) {

                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/en_rayonadd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}