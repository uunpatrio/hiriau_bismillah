<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 400px;
    }

    .amcharts-export-menu-top-right {
        top: 10px;
        right: 0;
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!-- Bagian Segmentasi Pasar -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "marginRight": 70,
        "dataProvider": [
            <?php foreach ($getdataperkembangan as $row) { ?> {
                    "country": "<?php echo $row->segmentasi_pasar; ?>",
                    "visits": <?php echo $row->tot_nilai_donasi; ?>,
                    "color": "#FF0F00, #FF0F01",
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Perkembangan Donatur"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 60
        },
        "export": {
            "enabled": true
        }

    });
</script>


<!-- Bagian Perkembangan Donasi -->
<!-- Styles -->
<style>
    #chartdiv1 {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!-- Chart code -->
<script>
    var chartData = [{
            "category": 2009,
            "income": 23.5,
            "url": "#",
            "description": "click to drill-down",
            "months": [{
                    "category": 1,
                    "income": 1
                },
                {
                    "category": 2,
                    "income": 2
                },
                {
                    "category": 3,
                    "income": 1
                },
                {
                    "category": 4,
                    "income": 3
                },
                {
                    "category": 5,
                    "income": 2.5
                },
                {
                    "category": 6,
                    "income": 1.1
                },
                {
                    "category": 7,
                    "income": 2.9
                },
                {
                    "category": 8,
                    "income": 3.5
                },
                {
                    "category": 9,
                    "income": 3.1
                },
                {
                    "category": 10,
                    "income": 1.1
                },
                {
                    "category": 11,
                    "income": 1
                },
                {
                    "category": 12,
                    "income": 3
                }
            ]
        }, {
            "category": 2010,
            "income": 26.2,
            "url": "#",
            "description": "click to drill-down",
            "months": [{
                    "category": 1,
                    "income": 4
                },
                {
                    "category": 2,
                    "income": 3
                },
                {
                    "category": 3,
                    "income": 1
                },
                {
                    "category": 4,
                    "income": 4
                },
                {
                    "category": 5,
                    "income": 2
                },
                {
                    "category": 6,
                    "income": 1
                },
                {
                    "category": 7,
                    "income": 2
                },
                {
                    "category": 8,
                    "income": 2
                },
                {
                    "category": 9,
                    "income": 3
                },
                {
                    "category": 10,
                    "income": 1
                },
                {
                    "category": 11,
                    "income": 1
                },
                {
                    "category": 12,
                    "income": 3
                }
            ]
        }, {
            "category": 2011,
            "income": 30.1,
            "url": "#",
            "description": "click to drill-down",
            "months": [{
                    "category": 1,
                    "income": 2
                },
                {
                    "category": 2,
                    "income": 3
                },
                {
                    "category": 3,
                    "income": 1
                },
                {
                    "category": 4,
                    "income": 5
                },
                {
                    "category": 5,
                    "income": 2
                },
                {
                    "category": 6,
                    "income": 1
                },
                {
                    "category": 7,
                    "income": 2
                },
                {
                    "category": 8,
                    "income": 2.5
                },
                {
                    "category": 9,
                    "income": 3.1
                },
                {
                    "category": 10,
                    "income": 1.1
                },
                {
                    "category": 11,
                    "income": 1
                },
                {
                    "category": 12,
                    "income": 3
                }
            ]
        }

    ];

    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "/lib/3/images/",
        "autoMargins": false,
        "marginLeft": 30,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "titles": [{
            "text": "Yearly data"
        }],
        "dataProvider": chartData,
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
            "dashLengthField": "dashLengthColumn",
            "fillAlphas": 1,
            "title": "Income",
            "type": "column",
            "valueField": "income",
            "urlField": "url"
        }],
        "categoryField": "category",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        }
    });

    chart.addListener("clickGraphItem", function(event) {
        if ('object' === typeof event.item.dataContext.months) {

            // set the monthly data for the clicked month
            event.chart.dataProvider = event.item.dataContext.months;

            // update the chart title
            event.chart.titles[0].text = event.item.dataContext.category + ' monthly data';

            // let's add a label to go back to yearly data
            event.chart.addLabel(
                "!10", 25,
                "Go back to yearly >",
                "right",
                undefined,
                undefined,
                undefined,
                undefined,
                true,
                'javascript:resetChart();');

            // validate the new data and make the chart animate again
            event.chart.validateData();
            event.chart.animateAgain();
        }
    });

    // function which resets the chart back to yearly data
    function resetChart() {
        chart.dataProvider = chartData;
        chart.titles[0].text = 'Yearly data';

        // remove the "Go back" label
        chart.allLabels = [];

        chart.validateData();
        chart.animateAgain();
    }
</script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row" style="display: inline-block;">
        <div class="top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <div class="count">179</div> <br>
                    <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-comments-o"></i></div>
                    <div class="count">179</div>
                    <br>
                    <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                    <div class="count">179</div>
                    <br>
                    <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check-square-o"></i></div>
                    <div class="count">179</div>
                    <br>
                    <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class=" btn-group-sm" role="group" aria-label="...">
                    <button class="btn btn-primary" type="button"><span class="fa fa-line-chart"></span> Target Pencapaian (KPI)</button>
                </div>
                <ul class="nav navbar-left panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="title-right">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Segmentasi Pasar <small>(Data ditampilkan berdasarkan data saat ini.)</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <form action="<?php echo base_url('home/'); ?>" method="post">
                                    <!-- <input type="text" name="filter" id="filter"> -->
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="filter" id="filter" class="form-control">
                                                    <option value="">Pilih Bulan</option>
                                                    <option value="1">Januari</option>
                                                    <option value="2">Februari</option>
                                                    <option value="3">Maret</option>
                                                    <option value="4">April</option>
                                                    <option value="5">Mei</option>
                                                    <option value="6">Juni</option>
                                                    <option value="7">July</option>
                                                    <option value="8">Agustus</option>
                                                    <option value="9">September</option>
                                                    <option value="10">Okteber</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="ftahun" id="ftahun" class="form-control">
                                                    <option value="">Pilih Tahun</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <li class="fa fa-search"></li> Search
                                    </button>

                                </form>
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Segmentasi Pasar <small>(Data ditampilkan berdasarkan data saat ini.)</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="chartdiv1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>