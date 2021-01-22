var _start = moment().subtract('days', 29);
var _end = moment();
var _startCaisse = moment().subtract('days', 29);
var _endCaisse = moment();

$(document).ready(function () {
    if ($("#reportRangeDate").length > 0) {
        $("#reportRangeDate").daterangepicker({
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
            _start = start;
            _end = end;
            var a_ = start.format("YYYY-MM-DD HH:mm:ss");
            var b_ = end.format("YYYY-MM-DD HH:mm:ss");
            var type = $('#fournisseurType option:selected').val();
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/statistique.php',
                data: {
                    tab: "fournisseur",
                    type: type,
                    start: a_,
                    end: b_
                },
                // dataType: 'json',
                success: function (server_responce) {
                    if (server_responce != null) {
                        var datas = JSON.parse(server_responce);
                        var _somme = 0;
                        for (var i = 0; i < datas.data.length; i++) {
                            _somme = parseInt(datas.data[i].montantCmd) + _somme;
                        }
                        $("#grossisteTotal").html(_somme);
                        if ($.fn.dataTable.isDataTable('#tableGrossiste')) {
                            $('#tableGrossiste').dataTable({
                                destroy: true,
                                // searching: false,
                                // retrieve: true,
                                // "processing": true,
                                // "serverSide": true,
                                //dom: "Bfrtip",
                                data: datas.data,
                                columns: [
                                    {data: "code"},
                                    {data: "statut"},
                                    {data: "nom"},
                                    {data: "montantCmd"},
                                    {data: "etat"},
                                    {data: "email"},
                                    {data: "telephone"},
                                    {
                                        data: "note", "render": function (data, type, row) {
                                            if (!data) {
                                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                                            } else {
                                                return data;
                                            }
                                        }
                                    },
                                ]
                            });

                        } else {
                            $('#tableGrossiste').dataTable({
                                destroy: true,
                                // searching: false,
                                // retrieve: true,
                                // "processing": true,
                                // "serverSide": true,
                                //dom: "Bfrtip",
                                data: datas.data,
                                columns: [
                                    {data: "code"},
                                    {data: "statut"},
                                    {data: "nom"},
                                    {data: "montantCmd"},
                                    {data: "etat"},
                                    {data: "email"},
                                    {data: "telephone"},
                                    {
                                        data: "note", "render": function (data, type, row) {
                                            if (!data) {
                                                return '<span class="text-muted" style="font-size:90%">NA</span>';
                                            } else {
                                                return data;
                                            }
                                        }
                                    },
                                ]
                            });

                        }
                    }

                }
            });
            $('#reportRangeDate span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $("#reportRangeDate span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        var a_ = moment().subtract('days', 29).format('MMMM D, YYYY');
        var b_ = moment().format('MMMM D, YYYY');
        var type = $('#fournisseurType option:selected').val();
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/statistique.php',
            data: {
                tab: "fournisseur",
                type: type,
                start: a_,
                end: b_
            },
            // dataType: 'json',
            success: function (server_responce) {
                if (server_responce != null) {
                    var datas = JSON.parse(server_responce);

                    var _somme = 0;
                    for (var i = 0; i < datas.data.length; i++) {
                        _somme = parseInt(datas.data[i].montantCmd) + _somme;
                    }
                    $("#grossisteTotal").html(_somme);
                    if ($.fn.dataTable.isDataTable('#tableGrossiste')) {
                        $('#tableGrossiste').dataTable({
                            destroy: true,
                            // searching: false,
                            // retrieve: true,
                            // "processing": true,
                            // "serverSide": true,
                            //dom: "Bfrtip",
                            data: datas.data,
                            columns: [
                                {data: "code"},
                                {data: "statut"},
                                {data: "nom"},
                                {data: "montantCmd"},
                                {data: "etat"},
                                {data: "email"},
                                {data: "telephone"},
                                {
                                    data: "note", "render": function (data, type, row) {
                                        if (!data) {
                                            return '<span class="text-muted" style="font-size:90%">NA</span>';
                                        } else {
                                            return data;
                                        }
                                    }
                                },
                            ]
                        });

                    } else {
                        $('#tableGrossiste').dataTable({
                            destroy: true,
                            // searching: false,
                            // retrieve: true,
                            // "processing": true,
                            // "serverSide": true,
                            //dom: "Bfrtip",
                            data: datas.data,
                            columns: [
                                {data: "code"},
                                {data: "statut"},
                                {data: "nom"},
                                {data: "montantCmd"},
                                {data: "etat"},
                                {data: "email"},
                                {data: "telephone"},
                                {
                                    data: "note", "render": function (data, type, row) {
                                        if (!data) {
                                            return '<span class="text-muted" style="font-size:90%">NA</span>';
                                        } else {
                                            return data;
                                        }
                                    }
                                },
                            ]
                        });

                    }
                }

            }
        });
    }


    if ($("#reportRangeDateCaisse").length > 0) {
        $("#reportRangeDateCaisse").daterangepicker({
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
            _startCaisse = start;
            _endCaisse = end;
            var a_ = start.format("YYYY-MM-DD HH:mm:ss");
            var b_ = end.format("YYYY-MM-DD HH:mm:ss");
            var type = $('#dataEmploye option:selected').val();
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/statistique.php',
                data: {
                    tab: "caisse",
                    type: type,
                    start: a_,
                    end: b_
                },
                // dataType: 'json',
                success: function (server_responce) {
                    var datas = JSON.parse(server_responce);
                    $('#caisseTotal').html(datas.totalEncaisse);
                    if ($.fn.dataTable.isDataTable('#tableCaisse')) {
                        $('#tableCaisse').dataTable({
                            destroy: true,
                            // searching: false,
                            // retrieve: true,
                            // "processing": true,
                            // "serverSide": true,
                            //dom: "Bfrtip",
                            data: datas.data,
                            columns: [
                                {data: "id"},
                                {
                                    data: "user_id", "render": function (data, type, row) {
                                        if (!data) {
                                            return '<span class="text-muted" style="font-size:90%">NA</span>';
                                        } else {
                                            return '<strong >' + data + '</strong>';
                                        }
                                    }
                                },
                                {data: "session"},
                                {
                                    data: "etat", "render": function (data, type, row) {
                                        if (data == "Clot") {
                                            return '<span class="label label-success">' + data + '</span>';
                                        } else {
                                            if (data == "Ouvert") {
                                                return '<span class="label label-warning">' + data + '</span>';
                                            } else {
                                                return '<strong >' + data + '</strong>';
                                            }
                                        }
                                    }
                                },
                                {data: "fondCaisseOuvert"},
                                {data: "fondCaisseFerme"},
                                {data: "totalEncaisse"},
                                {data: "dateOuvert"},
                                {data: "dateFerme"},
                                {
                                    data: "id", "render": function (data, type, row) {
                                        if (!data) {
                                            return '<span class="text-muted" style="font-size:90%">NA</span>';
                                        } else {
                                            return '<a class="btn btn-success btn-rounded btn-sm "  onclick="showVenteCaisse(' + data + ',' + row.totalEncaisse + ')"><span class="">Voir vente</span></a>' +
                                                '<a class="btn btn-primary btn-rounded btn-sm " href="http://localhost:8000/pharmacietest/bouwou/comptabilite/caisse_rapport/' + data + '"  ><span class="">Voir rapport</span></a>';
                                            ;
                                        }
                                    }
                                },
                            ]
                        });

                    } else {
                        $('#tableCaisse').dataTable({
                            destroy: true,
                            // searching: false,
                            // retrieve: true,
                            // "processing": true,
                            // "serverSide": true,
                            //dom: "Bfrtip",
                            data: datas.data,
                            columns: [
                                {data: "id"},
                                {
                                    data: "user_id", "render": function (data, type, row) {
                                        if (!data) {
                                            return '<span class="text-muted" style="font-size:90%">NA</span>';
                                        } else {
                                            return '<strong >' + data + '</strong>';
                                        }
                                    }
                                },
                                {data: "session"},
                                {
                                    data: "etat", "render": function (data, type, row) {
                                        if (data == "Clot") {
                                            return '<span class="label label-success">' + data + '</span>';
                                        } else {
                                            if (data == "Ouvert") {
                                                return '<span class="label label-warning">' + data + '</span>';
                                            } else {
                                                return '<strong >' + data + '</strong>';
                                            }
                                        }
                                    }
                                },
                                {data: "fondCaisseOuvert"},
                                {data: "fondCaisseFerme"},
                                {data: "totalEncaisse"},
                                {data: "dateOuvert"},
                                {data: "dateFerme"},
                                {
                                    data: "id", "render": function (data, type, row) {
                                        if (!data) {
                                            return '<span class="text-muted" style="font-size:90%">NA</span>';
                                        } else {
                                            return '<a class="btn btn-success btn-rounded btn-sm "  onclick="showVenteCaisse(' + data + ',' + row.totalEncaisse + ')"><span class="">Voir vente</span></a>' +
                                                '<a class="btn btn-primary btn-rounded btn-sm " href="http://localhost:8000/pharmacietest/bouwou/comptabilite/caisse_rapport/' + data + '"  ><span class="">Voir rapport</span></a>';
                                            ;
                                        }
                                    }
                                },
                            ]
                        });

                    }

                }
            });
            $('#reportRangeDateCaisse span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $("#reportRangeDateCaisse span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        var a_ = moment().subtract('days', 29).format('MMMM D, YYYY');
        var b_ = moment().format('MMMM D, YYYY');
        var type = $('#dataEmploye option:selected').val();
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/statistique.php',
            data: {
                tab: "caisse",
                type: type,
                start: a_,
                end: b_
            },
            // dataType: 'json',
            success: function (server_responce) {
                var datas = JSON.parse(server_responce);
                $('#caisseTotal').html(datas.totalEncaisse);
                if ($.fn.dataTable.isDataTable('#tableCaisse')) {
                    $('#tableCaisse').dataTable({
                        destroy: true,
                        // searching: false,
                        // retrieve: true,
                        // "processing": true,
                        // "serverSide": true,
                        //dom: "Bfrtip",
                        data: datas.data,
                        columns: [
                            {data: "id"},
                            {
                                data: "user_id", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return '<strong >' + data + '</strong>';
                                    }
                                }
                            },
                            {data: "session"},
                            {
                                data: "etat", "render": function (data, type, row) {
                                    if (data == "Clot") {
                                        return '<span class="label label-success">' + data + '</span>';
                                    } else {
                                        if (data == "Ouvert") {
                                            return '<span class="label label-warning">' + data + '</span>';
                                        } else {
                                            return '<strong >' + data + '</strong>';
                                        }
                                    }
                                }
                            },
                            {data: "fondCaisseOuvert"},
                            {data: "fondCaisseFerme"},
                            {data: "totalEncaisse"},
                            {data: "dateOuvert"},
                            {data: "dateFerme"},
                            {
                                data: "id", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return '<a class="btn btn-success btn-rounded btn-sm "  onclick="showVenteCaisse(' + data + ',' + row.totalEncaisse + ')"><span class="">Voir vente</span></a>' +
                                            '<a class="btn btn-primary btn-rounded btn-sm " href="http://localhost:8000/pharmacietest/bouwou/comptabilite/caisse_rapport/' + data + '"  ><span class="">Voir rapport</span></a>';
                                        ;
                                    }
                                }
                            },
                        ]
                    });

                } else {
                    $('#tableCaisse').dataTable({
                        destroy: true,
                        // searching: false,
                        // retrieve: true,
                        // "processing": true,
                        // "serverSide": true,
                        //dom: "Bfrtip",
                        data: datas.data,
                        columns: [
                            {data: "id"},
                            {
                                data: "user_id", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return '<strong >' + data + '</strong>';
                                    }
                                }
                            },
                            {data: "session"},
                            {
                                data: "etat", "render": function (data, type, row) {
                                    if (data == "Clot") {
                                        return '<span class="label label-success">' + data + '</span>';
                                    } else {
                                        if (data == "Ouvert") {
                                            return '<span class="label label-warning">' + data + '</span>';
                                        } else {
                                            return '<strong >' + data + '</strong>';
                                        }
                                    }
                                }
                            },
                            {data: "fondCaisseOuvert"},
                            {data: "fondCaisseFerme"},
                            {data: "totalEncaisse"},
                            {data: "dateOuvert"},
                            {data: "dateFerme"},
                            {
                                data: "id", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return '<a class="btn btn-success btn-rounded btn-sm "  onclick="showVenteCaisse(' + data + ',' + row.totalEncaisse + ')"><span class="">Voir vente</span></a>' +
                                            '<a class="btn btn-primary btn-rounded btn-sm " href="http://localhost:8000/pharmacietest/bouwou/comptabilite/caisse_rapport/' + data + '"  ><span class="">Voir rapport</span></a>';
                                        ;
                                    }
                                }
                            },
                        ]
                    });

                }

            }
        });
    }

});

function getGroupStatistique() {
    var a_ = _start.format("YYYY-MM-DD HH:mm:ss");
    var b_ = _end.format("YYYY-MM-DD HH:mm:ss");
    var type = $('#fournisseurType option:selected').val();
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/statistique.php',
        data: {
            tab: "fournisseur",
            type: type,
            start: a_,
            end: b_
        },
        // dataType: 'json',
        success: function (server_responce) {
            if (server_responce != null) {
                var datas = JSON.parse(server_responce);

                var _somme = 0;
                for (var i = 0; i < datas.data.length; i++) {
                    _somme = parseInt(datas.data[i].montantCmd) + _somme;
                }
                $("#grossisteTotal").html(_somme);
                if ($.fn.dataTable.isDataTable('#tableGrossiste')) {
                    $('#tableGrossiste').dataTable({
                        destroy: true,
                        // searching: false,
                        // retrieve: true,
                        // "processing": true,
                        // "serverSide": true,
                        //dom: "Bfrtip",
                        data: datas.data,
                        columns: [
                            {data: "code"},
                            {data: "statut"},
                            {data: "nom"},
                            {data: "montantCmd"},
                            {data: "etat"},
                            {data: "email"},
                            {data: "telephone"},
                            {
                                data: "note", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return data;
                                    }
                                }
                            },
                        ]
                    });

                } else {
                    $('#tableGrossiste').dataTable({
                        destroy: true,
                        // searching: false,
                        // retrieve: true,
                        // "processing": true,
                        // "serverSide": true,
                        //dom: "Bfrtip",
                        data: datas.data,
                        columns: [
                            {data: "code"},
                            {data: "statut"},
                            {data: "nom"},
                            {data: "montantCmd"},
                            {data: "etat"},
                            {data: "email"},
                            {data: "telephone"},
                            {
                                data: "note", "render": function (data, type, row) {
                                    if (!data) {
                                        return '<span class="text-muted" style="font-size:90%">NA</span>';
                                    } else {
                                        return data;
                                    }
                                }
                            },
                        ]
                    });

                }
            }

        }
    });
}

function getGroupStatistiqueCaisse() {
    var a_ = _startCaisse.format("YYYY-MM-DD HH:mm:ss");
    var b_ = _endCaisse.format("YYYY-MM-DD HH:mm:ss");
    var type = $('#dataEmploye option:selected').val();
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/statistique.php',
        data: {
            tab: 'caisse',
            type: type,
            start: a_,
            end: b_
        },
        // dataType: 'json',
        success: function (server_responce) {
            var datas = JSON.parse(server_responce);
            $('#caisseTotal').html(datas.totalEncaisse);
            if ($.fn.dataTable.isDataTable('#tableCaisse')) {
                $('#tableCaisse').dataTable({
                    destroy: true,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    data: datas.data,
                    columns: [
                        {data: "id"},
                        {
                            data: "user_id", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<strong >' + data + '</strong>';
                                }
                            }
                        },
                        {data: "session"},
                        {
                            data: "etat", "render": function (data, type, row) {
                                if (data == "Clot") {
                                    return '<span class="label label-success">' + data + '</span>';
                                } else {
                                    if (data == "Ouvert") {
                                        return '<span class="label label-warning">' + data + '</span>';
                                    } else {
                                        return '<strong >' + data + '</strong>';
                                    }
                                }
                            }
                        },
                        {data: "fondCaisseOuvert"},
                        {data: "fondCaisseFerme"},
                        {data: "totalEncaisse"},
                        {data: "dateOuvert"},
                        {data: "dateFerme"},
                        {
                            data: "id", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<a class="btn btn-success btn-rounded btn-sm "  onclick="showVenteCaisse(' + data + ',' + row.totalEncaisse + ')"><span class="">Voir vente</span></a>' +
                                        '<a class="btn btn-primary btn-rounded btn-sm " href="http://localhost:8000/pharmacietest/bouwou/comptabilite/caisse_rapport/' + data + '"  ><span class="">Voir rapport</span></a>';
                                    ;
                                }
                            }
                        },
                    ]
                });

            } else {
                $('#tableCaisse').dataTable({
                    destroy: true,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    data: datas.data,
                    columns: [
                        {data: "id"},
                        {
                            data: "user_id", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<strong >' + data + '</strong>';
                                }
                            }
                        },
                        {data: "session"},
                        {
                            data: "etat", "render": function (data, type, row) {
                                if (data == "Clot") {
                                    return '<span class="label label-success">' + data + '</span>';
                                } else {
                                    if (data == "Ouvert") {
                                        return '<span class="label label-warning">' + data + '</span>';
                                    } else {
                                        return '<strong >' + data + '</strong>';
                                    }
                                }
                            }
                        },
                        {data: "fondCaisseOuvert"},
                        {data: "fondCaisseFerme"},
                        {data: "totalEncaisse"},
                        {data: "dateOuvert"},
                        {data: "dateFerme"},
                        {
                            data: "id", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<a class="btn btn-success btn-rounded btn-sm "  onclick="showVenteCaisse(' + data + ',' + row.totalEncaisse + ')"><span class="">Voir vente</span></a>' +
                                        '<a class="btn btn-primary btn-rounded btn-sm " href="http://localhost:8000/pharmacietest/bouwou/comptabilite/caisse_rapport/' + data + '"  ><span class="">Voir rapport</span></a>';
                                    ;
                                }
                            }
                        },
                    ]
                });

            }

        }
    });
}

var dataVentes = [];

function showVenteCaisse(id, total) {
    $("#totalEncaissement").html(total);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/vente_statistique.php',
        data: {
            idCaisse: id
        },
        success: function (data) {

            var datas = JSON.parse(data);
            dataVentes = datas.data;
            console.log(datas);
            $("#iconPreviewListVenteCaisse").modal('show');
            if ($.fn.dataTable.isDataTable('#tab_list_vente_caisse')) {
                $('#tab_list_vente_caisse').dataTable({
                    destroy: true,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    data: datas.data,
                    columns: [
                        {
                            data: "reference", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<p>'+data+'</p>' +
                                        '<strong>'+row.nameProduit+'</strong>';
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
                                    return '<p>'+data+' </p>' +
                                        '<strong>'+row.prenom+'</strong>';
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
                                    return '<p>'+data+'/</p>' +
                                        '<strong>'+row.typePaiement+'</strong>';
                                    ;
                                }
                            }
                        },
                        {
                            data: "id", "render": function (data, type, row) {
                                if (!data) {
                                    return '<span class="text-muted" style="font-size:90%">NA</span>';
                                } else {
                                    return '<a class="btn btn-success btn-rounded btn-sm " data-toggle="tooltip" data-placement="top" title="Modifier" onclick="reimprime_ticket_caisse('+data+')">Imprimer ticket</a>';
                                    ;
                                }
                            }
                        },
                    ]
                });

            } else {
                $('#tab_list_vente_caisse').dataTable({
                    destroy: true,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    data: datas.data,
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
                                    return '<a class="btn btn-success btn-rounded btn-sm " data-toggle="tooltip" data-placement="top" title="Modifier" onclick="reimprime_ticket_caisse('+data+')">Imprimer ticket</a>';
                                    ;
                                }
                            }
                        },
                    ]
                });

            }


        }
    });
    $("#previewImprimerBonCaisse").modal('show');
    return false;
}

function reimprime_ticket_caisse(id) {
    var dataVente_info = [];
    for (var i = 0; i < dataVentes.length; i++) {
        if (dataVentes[i].id == id){
            dataVente_info = dataVentes[i];
        }
    }

    var heure = moment(dataVente_info.dateVente).format("HH:mm");
    var date = moment(dataVente_info.dateVente).format('YYYY-MM-DD');
    //var tab = explode(" ", datevte);
    $('#ticketListe2 .reference').html(dataVente_info.reference);
    $('#ticketListe2 .datevente').html(date);
    $('#ticketListe2 .heurevente').html(heure);
    $('#ticketListe2 .vendeur').html(dataVente_info.nom);
    $('#ticketListe2 .acheteur').html(dataVente_info.client);
    $('#ticketListe2 .netapayer').html(dataVente_info.prixPercu);
    $('#ticketListe2 .montanttotal').html(dataVente_info.prixTotal);
    $('#ticketListe2 .remise').html(parseInt(dataVente_info.prixTotal) - parseInt(dataVente_info.prixPercu));



    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_vente.php',
        data: {
            id: id
        },
        success: function (server_responce) {
            $('#tab_vente_caisse').empty();
            $('#tab_BfactureImprimer2  tr').each(function (i) {
                if ($(this).attr("class") == 'ligne_facture') {
                    //alert("passe");
                    $(this).remove();
                }
            });
            $('#tab_BfactureImprimer2').prepend(server_responce);
            $('#iconPreviewFacture2').modal("show");


        }


    })


}
