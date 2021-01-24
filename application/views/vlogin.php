<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HIRIAU|Dashboard</title>
    <link href="<?php echo base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body>
    <br>
    <br><br>
    <br>
    <br><br><br>
    <br><br>

    <div class="right_col" role="main">
        <div class="">
            <div class="login-box">
                <div class="row justify-content-center">
                    <div class="col-md-4">

                        <div class="card">
                            <center>
                                <div class="login-logo">
                                    <b>
                                        <font color="#FFD700">HIRIAU</font>
                                    </b> <b>Dashboard BI</b>
                                </div>
                            </center>
                            <!-- masukkan isi card nya disini... -->

                            <!-- /.login-logo -->
                            <div class="card">
                                <div class="card-body login-card-body ">
                                    <center>
                                        <p class="login-box-msg">Silahkan Login! </p>
                                        <form action="<?= base_url('C_admin/login') ?>" method="post">
                                            <div class="input-group mb-3">
                                                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <center>
                                                <div class="col-4">
                                                    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                                </div>
                                                <!-- /.col -->
                                        </form>
                                </div>
                                <!-- /.social-auth-links -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
    </div>
</body>

</html>