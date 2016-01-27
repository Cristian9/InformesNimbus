<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Asignar perfil</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-users"></i>
                    <span>Asignar perfil de usuario</span>
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
                <!--<form id="defaultForm" method="post" action="" class="form-horizontal">-->
                <?php
                    $attr = array("class" => "form-horizontal", "id" => "defaultForm", "role" => "form");
                    echo form_open("", $attr);
                ?>
                    <fieldset>
                        <legend>Seleccione usuario</legend>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Usuario</label>
                            <div class="col-sm-6">
                                <select class="populate placeholder" name="country" id="s_usuarios">
                                    <option value="subzero">-- Seleccione usuario --</option>
                                    <?php
                                    foreach ($user as $v):
                                        ?>
                                        <option value="<?php echo $v['id'] . '|' . $v['username'] ?>">
                                            <?php echo $v['lastname'] . ', ' . $v['firstname'] . ' - ' . $v['username'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Perfil</label>
                            <div class="col-sm-5">
                                <select class="populate placeholder" name="country" id="s_niveles">
                                    <option value="subzero">-- Seleccione un nivel --</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Vicerector</option>
                                    <option value="3">Director de &aacute;rea</option>
                                    <option value="4">Decano</option>
                                    <option value="5">Director de Carrera</option>
                                    <option value="6">Coordinador de Curso</option>
                                </select>
                            </div>
                        </div>
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
                                </select>
                            </div>
                        </div>
                    </fieldset>
                <!--</form>-->
                <?php echo form_close(); ?>
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
    <div class="col-xs-12 col-sm-8 hiddenxs 2">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Vicerector</span>
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
                    <legend>Asignar</legend>
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
                                <option value="zubsero">-- Seleccione --</option>
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
                                <option value="zubsero">-- Seleccione --</option>
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
                                <option value="zubsero">-- Seleccione --</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Carreras</label>
                        <div class="col-sm-5">
                            <select class="populate placeholder" multiple name="country" id="s_carreras">
                                <option value="zubsero">-- Seleccione --</option>
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
                                <option value="zubsero">-- Seleccione --</option>
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
    var nivel = 0;
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

            (item == '1' || item == '2') && $('.adm').css({'display': 'none'});

            nivel = item;

            $('.hiddenxs')
                .not('.' + item)
                .css({
                    'display': 'none'
                });
        });

        cargar_select('s_areas', 'users-get_areas');
        cargar_select('s_facultades', 'users-get_facultades');
        cargar_select('s_facultadesaux', 'users-get_facultades');
        cargar_select('s_cursos', 'users-get_cursos');
        cargar_select('s_programas', 'users-get_category');

        $('#s_facultadesaux').change(function () {
            var facultad = {
                'facultad': $(this).val()
            }
            $('#s_carreras')
                .html(null)
                .append('<option value="0">-- Seleccione --</option>');
                
            cargar_select('s_carreras', 'users-get_carreras', facultad);
        })

        var btn = document.getElementsByClassName('btn-primary');
        for (var i = 0; i < btn.length; i++) {
            btn.item(i).addEventListener("click", function () {
                var nivel = document.getElementById('s_niveles').value;
                if (nivel != '1' && nivel != '2') {
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
    });
    function asignar() {
        var id_user = document.getElementById('s_usuarios').value.split('|');
        $.post('users-review', {
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
            'username' : id_user[1],
            'type' : 'sign'
        })
        .done(function(e){
            if(e){
                var dialog = new BootstrapDialog({

                    title : 'Confirmar !!',
                    message: 'Este usuario ya tiene asignado un perfil diferente, desea continuar y actualizar al perfil seleccionado?',
                    tabindex: 50,
                    cssClass : 'alert',
                    buttons: [
                        {
                            id: 'btn-ok',        
                            label: 'Aceptar',
                            cssClass: 'btn-primary', 
                            autospin: false,
                            action: function(dialogRef){    
                                dialogRef.close();
                                $.post('users-save_assignment', {
                                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                                    'usuario'   :   id_user[0],
                                    'usern'     :   id_user[1],
                                    'niveles'   :   document.getElementById('s_niveles').value,
                                    'program'   :   $('#s_programas').val(),
                                    'areas'     :   (nivel == 3) ? $('#s_areas').val() : '',
                                    'facultad'  :   (nivel == 4) ? $('#s_facultades').val() : '',
                                    'facultadx' :   (nivel == 5) ? $('#s_facultadesaux').val() : '',
                                    'carreras'  :   (nivel == 5) ? $('#s_carreras').val() : '',
                                    'cursos'    :   (nivel == 6) ? $('#s_cursos').val() : '',
                                    'ciudad'    :   $('#s_ciudad').val()
                                })
                                .done(function(e){
                                    var alertconfirm = new BootstrapDialog({
                                        title : 'Aviso',
                                        cssClass : 'alert',
                                        message : 'Usuario asignado correctamente',
                                        buttons : [
                                            {
                                                label : 'Aceptar',
                                                cssClass : 'btn-primary',
                                                action : function(dialogRef){
                                                    $('select').each(function(){
                                                        var attribute = $(this).attr('multiple');
                                                        if(typeof attribute === 'undefined'){
                                                            $(this).select2('val', 'subzero');
                                                        } else {
                                                            $(this).select2('val', null);
                                                        }
                                                    });
                                                    $('.hiddenxs').css({'display': 'none'});
                                                    dialogRef.close();
                                                }
                                            }
                                        ]
                                    });
                                    alertconfirm.open();
                                });
                            }
                        },
                        {
                            id : 'btn-cancel',
                            label : 'Cancelar',
                            cssClass : 'btn-danger',
                            autospin : false,
                            action: function(dialogRef){
                                dialogRef.close();
                            }
                        }
                    ]
                });
                dialog.open();
            } else {
                $.post('users-save_assignment', {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'usuario': id_user[0],
                    'usern' : id_user[1],
                    'niveles': document.getElementById('s_niveles').value,
                    'program': $('#s_programas').val(),
                    'areas': $('#s_areas').val(),
                    'facultad': $('#s_facultades').val(),
                    'facultadx': $('#s_facultadesaux').val(),
                    'carreras': $('#s_carreras').val(),
                    'cursos': $('#s_cursos').val(),
                    'ciudad': $('#s_ciudad').val()
                })
                .done(function(e){
                    var alert = new BootstrapDialog({
                        title : 'Aviso',
                        cssClass : 'alert',
                        message : 'Usuario asignado correctamente',
                        buttons : [
                            {
                                label : 'Aceptar',
                                cssClass : 'btn-primary',
                                action : function(){
                                    $('select').each(function(){
                                        var attribute = $(this).attr('multiple');
                                        if(typeof attribute === 'undefined'){
                                            $(this).select2('val', 'subzero');
                                        } else {
                                            $(this).select2('val', null);
                                        }
                                    });
                                    $('.hiddenxs').css({'display': 'none'});
                                    dialogRef.close();
                                }
                            }
                        ]
                    });
                    alert.open();
                });
            }
        })
    }
</script>