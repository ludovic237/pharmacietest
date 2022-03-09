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
            getListCommande(start.format('YYYY-MM-DD HH:mm:ss'), end.format('YYYY-MM-DD HH:mm:ss'));
        });


        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        getListCommande(moment().subtract('days', 29).format('MMMM D, YYYY'), moment().format('MMMM D, YYYY'));
    }


});

function enregistrer_list_commande(dateDerniere) {
    var date = $('#list_commande_date').val();
    var type = $('#list_commande_type option:selected').val();
    //alert(dateDerniere);
    console.log('date : ' + dateDerniere + ' - type : ' + type)
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/enregistrer_list_commande.php",
        data: {
            type: "Express",
            date: dateDerniere
        },
        //dataType: 'json',
        success: function (data) {
            //alert(data)
            noty({text: 'Enregistrement effectué' + data, layout: 'topRight', type: 'success'});
            load_produit_detail(_idprod, _nameprod);
            setTimeout(function () {
                $("#iconPreviewDetailModif").modal('hide');
            });
        }
    })
}

function getListCommande(start, end) {
    console.log('start : ' + start + ' - end : ' + end);
    //alert(start)
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
            console.log(data);

            $('#list_commande_tables').dataTable({
                destroy: true,
                searching: true,
                dFilter: false,
                bInfo: false,
                bPaginate: true,
                data: data.data,
                order: [[1, "desc"]],
                columns: [
                    {
                        data: "reference", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<strong>' + data + '</strong>' +
                                    '<p>' + row.nameProduit + '</p>';
                                ;
                            }
                        }
                    },
                    {
                        data: "prixTotal", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<p>' + data + ' FCFA</p>';
                            }
                        }
                    },
                    {
                        data: "prixPercu", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<p>' + data + ' FCFA</p>';
                            }
                        }
                    },
                    {
                        data: "nom", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<p>' + data + '</p>' +
                                    '<strong>' + row.prenom + '</strong>';
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
                                return '<p>' + data + '</p>' +
                                    '<strong>' + row.typePaiement + '</strong>';
                                ;
                            }
                        }
                    }
                ]
            });
        }
    });
}