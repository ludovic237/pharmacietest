$(document).ready(function () {
    var table_list_commande = $('#list_commande_table').dataTable();

    if ($("#reportrange").length > 0) {
        $("#reportrange").daterangepicker({
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
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            getListCommande(start, end);
        });


        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }


    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/get_type_list_commande.php",
        data: {},
        dataType: "json",
        success: function (data) {

        }
    });


});

function enregistrer_list_commande() {
    var date = $('#list_commande_date').val();
    var type = $('#list_commande_type option:selected').val();
    console.log('date : ' + date + ' - type : ' + type)
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/enregistrer_list_commande.php",
        data: {
            type: type,
            date: date
        },
        dataType: 'json',
        success: function (data) {
            noty({text: 'Enregistrement effectué' + data, layout: 'topRight', type: 'success'});
            load_produit_detail(_idprod, _nameprod);
            setTimeout(function () {
                $("#iconPreviewDetailModif").modal('hide');
            });
        }
    })
}

function getListCommande(start, end) {
    var start = start;
    var end = end;
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/list_commande.php",
        data: {
            end: end,
            start: start
        },
        dataType: "json",
        success: function (data) {
            var datas = data;
            $('#list_commande_table').dataTable({
                destroy: true,
                data: datas.data,
                "order": [[4, "desc"]],
                columns: [
                    {
                        data: "reference", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<p>"+data+ "</p>' +
                                    '<strong>"+row.nameProduit+"</strong>';
                                ;
                            }
                        }
                    },
                    {data: "prixTotal"},
                    {
                        data: "prixPercu"
                    },
                    {
                        data: "nom", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<p>"+data+ "</p>' +
                                    '<strong>"+row.prenom+"</strong>';
                                ;
                            }
                        }
                    },
                    {data: "dateVente"},
                    {
                        data: "etat", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<p>"+data+ "/</p>' +
                                    '<strong>"+row.typePaiement+"</strong>';
                                ;
                            }
                        }
                    },
                    {
                        data: "id", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<a class="btn btn-success btn-rounded btn-sm " data-toggle="tooltip" data-placement="top" title="Modifier" onclick="reimprime_ticket_caisse(' + data + ')">Imprimer ticket</a>';
                                ;
                            }
                        }
                    },
                ]
            });

        }
    });
}