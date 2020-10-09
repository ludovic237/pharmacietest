$(function () {
    var assurance = 1;
    var credit = 1;
    var comptant = 1;
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

        }, function (start, end) {
            var idemploye = $('#dataEmploye option:selected').val();

            if (idemploye == 0) {
                
                var a_ = start.format("YYYY-MM-DD HH:mm:ss");
                var b_ = end.format("YYYY-MM-DD HH:mm:ss");
                console.log("a");
                $.ajax({
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/vente_info_today.php',
                    data: {
                        start: a_,
                        end: b_,
                        idemploye: 0
                    },
                    // dataType: 'json',
                    success: function (server_responce) {
                        console.log(server_responce);
                        $('#tab_employe_id').html(server_responce);

                    }


                });
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            else {
                var a_ = start.format("YYYY-MM-DD HH:mm:ss");
                var b_ = end.format("YYYY-MM-DD HH:mm:ss");
                console.log("b");
                $.ajax({
                    type: "POST",
                    url: '/pharmacietest/koudjine/inc/vente_info_today.php',
                    data: {
                        start: a_,
                        end: b_,
                        idemploye: idemploye
                    },
                    // dataType: 'json',
                    success: function (server_responce) {
                        console.log(server_responce);
                        $('#tab_employe_id').html(server_responce);

                    }


                });
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

        });

        $("#reportrange span").html();
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
    // /* END Donut dashboard chart */

    // /!* Bar dashboard chart *!/
    // Morris.Bar({
    //     element: 'dashboard-bar-1',
    //     data: [
    //         { y: 'Oct 10', a: 75, b: 35 },
    //         { y: 'Oct 11', a: 64, b: 26 },
    //         { y: 'Oct 12', a: 78, b: 39 },
    //         { y: 'Oct 13', a: 82, b: 34 },
    //         { y: 'Oct 14', a: 86, b: 39 },
    //         { y: 'Oct 15', a: 94, b: 40 },
    //         { y: 'Oct 16', a: 96, b: 41 }
    //     ],
    //     xkey: 'y',
    //     ykeys: ['a', 'b'],
    //     labels: ['New Users', 'Returned'],
    //     barColors: ['#33414E', '#3FBAE4'],
    //     gridTextSize: '10px',
    //     hideHover: true,
    //     resize: true,
    //     gridLineColor: '#E5E5E5'
    // });
    // /!* END Bar dashboard chart *!/

    // /* Line dashboard chart */
    // Morris.Line({
    //     element: 'dashboard-line-1',
    //     data: [
    //         { y: '2014-10-10', a: 2, b: 4 },
    //         { y: '2014-10-11', a: 4, b: 6 },
    //         { y: '2014-10-12', a: 7, b: 10 },
    //         { y: '2014-10-13', a: 5, b: 7 },
    //         { y: '2014-10-14', a: 6, b: 9 },
    //         { y: '2014-10-15', a: 9, b: 12 },
    //         { y: '2014-10-16', a: 18, b: 20 }
    //     ],
    //     xkey: 'y',
    //     ykeys: ['a', 'b'],
    //     labels: ['Sales', 'Event'],
    //     resize: true,
    //     hideHover: true,
    //     xLabels: 'day',
    //     gridTextSize: '10px',
    //     lineColors: ['#3FBAE4', '#33414E'],
    //     gridLineColor: '#E5E5E5'
    // });
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
