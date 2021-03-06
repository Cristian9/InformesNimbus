<!DOCTYPE html>
<?php
    if(isset($_GET['errorAuth'])){
        $class = "has-error";
        $hidden = "";
        $msgauth = "";
        $msg = "";
        switch ($_GET['errorAuth']) {
            case 1:
                $msgauth = 'Usuario o contrase&ntilde;a incorrecta';
                $class = '';
                break;
            case 2:
                $msg = 'No tiene permiso para ingresar';
                $class = '';
                $hidden = '';
                break;
            case 3:
                $msg = 'El c&oacute;digo ingresado no es correcto';
                $class = 'has-error';
                break;
        }
    }else{
        $msg = "";
        $class = "";
        $hidden = "hidden";
    }
?>
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
        <script type="text/javascript" src="<?php echo base_url() ?>static/plugins/jquery/jquery-2.1.4.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>static/js/jquery.ctools.min.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                        <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                        <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            $(document).ready(function(){
                var button = document.getElementById('button');
                button.addEventListener("click", validar);
                $('#usuario').focus();
                $('#usuario').key("enter", function(){
                    $('#password').focus();
                });
                
                $('#password').key("enter", function(){
                    $('#captcha').focus();
                });
                
                $('#captcha').key("enter", function(){
                    validar();
                });
            });
            function validar() {
                $('#usuario, #password, #captcha').validate({
                    required: true,
                    message: {
                        required: 'requerido'
                    }
                });

                if ($.isValid) {
                    document.login.submit();
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div id="page-login" class="row">
                <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="text-right">
                        <a href="page_register_v1.html" class="txt-default">&nbsp;</a>
                    </div>
                    <div class="box">
                        <div class="box-content">
                            <!--<form class="form-horizontal" name="login" role="form" method="post" action="auth">-->
                            <?php 
                                $attr = array("class" => "form-horizontal", "name" => "login", "role" => "form");
                                echo form_open("auth", $attr); 
                            ?>
                                <div class="text-center">
                                    <img src="<?php echo base_url() ?>static/images/logo_master.png" />
                                </div>
                                <hr>
                                <div class="text-center">
                                    <h3 class="page-header">Informes Nimbus</h3>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-7 col-xs-9 text-left">Usuario:</label>
                                    <div class="col-sm-9 col-xs-9">
                                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
                                        <span class="fa fa-user form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-7 col-xs-9 text-left">Contrase&ntilde;a:</label>
                                    <div class="col-sm-9 col-xs-9">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                        <span class="fa fa-unlock-alt form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-7 col-xs-9 text-left">Ingrese el c&oacute;digo que aparece abajo:</label>
                                    <div class="col-sm-9 col-xs-9 <?php echo $class; ?>">
                                        <input type="text" id="captcha" name="captcha" class="form-control">
                                        <small class="help-block <?php echo $hidden; ?>"><?php echo $msg; ?></small>
                                        <span class="fa fa-key fa- form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img src="application/captcha.php"/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center <?php echo $class; ?>">
                                    <h3 class="page-header">&nbsp;</h3>
                                    <small class="help-block <?php echo $hidden; ?>"><?php echo $msgauth; ?></small>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-xs-9 weel">
                                        <button type="button" id="button" class="btn btn-primary btn-block btn-label-left">
                                            <span><i class="fa fa-clock-o"></i></span>
                                            Iniciar sessi&oacute;n
                                        </button>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                            <!--</form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>