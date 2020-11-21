$(document).ready(function(){


});
function enregistrer_depense(option, id) {
    // Informations produit
    var type = $('#depense_type').val();
    var qte = $('#depense_quantite').val();
    var prix = $('#depense_prixunitaire').val();
    var objet = $('#depense_objet').val();
    var cni = $('#depense_cni').val();
    ////alert(type);
    var dateDel = $('#depense_date').val();

    //if(dateDel == '') alert(dateDel);
    var dateDep = $('#depense_datedepense').val();
    var societe = $('#depense_societe').val();
    var beneficiaire = $('#depense_remis').val();
    var lieu = $('#depense_lieu').val();
    var caisse_id = '0_'+$('#depense_objet').attr("data");
    //alert(caisse_id);

    console.log(type);
    //alert(contenu);

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_depense.php',
            data: {
                type: type,
                qte: qte,
                prix: prix,
                objet: objet,
                cni: cni,
                dateDel: dateDel,
                dateDep: dateDep,
                societe: societe,
                caisse_id: caisse_id,
                beneficiaire: beneficiaire,
                lieu: lieu
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/pharmanet/depenseadd';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_depense.php',
            data: {
                type: type,
                qte: qte,
                prix: prix,
                objet: objet,
                cni: cni,
                dateDel: dateDel,
                dateDep: dateDep,
                societe: societe,
                beneficiaire: beneficiaire,
                lieu: lieu,
                id: id
            },
            success: function (data) {
                alert(data);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    var link = '/pharmacietest/bouwou/pharmanet/depenseadd/' + id;
                    window.location.href = link;
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