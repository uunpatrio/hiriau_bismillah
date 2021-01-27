<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartdiv1 {
        width: 100%;
        height: 500px;
        font-size: 11px;
        padding-top: 10%;
        padding-bottom: 20%;

    }

    #chartdiv2 {
        width: 100%;
        height: 500px;
        font-size: 11px;

    }

    #chartdiv3 {
        width: 100%;
        height: 400px;
        font-size: 11px;
        padding-top: 15%;
    }

    /* .amcharts-export-menu-top-right {
        top: 10px;
        right: 0;
    } */
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "marginRight": 70,
        "dataProvider": [
            <?php foreach ($getDataPenerimaManfaatPerbulan as $row) { ?> {
                    "country": "<?php echo $row->kecamatan; ?>",
                    "visits": <?php echo $row->jlh_penerima; ?>,
                    "color": "#0D52D1"
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Visitors from country"
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
            "labelRotation": 45
        },
        "export": {
            "enabled": true
        }

    });
</script>

<!-- Chart untuk Kategori Umur -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv1", am4charts.RadarChart);

        // Add data
        chart.data = [
            <?php foreach ($getPenerimaByKategoriUmur as $row) { ?> {
                    "category": "<?php echo $row->kategori_umur; ?>",
                    "value": <?php echo $row->jlh_penerima; ?>,
                    "full": 100
                },
            <?php } ?>
        ];

        // Make chart not full circle
        chart.startAngle = -90;
        chart.endAngle = 180;
        chart.innerRadius = am4core.percent(20);

        // Set number format
        chart.numberFormatter.numberFormat = "#.#'%'";

        // Create axes
        var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.grid.template.strokeOpacity = 0;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.fontWeight = 500;
        categoryAxis.renderer.labels.template.adapter.add("fill", function(fill, target) {
            return (target.dataItem.index >= 0) ? chart.colors.getIndex(target.dataItem.index) : fill;
        });
        categoryAxis.renderer.minGridDistance = 10;

        var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.grid.template.strokeOpacity = 0;
        valueAxis.min = 0;
        valueAxis.max = 100;
        valueAxis.strictMinMax = true;

        // Create series
        var series1 = chart.series.push(new am4charts.RadarColumnSeries());
        series1.dataFields.valueX = "full";
        series1.dataFields.categoryY = "category";
        series1.clustered = false;
        series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
        series1.columns.template.fillOpacity = 0.08;
        series1.columns.template.cornerRadiusTopLeft = 20;
        series1.columns.template.strokeWidth = 0;
        series1.columns.template.radarColumn.cornerRadius = 20;

        var series2 = chart.series.push(new am4charts.RadarColumnSeries());
        series2.dataFields.valueX = "value";
        series2.dataFields.categoryY = "category";
        series2.clustered = false;
        series2.columns.template.strokeWidth = 0;
        series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
        series2.columns.template.radarColumn.cornerRadius = 20;

        series2.columns.template.adapter.add("fill", function(fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
        });

        // Add cursor
        chart.cursor = new am4charts.RadarCursor();

    }); // end am4core.ready()
</script>

<!-- Chart untuk kriteria penerima -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv2", am4charts.PieChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data = [
            <?php foreach ($getPenerimaByKriteria as $row) { ?> {
                    country: "<?php echo $row->kriteria_penerima; ?>",
                    value: <?php echo $row->jlh_penerima; ?>
                },
            <?php } ?>
        ];
        chart.radius = am4core.percent(50);
        chart.innerRadius = am4core.percent(30);
        chart.startAngle = 90;
        chart.endAngle = 360;

        var series = chart.series.push(new am4charts.PieSeries());
        series.dataFields.value = "value";
        series.dataFields.category = "country";

        series.slices.template.cornerRadius = 10;
        series.slices.template.innerCornerRadius = 7;
        series.slices.template.draggable = true;
        series.slices.template.inert = true;
        series.alignLabels = false;

        series.hiddenState.properties.startAngle = 90;
        series.hiddenState.properties.endAngle = 90;

        chart.legend = new am4charts.Legend();

    }); // end am4core.ready()
</script>

<!-- Chart untuk Jenis kelamin -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv3", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = [
            <?php foreach ($getPenerimaByJenisKelamin as $row) { ?> {
                    country: "<?php echo $row->jenis_kelamin; ?>",
                    litres: <?php echo $row->jlh_penerima; ?>
                },
            <?php } ?>
        ];

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.category = "country";

    }); // end am4core.ready()
</script>
<!-- page content -->
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12">
        <div class="x_content">
            <div class="x_panel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="title-right">
                                <form action="<?php echo base_url('c_penerima/'); ?>" id="filter" method="post">
                                    <!-- <input type="text" name="filter" id="filter"> -->
                                    <div class="col-md-5">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="bulan" id="bulan" style="font-size: 12px;" class="form-control ">
                                                    <option value="">Pilih Bulan</option>
                                                    <?php foreach ($getBln as $r) { ?>
                                                        <option value="<?php echo $r->bulan ?>"><?php echo getBulan($r->bulan); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="tahun" id="tahun" style="font-size: 12px;" class="form-control">
                                                    <option value="">Pilih Tahun</option>
                                                    <?php foreach ($getThn as $b) { ?>
                                                        <option value="<?php echo $b->tahun; ?>"><?php echo $b->tahun; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <li class="fa fa-search"></li> Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Penerima Manfaat<small> (Berdasarkan Lokasi (<?php echo getBulan($bulan) . ' Tahun ' . $tahun; ?>))</small>
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
                                            <li class="fa fa-table"></li> Penerima Manfaat<small> (Persentase Kategori Umur (<?php echo getBulan($bulan) . ' Tahun ' . $tahun; ?>))</small>
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
                    <div class="col-sm-6">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Penerima Manfaat<small> (Persentase Kriteria (<?php echo getBulan($bulan) . ' Tahun ' . $tahun; ?>))</small>
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
                    <div class="col-sm-6">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-table"></li> Penerima Manfaat<small> (Persentase Jenis Kelamin (<?php echo getBulan($bulan) . ' Tahun ' . $tahun; ?>))</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="chartdiv3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>