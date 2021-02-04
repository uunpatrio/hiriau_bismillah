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
        <?php foreach ($getBulanByDataSegmentasi as $row) { ?> {
                "category": "<?php echo getBulan($row->bulan); ?>",
                "income": <?php echo $row->jlh_donatur; ?>,
                "url": "#",
                "description": "Klik untuk melihat detail",
                "months": [
                    <?php $perkembanganDonaturBySegmentasi = $this->M_visualisasi->perkembanganDonaturBySegmentasi($row->bulan, $row->tahun); ?>
                    <?php foreach ($perkembanganDonaturBySegmentasi as $r) { ?> {
                            "category": "<?php echo ($r->segmentasi_pasar); ?>",
                            "income": <?php echo $r->jumlah_segmentasi; ?>
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
            "text": "Jumlah Donatur"
        }],
        "dataProvider": chartData,
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:13px;'>[[title]] Pada [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
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
            event.chart.titles[0].text = 'Perkembangan Donatur Setiap Segmentasi Bulan ' + event.item.dataContext.category + '';

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

<!-- page content -->
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12">

        <div class="x_panel">
            <div class="x_title">
                <div class="btn-toolbar text-center">
                    <div class="btn-group btn-group-lg btn-group-solid margin-bottom-10">
                        <button type="button" style="font-size: 11px;" class="btn btn-info">Pilih Tahun</button>
                        <?php for ($i = (date('Y') - 4); $i <= date('Y'); $i++) { ?>
                            <a href="<?php print site_url(); ?>C_perkembangan_donatur/donasi/<?php print $i; ?>" type="button" style="font-size: 11px;" class="btn btn-primary"><?php print $i; ?></a>
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
                                            <li class="fa fa-table"></li> Perkembangan Donatur <small>(Berdasarkan Data Tahun <?php echo $tahun; ?>)</small>
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