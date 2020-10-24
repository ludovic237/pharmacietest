$(document).ready(function() {
    var datas;
    var startDate = moment().subtract('days', 29);
    var endDate = moment();
    var a_ = startDate.format("YYYY-MM-DD HH:mm:ss");
    var b_ = endDate.format("YYYY-MM-DD HH:mm:ss");
    console.log(a_ + ' - ' + b_);
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/dashboard_info_today.php',
        data: {
            start: a_,
            end: b_
        },
        dataType: 'json',
        success: function (server_responce) {
            console.log(server_responce);
            console.log(server_responce.con);
            assurance = server_responce.assurance.total;
            comptant = server_responce.comptant.total;
            credit = server_responce.credit.total;
            if ($.fn.dataTable.isDataTable('#tableProduitVendu')) {
                $('#tableProduitVendu').dataTable({
                    destroy: true,
                    order:[[1,"desc"]],
                    data:  server_responce.con,
                    columns: [
                        { data: 'nom' },
                        { data: 'qte' },
                        { data: 'quantiteRestante' },
                    ]
                });
                $('#tableEmployeVendu').dataTable({
                    order:[[1,"desc"]],
                    destroy: true,
                    data:  server_responce.empl,
                    columns: [
                        { data: 'identifiant' },
                        { data: 'totalqte' },
                        { data: 'type' },
                    ]
                });
    
            }
            else {
                $('#tableProduitVendu').dataTable({
                    destroy: true,
                    order:[[1,"desc"]],
                    data:  server_responce.con,
                    columns: [
                        { con: 'nom' },
                        { con: 'qte' },
                        { con: 'type' },
                    ]
                });
                $('#tableEmployeVendu').dataTable({
                    order:[[1,"desc"]],
                    destroy: true,
                    data:  server_responce.empl,
                    columns: [
                        { data: 'identifiant' },
                        { data: 'totalqte' },
                        { data: 'quantiteRestante' },
                    ]
                });
            };
            $("#dashboard-donut-1").empty();
            Morris.Donut({
                element: 'dashboard-donut-1',
                data: [
                    { label: "Assurance", value: assurance },
                    { label: "credit", value: credit },
                    { label: "Comptant", value: comptant }
                ],
                colors: ['#33414E', '#3FBAE4', '#FEA223'],
                resize: true
            });

            $('#nbrVente').html(server_responce.venteTotal).show();
            $('#nbrProduit').html(server_responce.quantiteTotal).show();
            $('#beneficeTotal').html(server_responce.beneficeTotal).show();
            $('#beneficeTotalRange').html(server_responce.beneficeTotalRange).show();;
        }


    });
} );
$(function () {
    var assurance ;
    var credit ;
    var comptant ;
    /* reportrange */
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
            var a_ = start.format("YYYY-MM-DD HH:mm:ss");
            var b_ = end.format("YYYY-MM-DD HH:mm:ss");
            console.log(a_ + ' - ' + b_);
            $.ajax({
                type: "POST",
                url: '/pharmacietest/koudjine/inc/dashboard_info_today.php',
                data: {
                    start: a_,
                    end: b_
                },
                dataType: 'json',
                success: function (server_responce) {
                    console.log(server_responce);
                    console.log(server_responce.con);
                    assurance = server_responce.assurance.total;
                    comptant = server_responce.comptant.total;
                    credit = server_responce.credit.total;
                    if ($.fn.dataTable.isDataTable('#tableProduitVendu')) {
                        $('#tableProduitVendu').dataTable({
                            destroy: true,
                            order:[[1,"desc"]],
                            data:  server_responce.con,
                            columns: [
                                { data: 'nom' },
                                { data: 'qte' },
                                { data: 'quantiteRestante' },
                            ]
                        });
                        $('#tableEmployeVendu').dataTable({
                            order:[[1,"desc"]],
                            destroy: true,
                            data:  server_responce.empl,
                            columns: [
                                { data: 'identifiant' },
                                { data: 'totalqte' },
                                { data: 'type' },
                            ]
                        });
            
                    }
                    else {
                        $('#tableProduitVendu').dataTable({
                            destroy: true,
                            order:[[1,"desc"]],
                            data:  server_responce.con,
                            columns: [
                                { data: 'nom' },
                                { data: 'qte' },
                                { data: 'quantiteRestante' },
                            ]
                        });
                        $('#tableEmployeVendu').dataTable({
                            order:[[1,"desc"]],
                            destroy: true,
                            data:  server_responce.empl,
                            columns: [
                                { data: 'identifiant' },
                                { data: 'totalqte' },
                                { data: 'type' },
                            ]
                        });
            
                    }
                    $("#dashboard-donut-1").empty();
                    Morris.Donut({
                        element: 'dashboard-donut-1',
                        data: [
                            { label: "Assurance", value: assurance },
                            { label: "credit", value: credit },
                            { label: "Comptant", value: comptant }
                        ],
                        colors: ['#33414E', '#3FBAE4', '#FEA223'],
                        resize: true
                    });

                    $('#nbrVente').html(server_responce.venteTotal).show();
                    $('#nbrProduit').html(server_responce.quantiteTotal).show();
                    $('#beneficeTotal').html(server_responce.beneficeTotal).show();
                    $('#beneficeTotalRange').html(server_responce.beneficeTotalRange).show();
                }


            });
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }
    /* end reportrange */

    /*/!* Rickshaw dashboard chart *!/
    var seriesData = [[], []];
    var random = new Rickshaw.Fixtures.RandomData(1000);

    for (var i = 0; i < 100; i++) {
        random.addData(seriesData);
    }

    var rdc = new Rickshaw.Graph({
        element: document.getElementById("dashboard-chart"),
        renderer: 'area',
        width: $("#dashboard-chart").width(),
        height: 250,
        series: [{ color: "#33414E", data: seriesData[0], name: 'New' },
        { color: "#3FBAE4", data: seriesData[1], name: 'Returned' }]
    });

    rdc.render();

    var legend = new Rickshaw.Graph.Legend({ graph: rdc, element: document.getElementById('dashboard-legend') });
    var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({ graph: rdc, legend: legend });
    var order = new Rickshaw.Graph.Behavior.Series.Order({ graph: rdc, legend: legend });
    var highlight = new Rickshaw.Graph.Behavior.Series.Highlight({ graph: rdc, legend: legend });

    var rdc_resize = function () {
        rdc.configure({
            width: $("#dashboard-chart").width(),
            height: $("#dashboard-chart").height()
        });
        rdc.render();
    }

    var hoverDetail = new Rickshaw.Graph.HoverDetail({ graph: rdc });

    window.addEventListener('resize', rdc_resize);

    rdc_resize();
    /!* END Rickshaw dashboard chart *!/*/

    /* Donut dashboard chart */
    // Morris.Donut({
    //     element: 'dashboard-donut-1',
    //     data: [
    //         { label: "Assurance", value: assurance },
    //         { label: "credit", value: credit },
    //         { label: "Comptant", value: comptant }
    //     ],
    //     colors: ['#33414E', '#3FBAE4', '#FEA223'],
    //     resize: true
    // });
    /* END Donut dashboard chart */

    /!* Bar dashboard chart *!/
    Morris.Bar({
        element: 'dashboard-bar-1',
        data: [
            { y: 'Oct 10', a: 75, b: 35 },
            { y: 'Oct 11', a: 64, b: 26 },
            { y: 'Oct 12', a: 78, b: 39 },
            { y: 'Oct 13', a: 82, b: 34 },
            { y: 'Oct 14', a: 86, b: 39 },
            { y: 'Oct 15', a: 94, b: 40 },
            { y: 'Oct 16', a: 96, b: 41 },
            { y: 'Oct 17', a: 75, b: 35 },
            { y: 'Oct 18', a: 64, b: 26 },
            { y: 'Oct 19', a: 78, b: 39 },
            { y: 'Oct 20', a: 82, b: 34 },
            { y: 'Oct 21', a: 86, b: 39 },
            { y: 'Oct 22', a: 94, b: 40 },
            { y: 'Oct 23', a: 96, b: 41 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['New Users', 'Returned'],
        barColors: ['#33414E', '#3FBAE4'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
    });
    /!* END Bar dashboard chart *!/

    /* Line dashboard chart */
    Morris.Line({
        element: 'dashboard-line-1',
        data: [
            { y: '2014-10-10', a: 2, b: 4 },
            { y: '2014-10-11', a: 4, b: 6 },
            { y: '2014-10-12', a: 7, b: 10 },
            { y: '2014-10-13', a: 5, b: 7 },
            { y: '2014-10-14', a: 6, b: 9 },
            { y: '2014-10-15', a: 9, b: 12 },
            { y: '2014-10-16', a: 18, b: 20 },
            { y: '2014-10-10', a: 2, b: 4 },
            { y: '2014-10-11', a: 4, b: 6 },
            { y: '2014-10-12', a: 7, b: 10 },
            { y: '2014-10-13', a: 5, b: 7 },
            { y: '2014-10-14', a: 6, b: 9 },
            { y: '2014-10-15', a: 9, b: 12 },
            { y: '2014-10-16', a: 18, b: 20 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Sales', 'Event'],
        resize: true,
        hideHover: true,
        xLabels: 'day',
        gridTextSize: '10px',
        lineColors: ['#3FBAE4', '#33414E'],
        gridLineColor: '#E5E5E5'
    });
    /* EMD Line dashboard chart */

    /* Vector Map */
    var jvm_wm = new jvm.WorldMap({
        container: $('#dashboard-map-seles'),
        map: 'world_mill_en',
        backgroundColor: '#FFFFFF',
        regionsSelectable: true,
        regionStyle: {
            selected: { fill: '#B64645' },
            initial: { fill: '#33414E' }
        },
        markerStyle: {
            initial: {
                fill: '#3FBAE4',
                stroke: '#3FBAE4'
            }
        },
        markers: [{ latLng: [50.27, 30.31], name: 'Kyiv - 1' },
        { latLng: [52.52, 13.40], name: 'Berlin - 2' },
        { latLng: [48.85, 2.35], name: 'Paris - 1' },
        { latLng: [51.51, -0.13], name: 'London - 3' },
        { latLng: [40.71, -74.00], name: 'New York - 5' },
        { latLng: [35.38, 139.69], name: 'Tokyo - 12' },
        { latLng: [37.78, -122.41], name: 'San Francisco - 8' },
        { latLng: [28.61, 77.20], name: 'New Delhi - 4' },
        { latLng: [39.91, 116.39], name: 'Beijing - 3' }]
    });
    /* END Vector Map */


    $(".x-navigation-minimize").on("click", function () {
        setTimeout(function () {
            rdc_resize();
        }, 200);
    });


});

