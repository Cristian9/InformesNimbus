<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Asignar</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-calendar"></i>
                    <span>Nuevo periodo</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content" style="display: none;">
                <fieldset>
                    <form class="form-horizontal" name="newperiodo" role="form" method="post" action="newperiod">
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">C&oacute;digo:</label>
                            <div class="col-sm-4">
                                <input type="text" id="id_periodo" name="id_periodo" class="form-control" placeholder="p.ej. 153">
                                <span class="fa fa-calendar form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Descripci&oacute;n:</label>
                            <div class="col-sm-4">
                                <input type="text" id="desc_periodo" name="desc_periodo" class="form-control" placeholder="p.ej. 2015-3">
                                <span class="fa fa-calendar form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="button" id="btnnewperiod" class="btn btn-danger">Agregar periodo</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-user"></i>
                    <span>Agregar usuario</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content" style="display: none;">
                <fieldset>
                    <form class="form-horizontal" name="newuser" role="form" method="post" action="users-add">
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Usuario:</label>
                            <div class="col-sm-4">
                                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="p.ej. ctapia">
                                <span class="fa fa-user form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Nombre:</label>
                            <div class="col-sm-4">
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Nombres">
                                <span class="fa fa-user form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Apellidos:</label>
                            <div class="col-sm-4">
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellidos">
                                <span class="fa fa-user form-control-feedback"></span>
                            </div>
                        </div>
                        <!--<div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Contrase&ntilde;a:</label>
                            <div class="col-sm-4">
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="">
                                <span class="fa fa-key form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Confirmar Contrase&ntilde;a:</label>
                            <div class="col-sm-4">
                                <input type="password" id="passconf" name="passconf" class="form-control" placeholder="">
                                <span class="fa fa-key form-control-feedback"></span>
                            </div>
                        </div>-->
                        <div class="form-group  has-feedback">
                            <label class="col-sm-3 control-label">Correo:</label>
                            <div class="col-sm-4">
                                <input type="text" id="correo" name="correo" class="form-control" placeholder="">
                                <span class="fa fa-at form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="button" id="btnnew" class="btn btn-danger">Registrar usuario</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-users"></i>
                    <span>Asignaci&oacute;n de Usuarios</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content" style="display: none;">
                <form id="defaultForm" method="post" action="" class="form-horizontal">
                    <fieldset>
                        <legend>Seleccione usuario</legend>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Usuario</label>
                            <div class="col-sm-5">
                                <select class="populate placeholder" name="country" id="s_usuarios">
                                    <option value="">-- Seleccione usuario --</option>
                                    <?php
                                    foreach ($user as $v):
                                        ?>
                                        <option value="<?php echo $v['id'] . '|' . $v['username'] ?>"><?php echo $v['lastname'] . ', ' . $v['firstname'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nivel</label>
                            <div class="col-sm-5">
                                <select class="populate placeholder" name="country" id="s_niveles">
                                    <option value="">-- Seleccione un nivel --</option>
                                    <option value="1">Administrador</option>
                                    <option value="3">Director de &aacute;rea</option>
                                    <option value="4">Decano</option>
                                    <option value="5">Director de Carrera</option>
                                    <option value="6">Coordinador de Curso</option>
                                </select>
                            </div>
                        </div>
                        <!--<div class="form-group adm">
                            <label class="col-sm-3 control-label">Periodo</label>
                            <div class="col-sm-5">
                                <select class="populate placeholder" multiple name="country" id="s_periodo">
                                    <option value="">-- Seleccione programa --</option>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group adm">
                            <label class="col-sm-3 control-label">Ciudad</label>
                            <div class="col-sm-5">
                                <select class="populate placeholder" multiple name="country" id="s_ciudad">
                                    <option value="1">-- Lima --</option>
                                    <option value="2">-- Chiclayo --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group adm">
                            <label class="col-sm-3 control-label">Programa</label>
                            <div class="col-sm-5">
                                <select class="populate placeholder" multiple name="country" id="s_programas">
                                    <option value="">-- Seleccione programa --</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 hiddenxs 1">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Administrador</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <fieldset>
                    <legend>Asignar administrador</legend>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" class="btn btn-primary">Asignar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 hiddenxs 3">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-dashboard"></i>
                    <span>&Aacute;reas</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <fieldset>
                    <legend>Seleccione &aacute;rea</legend>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">&Aacute;reas</label>
                        <div class="col-sm-5">
                            <select class="populate placeholder" multiple name="country" id="s_areas">
                                <option value="0">-- Seleccione --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" class="btn btn-primary">Asignar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 hiddenxs 4">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Facultades</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <fieldset>
                    <legend>Seleccione facultad</legend>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Facultades</label>
                        <div class="col-sm-5">
                            <select class="populate placeholder" multiple name="country" id="s_facultades">
                                <option value="0">-- Seleccione --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" class="btn btn-primary">Asignar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 hiddenxs 5">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-table"></i>
                    <span>Carreras</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <fieldset>
                    <legend>Seleccione carrera</legend>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Facultades</label>
                        <div class="col-sm-5">
                            <select class="populate placeholder" name="country" id="s_facultadesaux">
                                <option value="0">-- Seleccione --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Carreras</label>
                        <div class="col-sm-5">
                            <select class="populate placeholder" multiple name="country" id="s_carreras">
                                <option value="0">-- Seleccione --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" class="btn btn-primary">Asignar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 hiddenxs 6">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Cursos</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <fieldset>
                    <legend>Seleccione curso</legend>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Cursos</label>
                        <div class="col-sm-8">
                            <select class="populate placeholder" multiple name="country" id="s_cursos">
                                <option value="0">-- Seleccione --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" class="btn btn-primary">Asignar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.hiddenxs').css({
            'display': 'none'
        });
        $('select').select2({
            placeholder: '-- Seleccione --'
        });

        $('#s_niveles').change(function () {
            var item = $(this).val();
            $('.' + item).removeAttr('style');

            $('.adm').removeAttr('style');

            item == '1' && $('.adm').css({'display': 'none'});

            $('.hiddenxs, .hiddenxss').not('.' + item).css({
                'display': 'none'
            });
        });

        cargar_select('s_areas', 'users-get_areas');
        cargar_select('s_facultades', 'users-get_facultades');
        cargar_select('s_facultadesaux', 'users-get_facultades');
        //cargar_select('s_carreras', 'users-get_carreras');
        cargar_select('s_cursos', 'users-get_cursos');
        cargar_select('s_programas', 'users-get_category');
        //cargar_select('s_periodo', 'users-getPeriodo');

        $('#s_facultadesaux').change(function () {
            var facultad = {
                'facultad': $(this).val()
            }
            cargar_select('s_carreras', 'users-get_carreras', facultad);
        })

        var btn = document.getElementsByClassName('btn-primary');
        for (var i = 0; i < btn.length; i++) {
            btn.item(i).addEventListener("click", function () {
                if (document.getElementById('s_niveles').value != '1') {
                    $('#s_usuarios, #s_niveles, #s_programas').validate({
                        required: true,
                        message: {
                            required: 'Requerido'
                        }
                    });
                } else {
                    $.isValid = true;
                }

                if ($.isValid) {
                    asignar();
                }
            });
        }

        var btn_newuser = document.getElementById('btnnew');
        btn_newuser.addEventListener("click", function () {
            $('#correo').validate({
                required: true,
                regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/,
                message: {
                    required: 'Requerido',
                    regexp: 'Formato incorrecto'
                }
            });
            
            $('#usuario, #firstname, #lastname').validate({
                required : true,
                message : {
                    required : 'Requerido'
                }
            });

            if ($.isValid) {
                var args = {
                    'user' : $.trim($('#usuario').val()),
                    'fstn' : $.trim($('#firstname').val()),
                    'lstn' : $.trim($('#lastname').val()),
                    'mail' : $.trim($('#correo').val())
                };
                $('#btnnew').attr('disabled', true).text('Registrando, espere por favor...');
                $.ajaxreq({
                    url : 'users-add',
                    type : 'POST',
                    params : $.param(args),
                    callback : function( e ){
                        if(e){
                            alert('Usuario registrado!!!');
                            location.reload();
                        }
                    }
                });
            }
        });
        
        //Nuevo periodo
        var btnnewperiod = document.getElementById('btnnewperiod');
        btnnewperiod.addEventListener("click", function(){
            $('#id_periodo, #desc_periodo').validate({
                required : true,
                message : {
                    required : 'Requerido'
                }
            });
            $('#btnnewperiod').attr('disabled', true).text('Registrando, espere por favor...');
            if($.isValid){
                $.ajaxreq({
                    url : 'addcal',
                    type : 'POST',
                    params : 'id=' + $.trim($('#id_periodo').val()) + '&desc=' + $.trim($('#desc_periodo').val()),
                    callback : function( e ){
                        if(e){
                            alert('Periodo agregado!!!');
                            location.reload();
                        }
                    }
                });
            }
        });
    });
    function asignar() {
        var id_user = document.getElementById('s_usuarios').value.split('|');
        var parameters = {
            'usuario': id_user[0],
            'usern' : id_user[1],
            'niveles': document.getElementById('s_niveles').value,
            //'periodo': $('#s_periodo').val(),
            'program': $('#s_programas').val(),
            'areas': $('#s_areas').val(),
            'facultad': $('#s_facultades').val(),
            'facultadx': $('#s_facultadesaux').val(),
            'carreras': $('#s_carreras').val(),
            'cursos': $('#s_cursos').val(),
            'ciudad': $('#s_ciudad').val()
        }
        $.ajaxreq({
            url: 'users-save_assignment',
            type: 'POST',
            params: $.param(parameters),
            callback: function (e) {
                if (e) {
                    alert('Asignado correctamente');
                    location.reload();
                }
            }
        });
    }
</script>