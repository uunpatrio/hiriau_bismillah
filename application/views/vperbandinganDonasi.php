<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartdiv1 {
        width: 100%;
        height: 300px;
    }

    #chartdiv2 {
        width: 100%;
        height: 300px;
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/xy.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!-- Jumlah Nilai Donasi -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "xy",
        "theme": "none",
        // "dataDateFormat": "YYYY-MM-DD",
        "startDuration": 1.5,
        "trendLines": [],
        "legend": {
            "position": "right",
            "marginRight": 100,
            "autoMargins": false,
        },
        "balloon": {
            "adjustBorderColor": false,
            "shadowAlpha": 0,
            "fixedPosition": true
        },
        "graphs": [{
            "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Jumlah Donasi Masuk:<b>[[y]]</b><br>value:<b>[[value]]</b></div>",
            "bullet": "round",
            "maxBulletSize": 10,
            "lineAlpha": 0.8,
            "lineThickness": 2,
            "lineColor": "#b0de07",
            "fillAlphas": 0,
            "xField": "date",
            "yField": "ay",
            "valueField": "aValue"
        }, {
            "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Jumlah Donasi Keluar:<b>[[y]]</b><br>value:<b>[[value]]</b></div>",
            "bullet": "round",
            "maxBulletSize": 10,
            "lineAlpha": 0.8,
            "lineThickness": 3,
            "lineColor": "#fcd602",
            "fillAlphas": 0,
            "xField": "date",
            "yField": "by",
            "valueField": "bValue"
        }],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "axisAlpha": 0
        }, {
            "id": "ValueAxis-2",
            "axisAlpha": 0,
            "position": "bottom"
        }],
        "allLabels": [],
        "titles": [],
        "dataProvider": [
            <?php foreach ($getPerbandinganDonasiMasukKeluar as $row) { ?> {
                    "date": <?php echo $row->bulan; ?>,
                    "ay": <?php echo $row->total_donasi_masuk; ?>,
                    "by": <?php echo $row->total_donasi_keluar; ?>,
                    "aValue": <?php echo $row->total_donasi_masuk; ?>,
                    "bValue": <?php echo $row->total_donasi_keluar; ?>
                },
            <?php } ?>
        ],
        "chartCursor": {
            "pan": true,
            "cursorAlpha": 0,
            "valueLineAlpha": 0
        }
    });
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
                                            <li class="fa fa-table"></li> Perbandingan Donasi Masuk dan Donasi Tersalurkan <small>(Berdasarkan Data Tahun <?php echo $tahun; ?> )</small>
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