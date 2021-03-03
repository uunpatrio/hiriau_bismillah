<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartdiv1 {
        width: 100%;
        height: 300px;
        font-size: 10px;
    }

    #chartdiv2 {
        width: 100%;
        height: 300px;
        font-size: 10px;
    }
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/xy.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart DOnasi Masuk -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv1", am4charts.XYChart);

        var data = [];

        chart.data = [
            <?php foreach ($getTotalDonasiMasuk as $row) { ?> {
                    "year": "<?php echo getBulan($row->bulan); ?>",
                    "income": <?php echo $row->tot_donasi; ?>,
                },
            <?php } ?>
        ];

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.ticks.template.disabled = true;
        categoryAxis.renderer.line.opacity = 0;
        categoryAxis.renderer.grid.template.disabled = true;
        categoryAxis.renderer.minGridDistance = 40;
        categoryAxis.dataFields.category = "year";
        categoryAxis.startLocation = 0.4;
        categoryAxis.endLocation = 0.6;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.tooltip.disabled = true;
        valueAxis.renderer.line.opacity = 0;
        valueAxis.renderer.ticks.template.disabled = true;
        valueAxis.min = 0;

        var lineSeries = chart.series.push(new am4charts.LineSeries());
        lineSeries.dataFields.categoryX = "year";
        lineSeries.dataFields.valueY = "income";
        lineSeries.tooltipText = "Donasi Masuk Bulan {year} : {valueY.value}";
        lineSeries.fillOpacity = 0.5;
        lineSeries.strokeWidth = 3;
        lineSeries.propertyFields.stroke = "lineColor";
        lineSeries.propertyFields.fill = "lineColor";

        var bullet = lineSeries.bullets.push(new am4charts.CircleBullet());
        bullet.circle.radius = 6;
        bullet.circle.fill = am4core.color("#fff");
        bullet.circle.strokeWidth = 3;

        var latitudeLabel = lineSeries.bullets.push(new am4charts.LabelBullet());
        latitudeLabel.label.text = "{income}";
        latitudeLabel.label.horizontalCenter = "left";
        latitudeLabel.label.dx = 14;

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panX";
        chart.cursor.lineX.opacity = 0;
        chart.cursor.lineY.opacity = 0;
        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.bottomAxesContainer;

    }); // end am4core.ready()
</script>

<!-- Chart Donasi Tersalurkan-->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv2", am4charts.XYChart);

        var data = [];

        chart.data = [
            <?php foreach ($getTotalDonasiTersalurkan as $row) { ?> {
                    "year": "<?php echo getBulan($row->bulan); ?>",
                    "income": <?php echo $row->tot_donasi; ?>,
                },
            <?php } ?>
        ];

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.ticks.template.disabled = true;
        categoryAxis.renderer.line.opacity = 0;
        categoryAxis.renderer.grid.template.disabled = true;
        categoryAxis.renderer.minGridDistance = 40;
        categoryAxis.dataFields.category = "year";
        categoryAxis.startLocation = 0.4;
        categoryAxis.endLocation = 0.6;


        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.tooltip.disabled = true;
        valueAxis.renderer.line.opacity = 0;
        valueAxis.renderer.ticks.template.disabled = true;
        valueAxis.min = 0;

        var lineSeries = chart.series.push(new am4charts.LineSeries());
        lineSeries.dataFields.categoryX = "year";
        lineSeries.dataFields.valueY = "income";
        lineSeries.tooltipText = "Donasi Tersalurkan Bulan {year} : {valueY.value}";
        lineSeries.fillOpacity = 0.5;
        lineSeries.strokeWidth = 3;
        lineSeries.propertyFields.stroke = "lineColor";
        lineSeries.propertyFields.fill = "lineColor";

        var bullet = lineSeries.bullets.push(new am4charts.CircleBullet());
        bullet.circle.radius = 6;
        bullet.circle.fill = am4core.color("#fff");
        bullet.circle.strokeWidth = 3;

        var latitudeLabel = lineSeries.bullets.push(new am4charts.LabelBullet());
        latitudeLabel.label.text = "{income}";
        latitudeLabel.label.horizontalCenter = "left";
        latitudeLabel.label.dx = 14;

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panX";
        chart.cursor.lineX.opacity = 0;
        chart.cursor.lineY.opacity = 0;

        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.bottomAxesContainer;

    }); // end am4core.ready()
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
                            <a href="<?php print site_url(); ?>C_perbandingan/index/<?php print $i; ?>" type="button" style="font-size: 11px;" class="btn btn-primary"><?php print $i; ?></a>
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
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            Perbandingan Donasi Masuk dan Donasi Tersalurkan <small>(Berdasarkan Data Tahun <?php echo $tahun; ?> )</small>
                                        </h4>
                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-box table-responsive">
                            <div class="title_right">
                                <div class="x_title">
                                    <div class=" btn-group-sm" role="group" aria-label="...">
                                        <h4>
                                            <li class="fa fa-line-chart"></li> Donasi Masuk <small>( Tahun <?php echo $tahun; ?> )</small>
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
                                            <li class="fa fa-line-chart"></li> Donasi Tersalurkan <small>( Tahun <?php echo $tahun; ?> )</small>
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