var test = 0;
var startDate;
var endDate;
var idemploye = null
;
var idfulldepense;


$(document).ready(function () {
    console.log(catalogue)
    catalogue.forEach(function (item) {
        item.rowId=item.ide;
    });
    var data = catalogue
    $('#DataTables_Table_0').dataTable({
        buttons:[
            {extend:'copyHtml5',
                className: 'btn btn-success',
                messageTop:"hello"},
            {extend:'excelHtml5',className: 'btn btn-success', messageTop:"hello"},
            {extend:'csvHtml5',className: 'btn btn-success', messageTop:"hello"},
            {extend:'pdfHtml5',
                className: 'btn btn-success',
                messageTop:"hello",
                title:"Commande Numero",
                text:'<div>Export Pdf</div>',
                titleAttr:"Export excel"
            },
        ],
        dom:'Bfrtip',
        destroy: true,
        searching: true,
        dFilter: false,
        bInfo: false,
        bPaginate: true,
        data: data,
        order: [[1, "desc"]],
        columns: [
            {
                data: "nomp", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "nomf", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "dateLivraison", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "datePeremption", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "prixAchat", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "prixVente", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "quantite", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "quantiteRestante", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "reduction", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
            {
                data: "reduction", "render": function (data, type, row) {
                    if (!data) {
                        return '<span class="text-muted" style="font-size:90%"></span>';
                    } else {
                        return '<strong>' + data + '</strong>';
                    }
                }
            },
        ]
    });
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

            etiquetteNomP = data.nomP;
            etiquetteCode = data.codeP+'(1)'+data.code;
            //etiquetteNomF = data.code;
            etiquetteNomF = etiquetteCode;

            etiquetteDatel = data.datel;
            etiquetteDatep = data.datep;
            etiquettePrix = data.prixv;

            $('#iconPreviewEntree .nomp').html(data.nomP);
            $("#iconPreviewEntree .nomf").html(etiquetteCode);
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
    $('#qrcode').empty();
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
    var doc = new jspdf.jsPDF({orientation: 'landscape', unit: 'mm', format: [30, 21
        ]});
    //var doc = new jsPDF('l', 'mm', [30, 15]);
    doc.cell(0, 0, 30, 20, ' ', 1, "center");
    doc.setFontSize(2);
    doc.setFontSize(7);
    doc.text(19, 6, etiquettePrix + ' F');
    doc.addImage(base64Image, "JPEG", 1, 1, 17, 17);
    doc.setFontSize(5);
    doc.text(19, 8, etiquetteNomF);
    doc.setFontSize(4);
    doc.text(19, 10, etiquetteDatel);
    doc.text(19, 12, etiquetteDatep);
    doc.text(19, 16, etiquetteNomP);
    doc.save('hello1.pdf');
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
