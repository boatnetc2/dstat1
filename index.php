<?php
require 'config/config.php';
$dataName = ($zone == 'EU') ? (($lang == 'FR') ? "Octets" : "Bytes") : 'Bits';
$requestLang = ($lang == 'EU') ? 'Requetes' : 'Requests';
$perSecondLang = ($lang == 'EU') ? 'par seconde' : 'per second';
?>
<title><?php echo $sitename; ?></title>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sitename; ?></title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
        }
        #layer7 {
            background-color: #1e1e1e;
            border: 1px solid #333;
            padding: 10px;
            margin-bottom: 20px;
        }
        /* ẩn layer4 */
        #layer4 {
            display: none;
        }
        .highcharts-background {
            fill: #1e1e1e !important;
        }
        .highcharts-title, .highcharts-legend-item text {
            fill: #e0e0e0 !important;
        }
        .highcharts-axis-line, .highcharts-axis-title {
            stroke: #e0e0e0 !important;
        }
        .highcharts-xaxis-labels, .highcharts-yaxis-labels {
            fill: #e0e0e0 !important;
        }
    </style>
    <?php error_log(" \r\n", 3, 'data/layer7-logs'); ?>
</head>
<body>
<div id="layer7"></div>
<br/>
<div id="layer4"></div>
<br/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.2/highcharts.js"
        integrity="sha512-PpL09bLaSaj5IzGNx6hsnjiIeLm9bL7Q9BB4pkhEvQSbmI0og5Sr/s7Ns/Ax4/jDrggGLdHfa9IbsvpnmoZYFA=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.2/modules/exporting.min.js"
        integrity="sha512-DuFO4JhOrZK4Zz+4K0nXseP0K/daLNCrbGjSkRzK+Zibkblwqc0BYBQ1sTN7mC4Kg6vNqr8eMZwLgTcnKXF8mg=="
        crossorigin="anonymous"></script>

<script id="source" language="javascript" type="text/javascript">
    $(document).ready(function () {
        Highcharts.createElement(
            "link",
            {
                href: "https://fonts.googleapis.com/css?family=Unica+One",
                rel: "stylesheet",
                type: "text/css",
            },
            null,
            document.getElementsByTagName("head")[0]
        );

        Highcharts.theme = {
            colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
                "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
            chart: {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                    stops: [
                        [0, '#2a2a2b'],
                        [1, '#3e3e40']
                    ]
                },
                style: {
                    fontFamily: '\'Unica One\', sans-serif'
                },
                plotBorderColor: '#606063'
            },
            title: {
                style: {
                    color: '#E0E0E3',
                    textTransform: 'uppercase',
                    fontSize: '20px'
                }
            },
            subtitle: {
                style: {
                    color: '#E0E0E3',
                    textTransform: 'uppercase'
                }
            },
            xAxis: {
                gridLineColor: '#707073',
                labels: {
                    style: {
                        color: '#E0E0E3'
                    }
                },
                lineColor: '#707073',
                minorGridLineColor: '#505053',
                tickColor: '#707073',
                title: {
                    style: {
                        color: '#A0A0A3'
                    }
                }
            },
            yAxis: {
                gridLineColor: '#707073',
                labels: {
                    style: {
                        color: '#E0E0E3'
                    }
                },
                lineColor: '#707073',
                minorGridLineColor: '#505053',
                tickColor: '#707073',
                tickWidth: 1,
                title: {
                    style: {
                        color: '#A0A0A3'
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.85)',
                style: {
                    color: '#F0F0F0'
                }
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        color: '#F0F0F3'
                    },
                    marker: {
                        lineColor: '#333'
                    }
                },
                boxplot: {
                    fillColor: '#505053'
                },
                candlestick: {
                    lineColor: 'white'
                },
                errorbar: {
                    color: 'white'
                }
            },
            legend: {
                itemStyle: {
                    color: '#E0E0E3'
                },
                itemHoverStyle: {
                    color: '#FFF'
                },
                itemHiddenStyle: {
                    color: '#606063'
                }
            },
            credits: {
                style: {
                    color: '#666'
                }
            },
            labels: {
                style: {
                    color: '#707073'
                }
            },

            drilldown: {
                activeAxisLabelStyle: {
                    color: '#F0F0F3'
                },
                activeDataLabelStyle: {
                    color: '#F0F0F3'
                }
            },

            navigation: {
                buttonOptions: {
                    symbolStroke: '#DDDDDD',
                    theme: {
                        fill: '#505053'
                    }
                }
            },

            // scroll charts
            rangeSelector: {
                buttonTheme: {
                    fill: '#505053',
                    stroke: '#000000',
                    style: {
                        color: '#CCC'
                    },
                    states: {
                        hover: {
                            fill: '#707073',
                            stroke: '#000000',
                            style: {
                                color: 'white'
                            }
                        },
                        select: {
                            fill: '#000003',
                            stroke: '#000000',
                            style: {
                                color: 'white'
                            }
                        }
                    }
                },
                inputBoxBorderColor: '#505053',
                inputStyle: {
                    backgroundColor: '#333',
                    color: 'silver'
                },
                labelStyle: {
                    color: 'silver'
                }
            },

            navigator: {
                handles: {
                    backgroundColor: '#666',
                    borderColor: '#AAA'
                },
                outlineColor: '#CCC',
                maskFill: 'rgba(255,255,255,0.1)',
                series: {
                    color: '#7798BF',
                    lineColor: '#A6C7ED'
                },
                xAxis: {
                    gridLineColor: '#505053'
                }
            },

            scrollbar: {
                barBackgroundColor: '#808083',
                barBorderColor: '#808083',
                buttonArrowColor: '#CCC',
                buttonBackgroundColor: '#606063',
                buttonBorderColor: '#606063',
                rifleColor: '#FFF',
                trackBackgroundColor: '#404043',
                trackBorderColor: '#404043'
            }
        };

        Highcharts.setOptions(Highcharts.theme);

        let layer7 = new Highcharts.Chart({
            chart: {
                renderTo: "layer7",
                type: "spline",
                events: {
                    load: requestData(0),
                },
            },
            title: {
                text: "<?php echo $Layer7Title;?>",
            },
            xAxis: {
                type: "datetime",
                tickPixelInterval: 150,
                maxZoom: 20 * 1000,
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: "<?php echo $requestLang;?> <?php echo $perSecondLang;?>",
                    margin: 80,
                },
            },
            series: [
                {
                    name: "<?php echo $requestLang;?>/s",
                    data: [],
                },
            ],
        });

        let layer4 = new Highcharts.Chart({
            chart: {
                renderTo: "layer4",
                type: "spline",
                events: {
                    load: requestData(1),
                },
            },
            title: {
                text: "<?php echo $Layer4Title;?>",
            },
            xAxis: {
                type: "datetime",
                tickPixelInterval: 150,
                maxZoom: 20 * 1000,
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: "<?php echo $dataName;?> <?php echo $perSecondLang;?>",
                    margin: 80,
                },
            },
            series: [
                {
                    name: "<?php echo $dataName;?>/s",
                    data: [],
                },
            ],
        });

        function requestData(type) {
            $.ajax({
                url: "data/" + (!type ? "layer7" : "layer4") + ".php",
                success: function (point) {
                    var series = (!type ? layer7 : layer4).series[0],
                        shift = series.data.length > 20;
                    series.addPoint(point, true, shift);
                    setTimeout(() => requestData(type), 1000);
                },
                cache: false,
            });
        }
    });
</script>
</body>
</html>
