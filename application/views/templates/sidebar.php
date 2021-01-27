<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3></h3>
        <ul class="nav side-menu">
            <h3>List Menu</h3>
            <li><a href="<?php echo base_url('Home') ?>" class="nav-link">
                    <i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li><a href="<?php echo base_url('C_KPI') ?>" class="nav-link">
                    <i class="fa fa-line-chart"></i> Key Performance </a>
            </li>
            <li><a><i class="fa fa-bar-chart"></i> Representasi Data <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('C_perkembangan_donatur') ?>">Segmentasi Pasar</a></li>
                    <li><a href="<?php echo base_url('C_perkembangan_donatur/donasi') ?>">Perkembangan Donatur</a></li>
                    <li><a href="<?php echo base_url('C_perbandingan') ?>">Perbandingan donasi Masuk dengan Donasi Tersalurkan</a></li>
                    <li><a href="<?php echo base_url('C_penerima') ?>">Persebaran Penerima Manfaat</a></li>
                    <li><a href="<?php echo base_url('C_marketer/index/') ?>">Marketer Teraktif</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-desktop"></i> Import Data <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('C_donatur') ?>">Data Donatur</a></li>
                    <li><a href="<?php echo base_url('Import_penerima') ?>">Data Penerima Manfaat</a></li>
                </ul>
            </li>


            <!-- <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                </ul>
            </li> -->
        </ul>
    </div>

</div>


<!-- <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div> -->

</div>
</div>

<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url() ?>assets/images/logo.png" alt="">Admin|HIRiau
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="javascript:;"> Profile</a> -->
                        <a class="dropdown-item" href="<?= site_url('C_admin/logout') ?>" class="nav-link"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>