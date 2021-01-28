<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Import Data Donatur </h3>
            </div>
            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="card">
            <div class="card-body">
                <?= form_open_multipart('Import_donatur/uploaddata') ?>
                <div class="row">
                    <div class="col-md-12">
                        <small for="">Hanya mendukung format Excel* <br> Silahkan download format excel dibawah ini ! </small> <a href="<?php echo base_url('format_excel/donatur.xlsx') ?>" target="_blank">Download File Here</a>
                        <br>
                        <br>
                    </div>
                    <div class="col-4">
                        <input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,.xls" required>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <li class="fa fa-upload"></li> Import
                        </button>
                    </div>
                    <div class="col">
                        <?= $this->session->flashdata('pesan'); ?>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
    </div>


    </html>