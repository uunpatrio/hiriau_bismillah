<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
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
<!-- page content -->
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12">
        <div class="x_content">
            <div class="x_panel">
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
                                            <li class="fa fa-table"></li> Segmentasi Pasar<small> (Berdasarkan Donatur)</small>
                                        </h4>

                                    </div>
                                    <ul class="nav navbar-left panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <form action="<?php echo base_url('c_penerima/'); ?>" method="post">
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
                                    <div class="col-md-5">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="jk" id="jk" style="font-size: 12px;" class="form-control ">
                                                    <option value="">-- Jenis Kelamin --</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="kriteria" id="kriteria" style="font-size: 12px;" class="form-control">
                                                    <option value="">Kriteria Penerima</option>
                                                    <?php foreach ($getThn as $b) { ?>
                                                        <option value="<?php echo $b->tahun; ?>"><?php echo $b->tahun; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <select name="kriteria" id="kriteria" style="font-size: 12px;" class="form-control">
                                                    <option value="">Kriteria Penerima</option>
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
                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>