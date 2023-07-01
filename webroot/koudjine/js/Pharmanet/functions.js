var test = 0;
var startDate;
var endDate;
var idemploye = null
    ;
var idfulldepense;
$('#pharmanet_tab_vente').hide();
$('#pharmanet_tab_depense').hide();
$('#pharmanet_tab_caisse').hide();
$(document).ready(function () { 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus

    if ($("#reportrangepharmanet").length > 0) {
        $("#reportrangepharmanet").daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM.DD.YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()
        }, function (start, end) {
            startDate = moment(start).format("YYYY-MM-DD HH:mm:ss");
            endDate = moment(end).format("YYYY-MM-DD HH:mm:ss");;
            $('#reportrangepharmanet span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $("#reportrangepharmanet span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        startDate = moment().subtract('days', 29).format("YYYY-MM-DD HH:mm:ss");
        endDate = moment().format("YYYY-MM-DD HH:mm:ss");
    }

    $('#search-employe-box').keyup(function () {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/reademploye.php',
            data: 'keyword=' + $(this).val(),
            beforeSend: function () {
                $("#search-employe-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function (data) { 
                //alert(data);
                $("#suggesstion-employe-box-block").show();
                $("#suggesstion-employe-box").html(data).show();
                $("#suggesstion-employe-box").css("background", "#FFF");

            }
        });
    });

});

function selectemploye(val, id) {
    idemploye = id;
    $("#suggesstion-employe-box-block").hide();
    $("#search-employe-box").val(val);
    $("#suggesstion-employe-box").hide();
}

function pharmanet_recherche_valide() {
    var nomemploye = $('#search-employe-box').val();
    var type = $('#pharmanettype option:selected').val();
    alert("" + nomemploye + "-" + startDate + "-" + endDate + "-" + type + "-" + idemploye);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/pharmanet_depense.php',
        data: {
            idemploye: idemploye,
            startDate: startDate,
            endDate: endDate,
            type: type
        },
        success: function (server_responce) {
            switch (type) {
                case "depense":
                    $('#pharmanet_tab_Gdepense').empty();
                    $('#pharmanet_tab_Gdepense').html(server_responce);
                    $('#pharmanet_tab_vente').hide();
                    $('#pharmanet_tab_depense').show();
                    $('#pharmanet_tab_caisse').hide();

                    var total, prixTotal = 0, qteTotal = 0;
                    var qte = 0;
                    $('#pharmanet_tab_Gdepense  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        prixTotal = prixTotal + parseInt($("#" + id1 + " .total").val());
                    });
                    console.log(prixTotal);
                    $("#pharmanet_total_depense").html('');
                    $("#pharmanet_total_depense").html(prixTotal);
                    break;
                case "caisse":
                    $('#pharmanet_caisse_employe').empty();
                    $('#pharmanet_caisse_employe').html(server_responce);
                    $('#pharmanet_tab_vente').hide();
                    $('#pharmanet_tab_depense').hide();
                    $('#pharmanet_tab_caisse').show();

                    var total, prixTotalOuverture = 0, prixTotalFermeture = 0, qteTotal = 0;
                    var qte = 0;
                    $('#pharmanet_caisse_employe  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        prixTotalOuverture = prixTotalOuverture + parseInt($("#" + id1 + " .prixOuverture").html());
                        prixTotalFermeture = prixTotalFermeture + parseInt($("#" + id1 + " .prixFermeture").html());
                    });
                    alert(prixTotalOuverture);
                    $("#pharmanet_total_caisse_ouvert").html(prixTotalOuverture);
                    $("#pharmanet_total_caisse_ferme").html(prixTotalFermeture);
                    break;
                case "vente":
                    $('#pharmanet_vente_employe').empty();
                    $('#pharmanet_vente_employe').html(server_responce);
                    $('#pharmanet_tab_vente').show();
                    $('#pharmanet_tab_depense').hide();
                    $('#pharmanet_tab_caisse').hide();

                    var total, prixTotal = 0, qteTotal = 0;
                    var qte = 0;
                    $('#pharmanet_vente_employe  tr').each(function (i) {
                        var id1 = $(this).attr("id");
                        prixTotal = prixTotal + parseInt($("#" + id1 + " .prixTotal").html());
                    });
                    console.log(prixTotal);
                    $("#pharmanet_total_vente").html('');
                    $("#pharmanet_total_vente").html(prixTotal);
                    break;

                default:
                    break;
            }


            $('#pharmanet_caisse_employe').empty();
            $('#pharmanet_caisse_employe').html(server_responce);


        }


    })
    $("#iconPreviewDepense").modal("show");
}

function enregistrer_client(option, id) {

    var nom = $('#nom').val();
    var telephone = $('#telephone').val();
    var modeReglement = $('#modeReglement').val();
    var poid = $('#poid').val();
    var taille = $('#taille').val();
    var reduction = $('#reduction').val();
    var assureur_id = $('#assureur_id').val();
    var CodePostal_id = $('#CodePostal_id').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_client.php',
            data: {
                nom: nom,
                telephone: telephone,
                modeReglement: modeReglement,
                poid: poid,
                taille: taille,
                reduction: reduction,
                assureur_id: assureur_id,
                CodePostal_id: CodePostal_id
            },
            success: function (data) {

                if (data == 'ok') {

                    noty({text: 'Ajout effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        var link = '/pharmacietest/bouwou/catalogue/client/';
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
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_client.php',
            data: {
                nom: nom,
                telephone: telephone,
                modeReglement: modeReglement,
                poid: poid,
                taille: taille,
                reduction: reduction,
                assureur_id: assureur_id,
                CodePostal_id: CodePostal_id,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {

                    noty({text: 'Modification effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
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

function update_row_user(id) {
    var link = '/pharmacietest/bouwou/pharmanet/useradd/' + id;
    window.location.href = link;
}

function enregistrer_employe(option, id) {
    // Informations université
    var identifiant = $('#identifiant').val();
    var password = $('#password').val();
    var type = $('#type').val();
    var etat = $('#etat').val();
    var user_id = $('#user_id').val();
    var codebarre_id = $('#codebarre_id').val();
    ////alert(type);
    var faireReductionMax = $('#faireReductionMax').val();
    /*$("#magproduit").change(function () {
        v = $('#magproduit option:selected').val();
      //  alert(v);
    })*/
    //.trigger('change');
    //alert('mag');

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_employe.php',
            data: {
                identifiant: identifiant,
                password: password,
                type: type,
                etat: etat,
                user_id: user_id,
                codebarre_id: codebarre_id,
                faireReductionMax: faireReductionMax,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Information enregistré', layout: 'topRight', type: 'success'});
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/pharmanet/employe';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    } else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_employe.php',
            data: {
                identifiant: identifiant,
                password: password,
                type: type,
                etat: etat,
                user_id: user_id,
                codebarre_id: codebarre_id,
                faireReductionMax: faireReductionMax,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/pharmanet/employeadd/' + id;
                    window.location.href = link;
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

function update_row_employe(int) {
    var link = '/pharmacietest/bouwou/pharmanet/employeadd/' + int;
    window.location.href = link;
}

function enregistrer_user(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var email = $('#email').val();
    var fonction = $('#fonction').val();
    var telephone = $('#telephone').val();
    ////alert(type);
    var reduction = $('#reduction').val();
    var reductionMax = $('#reductionMax').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_user.php',
            data: {
                nom: nom,
                prenom: prenom,
                email: email,
                fonction: fonction,
                telephone: telephone,
                reduction: reduction,
                reductionMax: reductionMax
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/pharmanet/user';
                        window.location.href = link;
                    }, 5000);

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
            url: '/pharmacietest/koudjine/inc/enregistrer_user.php',
            data: {
                nom: nom,
                prenom: prenom,
                email: email,
                fonction: fonction,
                telephone: telephone,
                reduction: reduction,
                reductionMax: reductionMax,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/pharmanet/user';
                        //var link = '/pharmacietest/bouwou/pharmanet/useradd/' + id;
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
