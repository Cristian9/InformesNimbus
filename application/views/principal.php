<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Informes de uso de nimbus</title>
        <meta name="description" content="description">
        <meta name="author" content="DTA">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url() ?>static/images/favicon.png" rel="shortcut icon" >
        <link href="<?php echo base_url() ?>static/plugins/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url() ?>static/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/plugins/xcharts/xcharts.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/plugins/select2/select2.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/css/style_v1.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/plugins/chartist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/css/buttons.dataTables.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                        <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                        <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--Start Header-->
        <div id="screensaver">
            <canvas id="canvas"></canvas>
            <i class="fa fa-lock" id="screen_unlock"></i>
        </div>
        <div id="modalbox">
            <div class="devoops-modal">
                <div class="devoops-modal-header">
                    <div class="modal-header-name">
                        <span>Basic table</span>
                    </div>
                    <div class="box-icons">
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="devoops-modal-inner"></div>
                <div class="devoops-modal-bottom"></div>
            </div>
        </div>
        <header class="navbar">
            <div class="container-fluid expanded-panel">
                <div class="row">
                    <div id="logo" class="col-xs-12 col-sm-2">
                        <img src="<?php echo base_url() ?>static/images/logo_mini.png" width="130" height="50" />
                    </div>
                    <div id="top-panel" class="col-xs-12 col-sm-10">
                        <div class="row">
                            <div class="col-xs-8 col-sm-4"></div>
                            <div class="col-xs-4 col-sm-8 top-panel-right">
                                <ul class="nav navbar-nav pull-right panel-menu">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                            <div class="avatar">
                                                <img src="<?php echo base_url() ?>static/images/avatar.jpg" class="img-circle" alt="avatar" />
                                            </div>
                                            <i class="fa fa-angle-down pull-right"></i>
                                            <div class="user-mini pull-right">
                                                <span class="welcome">Conectado como,</span>
                                                <span><?php echo $_SESSION['nombre'] ?></span>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="out">
                                                    <i class="fa fa-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--End Header-->
        <!--Start Container-->
        <div id="main" class="container-fluid">
            <div class="row">
                <div id="sidebar-left" class="col-xs-2 col-sm-2">
                    <ul class="nav main-menu">
                        <?php
                        if($_SESSION['rol'] == 1):
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="hidden-xs">Administraci&oacute;n</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="ajax-link" href="users-newperiod">Fechas de inicio</a></li>
                                <li><a class="ajax-link" href="configuracion">Habilitar areas y facultades</a></li>
                                <li><a class="ajax-link" href="users-newperiod">Nuevo periodo</a></li>
                                <li><a class="ajax-link" href="users-newuser">Nuevo Usuario</a></li>
                                <li><a class="ajax-link" href="asignar">Asignar perfil de usuario</a></li>
                                <li><a class="ajax-link" href="users">Usuarios Asignados</a></li>
                            </ul>
                        </li>
                        <?php 
                        endif;

                        foreach ($menu as $v) :
                        ?>
                        <li>
                            <a href="<?php echo $v['href'] ?>" class="ajax-link">
                                <i class="fa <?php echo $v['icon'] ?>"></i>
                                <span class="hidden-xs"><?php echo $v['description'] ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!--Start Content-->
                <div id="content" class="col-xs-12 col-sm-10">
                    <div id="ajax-content"></div>
                </div>
                <!--End Content-->
            </div>
        </div>
        <!--End Container-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!--<script src="http://code.jquery.com/jquery.js"></script>-->
        <script src="<?php echo base_url() ?>static/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>static/plugins/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>static/js/jquery.cookie.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url() ?>static/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>static/plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
        <script src="<?php echo base_url() ?>static/plugins/tinymce/tinymce.min.js"></script>
        <script src="<?php echo base_url() ?>static/plugins/tinymce/jquery.tinymce.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>static/js/dataTables.buttons.js"></script>
        <script src="<?php echo base_url() ?>static/js/jszip.min.js"></script>
        <script src="<?php echo base_url() ?>static/js/pdfmake.min.js"></script>
        <script src="<?php echo base_url() ?>static/js/vfs_fonts.js"></script>
        <script src="<?php echo base_url() ?>static/js/buttons.html5.js"></script>

        <!-- All functions for this theme + document.ready processing -->
        <script src="<?php echo base_url() ?>static/js/devoops.js"></script>
        <script src="<?php echo base_url() ?>static/js/jquery.ctools.min.js"></script>
        <script src="<?php echo base_url() ?>static/js/chart.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>static/plugins/select2/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
    </body>
</html>
