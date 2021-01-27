<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 400px;
        font-size: 12px;
    }

    #chartdiv1 {
        width: 100%;
        height: 400px;
        font-size: 12px;
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

<!-- Chart Donatur -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "marginRight": 70,
        "dataProvider": [
            <?php foreach ($getTop10DonaturTertinggi as $row) { ?> {
                    "country": "<?php echo $row->nama_donatur; ?>",
                    "visits": <?php echo $row->tot_donatur; ?>,
                    "color": "#6495ED"
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Jumlah Donatur Tahun <?php echo $tahun; ?>"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits",

        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
        "export": {
            "enabled": true
        }

    });
</script>

<!-- Chart Marketer -->
<script>
    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "theme": "none",
        "marginRight": 70,
        "dataProvider": [
            <?php foreach ($getTop10MarketerTertinggi as $r) { ?> {
                    "country": "<?php echo $r->nama_marketer; ?>",
                    "visits": <?php echo $r->tot_marketer; ?>,
                    "color": "#00BFFF"
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Jumlah Donatur Tahun <?php echo $tahun; ?>"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits",

        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
        "export": {
            "enabled": true
        }

    });
</script>


<!-- page content -->
<div class="right_col" role="main">
    <div class="row" style="display: inline-block;">
        <div class="top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " style="width: 300px;">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <div class="count"><?php echo empty($countDonatur[0]->tot_donatur) ? '0' : $countDonatur[0]->tot_donatur; ?></div>
                    <p>Total Donatur</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " style="width: 300px;">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-comments-o"></i></div>
                    <div class="count"><?php echo empty($countPenerimaDonasi[0]->tot_penerima) ? '0' : $countPenerimaDonasi[0]->tot_penerima; ?></div>
                    <p>Total Penerima Donasi</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " style="width: 300px;">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-comments-o"></i></div>
                    <div class="count"><?php echo empty($countMarketer[0]->tot_marketer) ? '0' : $countMarketer[0]->tot_marketer; ?></div>
                    <p>Jumlah Marketer</p>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 " style="width: 300px;">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check-square-o"></i></div>
                    <div class="count"><?php echo empty($countProduk[0]->tot_produk) ? '0' : $countProduk[0]->tot_produk; ?></div>
                    <p>Total Produk</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class=" btn-group-sm" role="group" aria-label="...">
                    <div class="btn-toolbar text-center">
                        <div class="btn-group btn-group-lg btn-group-solid margin-bottom-10">
                            <button type="button" style="font-size: 11px;" class="btn btn-info">Pilih Tahun</button>
                            <?php for ($i = (date('Y') - 4); $i <= date('Y'); $i++) { ?>
                                <a href="<?php print site_url(); ?>Home/index/<?php print $i; ?>" type="button" style="font-size: 11px;" class="btn btn-primary"><?php print $i; ?></a>
                            <?php } ?>
                        </div>
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
                    <div class="col-sm-6">

                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> 10 Donatur Tertinggi Tahun <?php echo $tahun; ?>
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
                    <div class="col-sm-6">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> 10 Marketer Tertinggi Tahun <?php echo $tahun; ?>
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