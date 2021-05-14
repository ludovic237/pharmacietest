var test = 0;
var startDate;
var endDate;
var idemploye = null
;
var idfulldepense;

$(document).ready(function () {

});


var etiquetteNomP;
var etiquetteNomF;
var etiquetteCode;
var etiquetteDatel;
var etiquetteDatep;
var etiquettePrix;
var qrcode;
function info_row_entree(row) {
    $('#qrcode').empty();
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
            etiquetteNomF = data.code;
            etiquetteNomP = data.nomP;
            etiquetteNomF = data.code;
            etiquetteCode = data.code;
            etiquetteDatel = data.datel;
            etiquetteDatep = data.datep;
            etiquettePrix = data.prixv;

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
            qrcode = new QRCode(document.getElementById("qrcode"), {
                width: 30,
                height: 30
            });
            qrcode.makeCode(code1);

        }


    })
    $("#iconPreviewEntree").modal("show");

}

function imprimer_bloc(titre, objet) {
    /*// Définition de la zone à imprimer
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
    fen.window.close();*/
    let base64Image = $('#qrcode img').attr('src');
    console.log(base64Image);
    console.log(base64Image);
    var doc = new jspdf.jsPDF({orientation: 'landscape', unit: 'mm', format: [30, 16
        ]});
    //var doc = new jsPDF('l', 'mm', [30, 15]);
    doc.cell(0, 0, 30, 15, ' ', 1, "center");
    doc.setFontSize(4);
    doc.text(1, 3, etiquetteNomP);
    doc.setFontSize(7);
    doc.text(1, 7, etiquettePrix+' FCFA');
    doc.addImage(base64Image, "JPEG", 20, 4, 9, 9);
    doc.setFontSize(5);
    doc.text(2, 12, etiquetteNomF);
    doc.setFontSize(4);
    doc.text(2, 14, etiquetteDatel + ' / ' + etiquetteDatep);
    doc.save('hello.pdf');
    //doc.print('hello');
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
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/en_rayon/';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    } else {

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
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/en_rayonadd/' + id;
                        window.location.href = link;
                    }, 5000);

                } else {
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
