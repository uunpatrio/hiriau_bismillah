<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 300px;
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
        height: 400px;
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
    var chartData = [
        <?php foreach ($segmentasiPasar as $row) { ?> {
                "category": <?php echo $row->tahun; ?>,
                "income": <?php echo $row->total_donasi; ?>,
                "url": "#",
                "description": "Klik untuk melihat detail",
                "months": [
                    <?php $segmentasiPasarByTahun = $this->M_visualisasi->segmentasiPasarByTahun($row->tahun); ?>
                    <?php foreach ($segmentasiPasarByTahun as $r) { ?> {
                            "category": "<?php echo getBulan($r->bulan); ?>",
                            "income": <?php echo $r->total_donasi; ?>
                        },
                    <?php } ?>
                ]
            },
        <?php } ?>

    ];

    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "/lib/3/images/",
        "autoMargins": false,
        "marginLeft": 90,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 56,
        "titles": [{
            "text": "Segmentasi Data Pertahun"
        }],
        "dataProvider": chartData,
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:13px;'>[[title]] Tahun [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
            "dashLengthField": "dashLengthColumn",
            "fillAlphas": 1,
            "title": "Nilai Donasi",
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
            event.chart.titles[0].text = 'Segmentasi Perbulan Tahun ' + event.item.dataContext.category + '';

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
        chart.titles[0].text = 'Yearly data';

        // remove the "Go back" label
        chart.allLabels = [];

        chart.validateData();
        chart.animateAgain();
    }
</script>

<!-- page content -->
<div class="right_col" role="main">
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
                                            <li class="fa fa-table"></li> Segmentasi Pasar<small> (Berdasarkan Donatur)</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <form action="<?php echo base_url('c_perkembangan_donatur/'); ?>" method="post">
                                    <!-- <input type="text" name="filter" id="filter"> -->
                                    <div class="col-md-5">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="filter" id="filter" style="font-size: 12px;" class="form-control ">
                                                    <option value="">Pilih Bulan</option>
                                                    <?php foreach ($getBulan as $row) { ?>
                                                        <option value="<?php echo $row->bulan ?>"><?php echo getBulan($row->bulan); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="ftahun" id="ftahun" style="font-size: 12px;" class="form-control">
                                                    <option value="">Pilih Tahun</option>
                                                    <?php foreach ($getTahun as $row) { ?>
                                                        <option value="<?php echo $row->tahun; ?>"><?php echo $row->tahun; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">
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
                                            <li class="fa fa-table"></li> Segmentasi Pasar<small> (Berdasarkan Produk)</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <form action="<?php echo base_url('c_perkembangan_donatur/'); ?>" method="post">
                                    <!-- <input type="text" name="filter" id="filter"> -->
                                    <div class="col-md-5">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="filter" id="filter" style="font-size: 12px;" class="form-control ">
                                                    <option value="">Pilih Bulan</option>
                                                    <?php foreach ($getBulan as $row) { ?>
                                                        <option value="<?php echo $row->bulan ?>"><?php echo getBulan($row->bulan); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="ftahun" id="ftahun" style="font-size: 12px;" class="form-control">
                                                    <option value="">Pilih Tahun</option>
                                                    <?php foreach ($getTahun as $row) { ?>
                                                        <option value="<?php echo $row->tahun; ?>"><?php echo $row->tahun; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <li class="fa fa-search"></li> Search
                                    </button>

                                </form>
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Segmentasi Pasar <small>(Berdasarkan Data Tahunan)</small>
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