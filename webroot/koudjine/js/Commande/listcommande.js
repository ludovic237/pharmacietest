$(document).ready(function () {
    var table_list_commande = $('#list_commande_table').dataTable();
    var new_list_commande_date = $('#new_list_commande_date').dataTable();
    charger_list_commande('','')

    // if ($("#reportrange").length > 0) {
    //     $("#reportrange").daterangepicker({
    //         ranges: {
    //             'Today': [moment(), moment()],
    //             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //             'This Month': [moment().startOf('month'), moment().endOf('month')],
    //             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //         },
    //         opens: 'left',
    //         buttonClasses: ['btn btn-default'],
    //         applyClass: 'btn-small btn-primary',
    //         cancelClass: 'btn-small',
    //         format: 'MM.DD.YYYY',
    //         separator: ' to ',
    //         startDate: moment().subtract('days', 29),
    //         endDate: moment()
    //     }, function (start, end) {
    //         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    //         getListCommande(start.format('YYYY-MM-DD HH:mm:ss'), end.format('YYYY-MM-DD HH:mm:ss'));
    //     });
    //
    //
    //     $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    //     getListCommande(moment().subtract('days', 29).format('MMMM D, YYYY'), moment().format('MMMM D, YYYY'));
    // }


});

function recherche_list_commande(a_,b_) {
    console.log(a_ + ' - ' + b_);
    if (b_===""){
        b_ = moment().format('YYYY-MM-DD HH:mm:ss')
        getListCommande(a_,b_);
    }
    else {
        getListCommande(a_,b_);
    }

}

function enregistrer_list_commande(dateDerniere) {
    var date = $('#list_commande_date').val();
    var type = $('#list_commande_type option:selected').val();
    //alert(dateDerniere);
    console.log('date : ' + dateDerniere + ' - type : ' + type)
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/enregistrer_list_commande.php",
        data: {
            type: "ListeCommande",
            date: moment().format("YYYY-MM-DD HH:mm:ss")
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

function charger_list_commande(start, end) {
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/load_list_commande.php",
        data: {
            start: start,
            end: end
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#new_list_commande_date').dataTable({
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
                data: data.data,
                order: [[1, "desc"]],
                columns: [
                    {
                        data: "venteId", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "nom", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "concernerQuantite", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "enrayQuantiteRayon", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "enrayDateLivraison", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "fournisseurNom", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                ]
            });
            $('#new_list_commande_ligne').dataTable({
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
                data: data.ligne,
                order: [[1, "desc"]],
                columns: [
                    {
                        data: "id", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "type", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "dateDebut", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "dateDerniere", "render": function (data, type, row) {
                            if (!data) {
                                return '<span class="text-muted" style="font-size:90%"></span>';
                            } else {
                                return '<strong>' + data + '</strong>';
                            }
                        }
                    },
                    {
                        data: "dateDerniere", "render": function (data, type, row) {
                            var start = row.dateDebut;
                            var end = row.dateDerniere;
                            if(start == ''){
                                start = '1900-01-01 00:00:00';
                            }else if (end == ''){
                                end=moment().format("YYYY-MM-DD HH:mm:ss");
                            }
                                return '<button class="dt-button buttons-copy buttons-html5 btn btn-success" onclick="charger_list_commande(\''+start+'\',\''+end+'\')" tabindex="0" type="button"><span>Charger</span></button>';
                        }
                    },
                ]
            });
            //alert(data)
            /*noty({text: 'Enregistrement effectué' + data, layout: 'topRight', type: 'success'});
            load_produit_detail(_idprod, _nameprod);
            setTimeout(function () {
                $("#iconPreviewDetailModif").modal('hide');
            });*/
        }
    })
}

function getListCommande(start, end) {
    //console.log('start : ' + start + ' - end : ' + end);
    //alert(start)
    var start = start;
    var end = end;
    //console.log('pass')
    //console.log(start);
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
                buttons:[
                    {extend:'copyHtml5',className: 'btn btn-success', messageTop:"hello"},
                    {extend:'excelHtml5',className: 'btn btn-success', messageTop:"hello"},
                    {extend:'csvHtml5',className: 'btn btn-success', messageTop:"hello"},
                    {extend:'pdfHtml5',className: 'btn btn-success'}
                ],
                // exportOptions: {
                //     modifier : {
                //         order : 'index', // 'current', 'applied','index', 'original'
                //         page : 'all', // 'all', 'current'
                //         search : 'none' // 'none', 'applied', 'removed'
                //     },
                //     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                // },
                dom:'Bfrtip',
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
    $.ajax({
        type: "POST",
        url: "/pharmacietest/koudjine/inc/list_commande_prdt.php",
        data: {
            end: end,
            start: start
        },
        dataType: "json",
        success: function (data) {
            console.log(data);

            $('#list_commande_tables_1').dataTable({
                buttons:[
                    {extend:'copyHtml5',className: 'btn btn-success', messageTop:"hello"},
                    {extend:'excelHtml5',className: 'btn btn-success', messageTop:"hello"},
                    {extend:'csvHtml5',className: 'btn btn-success', messageTop:"hello"},
                    {extend:'pdfHtml5',className: 'btn btn-success', messageTop:"hello"},
                ],
                dom:'Bfrtip',
                destroy: true,
                searching: true,
                dFilter: false,
                bInfo: false,
                bPaginate: true,
                data: data.data,
                order: [[1, "desc"]],
                columns: [
                    {data: "ref"},
                    {data: "nom"},
                    {data: "qtiteCmd"},
                    {data: "qtiteCmd"},
                    {data: "dateLivraison"},
                    {data: "fournisseurName"},
                ]
            });
        }
    });
}