var _start;
var _end;

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
                    type: type,
                    start: a_,
                    end: b_
                },
                // dataType: 'json',
                success: function (server_responce) {
                    if (server_responce != null) {
                        var datas = JSON.parse(server_responce);
                        console.log(datas.data)
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

    getGroupStatistique();
});

function getGroupStatistique() {
    var a_ = _start.format("YYYY-MM-DD HH:mm:ss");
    var b_ = _end.format("YYYY-MM-DD HH:mm:ss");
    var type = $('#fournisseurType option:selected').val();
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/statistique.php',
        data: {
            type: type,
            start: a_,
            end: b_
        },
        // dataType: 'json',
        success: function (server_responce) {
            if (server_responce != null) {
                var datas = JSON.parse(server_responce);
                console.log(datas.data)
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
