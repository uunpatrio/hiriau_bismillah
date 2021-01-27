<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>Data Jabatan</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <button class="btn btn-success btn-sm" type="button" onclick="window.location='<?php echo base_url('administrator/tingkatJabatan') ?>'">
                <li class="fa fa-pencil"></li> Kelola Tingkat Jabatan</button>
                <button class="btn btn-primary btn-sm" type="button" onclick="tambah()">
                    <li class="fa fa-plus"></li> Tambah Data
                </button>
                </li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

            </ul>
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
                                    <th style="font-size: 10px;">Tools</th>
                                    <th style="font-size: 10px;">Nama Jabatan</th>
                                    <th style="font-size: 10px;">Tingkat Jabatan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <li class="fa fa-list"></li> Form Data Jabatan
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
            <div class="modal-body">
                <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Nama Jabatan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="nama_jabatan" name="nama_jabatan">
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Tingkat Jabatan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <select name="tingkat_jabatan" id="tingkat_jabatan" class="form-control has-feedback-left">
                                    <option value="">--Select--</option>
                                    <?php foreach ($getTingkatJabatan as $r) { ?>
                                        <option value="<?php echo $r->id; ?>"><?php echo $r->nama; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Create Date<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <input type="text" id="create_date" name="create_date" value="<?php echo date('Y-m-d') ?>" class="form-control has-feedback-left" readonly>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-sm" onclick="simpan()">Simpan</button>

            </div>
            <?php echo form_close() ?>
        </div>

    </div>
</div>