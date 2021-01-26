<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 300px;
        font-size: 11px;
    }

    #chartdiv1 {
        width: 100%;
        height: 400px;
        font-size: 11px;

    }

    .amcharts-pie-slice {
        transform: scale(1);
        transform-origin: 50% 50%;
        transition-duration: 0.3s;
        transition: all .3s ease-out;
        -webkit-transition: all .3s ease-out;
        -moz-transition: all .3s ease-out;
        -o-transition: all .3s ease-out;
        cursor: pointer;
        box-shadow: 0 0 30px 0 #000;
    }

    .amcharts-pie-slice:hover {
        transform: scale(1.1);
        filter: url(#shadow);
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/serial.js"></script>

<!-- Chart Pie -->
<script>
    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "pie",
        "startDuration": 0,
        "theme": "none",
        "addClassNames": true,
        "legend": {
            "position": "right",
            "marginRight": 100,
            "autoMargins": false
        },
        "innerRadius": "30%",
        "defs": {
            "filter": [{
                "id": "shadow",
                "width": "200%",
                "height": "200%",
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": 0,
                    "dy": 0
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": 5
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }]
        },
        "dataProvider": [
            <?php foreach ($getMarketer as $row) { ?> {
                    "country": "<?php echo $row->nama_marketer; ?>",
                    "litres": <?php echo $row->jlh_marketer; ?>
                },
            <?php } ?>
        ],
        "valueField": "litres",
        "titleField": "country",
        "export": {
            "enabled": true
        }
    });


    function handleRollOver(e) {
        var wedge = e.dataItem.wedge.node;
        wedge.parentNode.appendChild(wedge);
    }
</script>


<!-- Chart Bar -->
<script>
    var chartData = [
        <?php foreach ($getMarketer1 as $b) { ?> {
                "category": "<?php echo $b->nama_marketer; ?>",
                "income": <?php echo $b->jlh_marketer; ?>,
                "url": "#",
                "description": "Klik untuk melihat detail",
                "months": [
                    <?php
                    $getDonaturProdukByMarketer = $this->M_visualisasi->getDonaturProdukByMarketer($b->nama_marketer);
                    ?>
                    <?php foreach ($getDonaturProdukByMarketer as $row) { ?> {
                            "category": "<?php echo $row->nama_produk; ?>",
                            "income": <?php echo $row->jlh_produk_donatur; ?>
                        },

                    <?php } ?>
                ]
            },
        <?php } ?>

    ];

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "/lib/3/images/",
        "autoMargins": false,
        "marginLeft": 90,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 56,
        "titles": [{
            "text": "Jumlah Donatur"
        }],
        "dataProvider": chartData,
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:13px;'> [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
            "dashLengthField": "dashLengthColumn",
            "fillAlphas": 1,
            "title": "Jumlah Donatur",
            "type": "column",
            "valueField": "income",
            "urlField": "url"
        }],
        "categoryField": "category",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0,
            "labelRotation": 45
        }
    });

    chart.addListener("clickGraphItem", function(event) {
        if ('object' === typeof event.item.dataContext.months) {

            // set the monthly data for the clicked month
            event.chart.dataProvider = event.item.dataContext.months;

            // update the chart title
            event.chart.titles[0].text = 'Produk berdasarkan Marketer ' + event.item.dataContext.category + '';

            // let's add a label to go back to yearly data
            event.chart.addLabel(
                "!10", 25,
                "Click Here to Back >>",
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
        chart.titles[0].text = 'Perkembangan Donatur Pertahun';

        // remove the "Go back" label
        chart.allLabels = [];

        chart.validateData();
        chart.animateAgain();
    }
</script>


<!-- HTML -->
<div class="right_col" role="main">
    <div class="">
        <div class="x_panel">
            <div class="x_title">
                <div class="btn-toolbar text-center">
                    <div class="btn-group btn-group-lg btn-group-solid margin-bottom-10">
                        <button type="button" style="font-size: 11px;" class="btn btn-info">Pilih Tahun</button>
                        <?php for ($i = (date('Y') - 4); $i <= date('Y'); $i++) { ?>
                            <a href="<?php print site_url(); ?>C_marketer/index/<?php print $i; ?>" type="button" style="font-size: 11px;" class="btn btn-primary"><?php print $i; ?></a>
                        <?php } ?>
                    </div>
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
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Marketer Teraktif <small>(Berdasarkan Data Tahun <?php echo $tahun; ?> )</small>
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
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Marketer Teraktif <small>(Berdasarkan Data Tahunan <?php echo $tahun; ?> )</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>