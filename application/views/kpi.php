<script>
    $(document).ready(function() {
        $('#tabel').hide();
        $('#grafik').show();
    });

    function kelolaKPI() {
        $('#tabel').show();
        $('#grafik').hide();
    }

    function tutup() {
        $('#tabel').hide();
        $('#grafik').show();
    }
</script>
<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 300px;
        font-size: 11px;
    }

    #chartdiv1 {
        width: 100%;
        height: 300px;
        font-size: 11px;

    }

    #chartdiv2 {
        width: 100%;


    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Jumlah Nilai Donasi -->
<script>
    am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        // Export
        // chart.exporting.menu = new am4core.ExportMenu();
        // Data for both series
        var data = [
            <?php foreach ($getNilaiDonasiPertahun as $row) { ?> {
                    "year": "<?php echo $row->tahun; ?>",
                    "income": <?php echo $row->total_donasi; ?>,
                    "expenses": "<?php echo $row->nilai_target; ?>",
                },
            <?php } ?>
        ];
        /* Create axes */
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "year";
        categoryAxis.renderer.minGridDistance = 30;

        /* Create value axis */
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Pencapaian";
        columnSeries.dataFields.valueY = "income";
        columnSeries.dataFields.categoryX = "year";

        columnSeries.columns.template.tooltipText = "[#fff font-size: 11px]{name} in {categoryX}:\n[/][#fff font-size: 15px]{valueY}[/] [#fff]{additional}[/]"
        columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
        columnSeries.columns.template.propertyFields.stroke = "stroke";
        columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
        columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
        columnSeries.tooltip.label.textAlign = "middle";

        var lineSeries = chart.series.push(new am4charts.LineSeries());
        lineSeries.name = "Target";
        lineSeries.dataFields.valueY = "expenses";
        lineSeries.dataFields.categoryX = "year";

        lineSeries.stroke = am4core.color("#fdd400");
        lineSeries.strokeWidth = 3;
        lineSeries.propertyFields.strokeDasharray = "lineDash";
        lineSeries.tooltip.label.textAlign = "middle";

        var bullet = lineSeries.bullets.push(new am4charts.Bullet());
        bullet.fill = am4core.color("#008B8B"); // tooltips grab fill from parent by default
        bullet.tooltipText = "[#fff font-size: 11px]{name} in {categoryX}:\n[/][#fff font-size: 15px]{valueY}[/] [#fff]{additional}[/]"
        var circle = bullet.createChild(am4core.Circle);
        circle.radius = 4;
        circle.fill = am4core.color("#fff");
        circle.strokeWidth = 3;
        chart.data = data;

    }); // end am4core.ready()
</script>

<!-- Jumlah Donatur -->
<script>
    am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv1", am4charts.XYChart);
        // Export
        // chart.exporting.menu = new am4core.ExportMenu();
        // Data for both series
        var data = [
            <?php foreach ($getNilaiDonaturPertahun as $row) { ?> {
                    "year": "<?php echo $row->tahun; ?>",
                    "income": <?php echo $row->jlh_donatur; ?>,
                    "expenses": "<?php echo $row->nilai_target; ?>",
                },
            <?php } ?>
        ];
        /* Create axes */
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "year";
        categoryAxis.renderer.minGridDistance = 30;

        /* Create value axis */
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Pencapaian";
        columnSeries.dataFields.valueY = "income";
        columnSeries.dataFields.categoryX = "year";

        columnSeries.columns.template.tooltipText = "[#fff font-size: 11px]{name} in {categoryX}:\n[/][#fff font-size: 15px]{valueY}[/] [#fff]{additional}[/]"
        columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
        columnSeries.columns.template.propertyFields.stroke = "stroke";
        columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
        columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
        columnSeries.tooltip.label.textAlign = "middle";

        var lineSeries = chart.series.push(new am4charts.LineSeries());
        lineSeries.name = "Target";
        lineSeries.dataFields.valueY = "expenses";
        lineSeries.dataFields.categoryX = "year";

        lineSeries.stroke = am4core.color("#fdd400");
        lineSeries.strokeWidth = 3;
        lineSeries.propertyFields.strokeDasharray = "lineDash";
        lineSeries.tooltip.label.textAlign = "middle";

        var bullet = lineSeries.bullets.push(new am4charts.Bullet());
        bullet.fill = am4core.color("#008B8B"); // tooltips grab fill from parent by default
        bullet.tooltipText = "[#fff font-size: 11px]{name} in {categoryX}:\n[/][#fff font-size: 15px]{valueY}[/] [#fff]{additional}[/]"
        var circle = bullet.createChild(am4core.Circle);
        circle.radius = 4;
        circle.fill = am4core.color("#fff");
        circle.strokeWidth = 3;
        chart.data = data;

    }); // end am4core.ready()
</script>

<!-- Jumlah Donatur -->
<script>
    am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv2", am4charts.XYChart);
        // Export
        // chart.exporting.menu = new am4core.ExportMenu();
        // Data for both series
        var data = [
            <?php foreach ($getPenerimaManfaatPertahun as $row) { ?> {
                    "year": "<?php echo $row->tahun; ?>",
                    "income": <?php echo $row->tot_penerima; ?>,
                    "expenses": "<?php echo $row->nilai_target; ?>",
                },
            <?php } ?>
        ];
        /* Create axes */
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "year";
        categoryAxis.renderer.minGridDistance = 30;

        /* Create value axis */
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var columnSeries = chart.series.push(new am4charts.ColumnSeries());
        columnSeries.name = "Pencapaian";
        columnSeries.dataFields.valueY = "income";
        columnSeries.dataFields.categoryX = "year";

        columnSeries.columns.template.tooltipText = "[#fff font-size: 11px]{name} in {categoryX}:\n[/][#fff font-size: 15px]{valueY}[/] [#fff]{additional}[/]"
        columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
        columnSeries.columns.template.propertyFields.stroke = "stroke";
        columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
        columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
        columnSeries.tooltip.label.textAlign = "middle";

        var lineSeries = chart.series.push(new am4charts.LineSeries());
        lineSeries.name = "Target";
        lineSeries.dataFields.valueY = "expenses";
        lineSeries.dataFields.categoryX = "year";

        lineSeries.stroke = am4core.color("#fdd400");
        lineSeries.strokeWidth = 3;
        lineSeries.propertyFields.strokeDasharray = "lineDash";
        lineSeries.tooltip.label.textAlign = "middle";

        var bullet = lineSeries.bullets.push(new am4charts.Bullet());
        bullet.fill = am4core.color("#008B8B"); // tooltips grab fill from parent by default
        bullet.tooltipText = "[#fff font-size: 11px]{name} in {categoryX}:\n[/][#fff font-size: 15px]{valueY}[/] [#fff]{additional}[/]"
        var circle = bullet.createChild(am4core.Circle);
        circle.radius = 4;
        circle.fill = am4core.color("#fff");
        circle.strokeWidth = 3;
        chart.data = data;

    }); // end am4core.ready()
</script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h5>Target Pencapaian (Key Performance Indicators)</h5>
                <ul class="nav navbar-left panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div>
            <?php if ($this->session->flashdata('alert')) { ?>
                <div class="badge bg-warning" style="color:black"> <?php echo $this->session->flashdata('alert'); ?> </div>
            <?php   } else if ($this->session->flashdata('success')) { ?>
                <div class="badge bg-success" style="color:black"> <?php echo $this->session->flashdata('success'); ?> </div>
            <?php } ?>

            <div class="x_content">
                <ul class="nav navbar-left panel_toolbox">

                    <button class="btn btn-primary btn-sm" onclick="kelolaKPI()">Pengaturan Nilai KPI</button>
                </ul>
                <div class="clearfix">
                    <div class="btn-toolbar text-center">
                        <div class="btn-group btn-group-lg btn-group-solid margin-bottom-10">
                            <button type="button" style="font-size: 11px;" class="btn btn-info">Pilih Tahun</button>
                            <?php for ($i = (date('Y') - 4); $i <= date('Y'); $i++) { ?>
                                <a href="<?php print site_url(); ?>C_KPI/index/<?php print $i; ?>" type="button" style="font-size: 11px;" class="btn btn-primary"><?php print $i; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div id="tabel">
                        <div class="col-md-12">
                            <div class="text-right">
                                <button class="btn btn-danger btn-sm" onclick="tutup()">
                                    <li class="fa fa-close"></li> Close
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="title-right">
                                </div>
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>KPI Donasi</h2>
                                        <div class="text-right">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal1">Tambah</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box table-responsive">

                                                    <table id="data" class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="font-size: 10px;">No</th>
                                                                <th style="font-size: 10px;">Nilai Target</th>
                                                                <th style="font-size: 10px;">Tahun</th>
                                                                <th style="font-size: 10px;">Tools</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0;
                                                            foreach ($getKpiDonasi as $row) { ?>
                                                                <tr>
                                                                    <td style="font-size:10px"><?php echo ++$no; ?></td>
                                                                    <td style="font-size:10px"><?php echo $row->nilai_target; ?></td>
                                                                    <td style="font-size:10px"><?php echo $row->tahun; ?></td>
                                                                    <td style="font-size:10px"><a href="<?php echo base_url('C_KPI/delete_donasi/') . $row->id_kpi; ?>" class="btn btn-danger btn-sm" style="font-size: 10px;">Hapus</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal  1-->
                        <div id="modal1" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <li class="fa fa-list"></li> Form Nilai KPI
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <?php echo form_open('C_KPI/addKPIDonasi', array('id' => 'form_inputan', 'method' => 'post')); ?>
                                    <div class="modal-body">
                                        <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-4 col-sm-3">Nilai Target<span class="required">*</span></label>
                                                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="nilai_target1" name="nilai_target1">
                                                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-4 col-sm-3">Tahun<span class="required">*</span></label>
                                                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                                        <select name="tahun1" id="tahun1" class="form-control has-feedback-left">
                                                            <option value="">--Pilih Tahun--</option>
                                                            <?php for ($i = (date('Y') - 10); $i <= date('Y'); $i++) { ?>
                                                                <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>

                                    </div>
                                    <?php echo form_close() ?>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="title-right">
                                </div>
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>KPI Donatur</h2>
                                        <div class="text-right">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal2">Tambah</button>
                                        </div>
                                        <div class="text-right">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box table-responsive">

                                                    <table id="data" class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="font-size: 10px;">No</th>
                                                                <th style="font-size: 10px;">Nilai Target</th>
                                                                <th style="font-size: 10px;">Tahun</th>
                                                                <th style="font-size: 10px;">Tools</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0;
                                                            foreach ($getKpiDonatur as $row) { ?>
                                                                <tr>
                                                                    <td style="font-size:10px"><?php echo ++$no; ?></td>
                                                                    <td style="font-size:10px"><?php echo $row->nilai_target; ?></td>
                                                                    <td style="font-size:10px"><?php echo $row->tahun; ?></td>
                                                                    <td style="font-size:10px"><a href="<?php echo base_url('C_KPI/delete_donatur/') . $row->id_kpi; ?>" class="btn btn-danger btn-sm" style="font-size: 10px;">Hapus</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal 2 -->
                        <div id="modal2" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <li class="fa fa-list"></li> Form Nilai KPI
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <?php echo form_open('C_KPI/addKPIDonatur', array('id' => 'form_inputan', 'method' => 'post')); ?>
                                    <div class="modal-body">
                                        <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-4 col-sm-3">Nilai Target<span class="required">*</span></label>
                                                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="nilai_target2" name="nilai_target2">
                                                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-4 col-sm-3">Tahun<span class="required">*</span></label>
                                                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                                        <select name="tahun2" id="tahun2" class="form-control has-feedback-left">
                                                            <option value="">--Pilih Tahun--</option>
                                                            <?php for ($i = (date('Y') - 10); $i <= date('Y'); $i++) { ?>
                                                                <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>

                                    </div>
                                    <?php echo form_close() ?>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="title-right">
                                </div>
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>KPI Penerima Manfaat</h2>
                                        <div class="text-right">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal3">Tambah</button>
                                        </div>
                                        <div class="text-right">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box table-responsive">

                                                    <table id="data" class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="font-size: 10px;">No</th>
                                                                <th style="font-size: 10px;">Nilai Target</th>
                                                                <th style="font-size: 10px;">Tahun</th>
                                                                <th style="font-size: 10px;">Tools</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0;
                                                            foreach ($getKpiPenerimaManfaat as $row) { ?>
                                                                <tr>
                                                                    <td style="font-size:10px"><?php echo ++$no; ?></td>
                                                                    <td style="font-size:10px"><?php echo $row->nilai_target; ?></td>
                                                                    <td style="font-size:10px"><?php echo $row->tahun; ?></td>
                                                                    <td style="font-size:10px"><a href="<?php echo base_url('C_KPI/delete_penerima_manfaat/') . $row->id_kpi; ?>" class="btn btn-danger btn-sm" style="font-size: 10px;">Hapus</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modal3" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <li class="fa fa-list"></li> Form Nilai KPI
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <?php echo form_open('C_KPI/addKPIPenerimaManfaat', array('id' => 'form_inputan', 'method' => 'post')); ?>
                                    <div class="modal-body">
                                        <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-4 col-sm-3">Nilai Target<span class="required">*</span></label>
                                                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="nilai_target3" name="nilai_target3">
                                                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-4 col-sm-3">Tahun<span class="required">*</span></label>
                                                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                                        <select name="tahun3" id="tahun3" class="form-control has-feedback-left">
                                                            <option value="">--Pilih Tahun--</option>
                                                            <?php for ($i = (date('Y') - 10); $i <= date('Y'); $i++) { ?>
                                                                <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>

                                    </div>
                                    <?php echo form_close() ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="grafik">
                        <div class="col-sm-6">
                            <div class="card-box table-responsive">
                                <div class="title_right">
                                    <div class="x_title">
                                        <div class=" btn-group-sm" role="group" aria-label="...">
                                            <h4>
                                                <li class="fa fa-table"></li> Statistik <small>(Berdasarkan Jumlah Nilai Donasi)</small>
                                            </h4>
                                            <small>
                                                Status Target Tahun <?php echo $tahun == '' ? '' : $tahun; ?> <?php echo $kpiDonasiPertahun[0]->total_donasi >= $kpiDonasiPertahun[0]->nilai_target ? '<div class="badge bg-blue">Tercapai</div>' : '<div class="badge bg-red">Belum Tercapai</div>'; ?>
                                            </small>
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
                                                <li class="fa fa-table"></li> Statistik <small>(Berdasarkan Jumlah Donatur)</small>
                                            </h4>
                                            <small>
                                                Status Target Tahun <?php echo $tahun; ?> <?php echo ($kpiDonaturPertahun[0]->jlh_donatur) >= ($kpiDonaturPertahun[0]->nilai_target) ? '<div class="badge bg-blue">Tercapai</div>' : '<div class="badge bg-red">Belum Tercapai</div>'; ?>
                                            </small>
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
                                                <li class="fa fa-table"></li> Statistik <small>(Berdasarkan Penerima Manfaat)</small>
                                            </h4>
                                            <small>
                                                Status Target Tahun <?php echo $tahun; ?> <?php echo $kpiPenerimaManfaatPertahun[0]->tot_penerima >= $kpiPenerimaManfaatPertahun[0]->nilai_target ? '<div class="badge bg-blue">Tercapai</div>' : '<div class="badge bg-red">Belum Tercapai</div>'; ?>
                                            </small>
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

</div>