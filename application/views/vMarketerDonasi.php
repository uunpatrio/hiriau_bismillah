<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 300px;
    }

    #chartdiv1 {
        width: 100%;
        height: 400px;
    }

    #chartdiv2 {
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

<!-- Bagian Donasi -->
<script>
    var chartData1 = [
        <?php foreach ($segmentasiPasar as $row) { ?> {
                "category": <?php echo $row->tahun; ?>,
                "income": <?php echo ($row->total_donasi); ?>,
                "labelIncome": "<?php echo rupiah_format(($row->total_donasi)); ?>",
                "url": "#",
                "description": "Klik untuk melihat detail",
                "months": [
                    <?php $segmentasiPasarByTahun = $this->M_visualisasi->segmentasiPasarByTahun($row->tahun); ?>
                    <?php foreach ($segmentasiPasarByTahun as $r) { ?> {
                            "category": "<?php echo getBulan($r->bulan); ?>",
                            "income": <?php echo $r->total_donasi; ?>,
                            "labelIncome": "<?php echo rupiah_format(($r->total_donasi)); ?>",

                        },
                    <?php } ?>
                ]
            },
        <?php } ?>
    ];

    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "theme": "none",
        // "pathToImages": "/lib/3/images/",
        "autoMargins": false,
        "marginLeft": 90,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 56,
        "titles": [{
            "text": "Data Donasi Pertahun"
        }],
        "dataProvider": chartData1,
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:13px;'>[[title]] Tahun [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
            "dashLengthField": "dashLengthColumn",
            "fillAlphas": 1,
            "title": "Nilai Donasi",
            "type": "column",
            "valueField": "income",
            "urlField": "url",
            "labelText": "Jumlah : [[labelIncome]]"
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
            event.chart.titles[0].text = 'Data Donasi Perbulan Tahun ' + event.item.dataContext.category + '';

            // let's add a label to go back to yearly data
            event.chart.addLabel(
                "!10", 25,
                "Kembali >>",
                "right",
                undefined,
                undefined,
                undefined,
                undefined,
                true,
                'javascript:window.location.reload();');

            // validate the new data and make the chart animate again
            event.chart.validateData();
            event.chart.animateAgain();
        }
    });

    // function which resets the chart back to yearly data
    function resetChart1() {
        chart.dataProvider = chartData1;
        chart.titles[0].text = 'Data Donasi Pertahun';

        // remove the "Go back" label
        chart.allLabels = [];

        chart.validateData();
        chart.animateAgain();
    }
</script>

<!-- Bagian Marketer -->
<script>
    var chartData = [
        <?php foreach ($getMarketerPertahun as $row) { ?> {
                "category": <?php echo $row->tahun; ?>,
                "income": <?php echo number_format_satuan($row->tot_marketer); ?>,
                "url": "#",
                "description": "Klik untuk melihat detail",
                "months": [
                    <?php $MarketerDonasiByTahun = $this->M_visualisasi->MarketerDonasiByTahun($row->tahun); ?>
                    <?php foreach ($MarketerDonasiByTahun as $r) { ?> {
                            "category": "<?php echo getBulan($r->bulan); ?>",
                            "income": <?php echo number_format_satuan($r->total_marketer); ?>
                        },
                    <?php } ?>
                ]
            },
        <?php } ?>
    ];

    var chart = AmCharts.makeChart("chartdiv2", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "/lib/3/images/",
        "autoMargins": false,
        "marginLeft": 90,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 56,
        "titles": [{
            "text": "Data Marketer Pertahun"
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
            "urlField": "url",
            "labelText": "[[income]] Marketer"
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
                "Kembali >>",
                "right",
                undefined,
                undefined,
                undefined,
                undefined,
                true,
                'javascript:window.location.reload();');

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
                <h5>Perbandingan Data Marketer Terhadap Donasi</h5>
                <ul class="nav navbar-left panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Data Donasi <small>(Berdasarkan Data Tahunan)</small>
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
                                            <li class="fa fa-table"></li> Data Marketer <small>(Berdasarkan Data Tahunan)</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="chartdiv2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>