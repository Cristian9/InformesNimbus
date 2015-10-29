<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Secciones</a></li>
        </ol>
    </div>
</div>
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div id="dashboard-header">
    <div class="row" style="margin-left: 1px !important;">
        <div class="col-sm-4">
            <?php if($_SESSION['rol'] == 1){ ?>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="radio-inline" value="1" checked> Lima
                    <i class="fa fa-circle-o"></i>
                </label>
            </div>
            <div class="radio-inline">
                <label>
                    <input type="radio" name="radio-inline" value="2"> Chiclayo
                    <i class="fa fa-circle-o"></i>
                </label>
            </div>
            <?php 
                }else{
                    $name_ciudad = [1 => 'Lima', 2 => 'Chiclayo'];
                    foreach ($_SESSION['city'] as $value) {
                        echo "<div class='radio-inline'>";
                            echo "<label>";
                                echo "<input type='radio' name='radio-inline' value='".$value['city_id']."' checked> ".$name_ciudad[$value['city_id']];
                                echo "<i class='fa fa-circle-o'></i>";
                            echo "</label>";
                        echo "</div>";
                    }
                    //echo "<input type='hidden' id='city' value='".$_SESSION['city']."'>";
                }
            ?>
        </div>
        <div class="col-sm-2" id="div_cbo_periodo"><label>Periodo *</label>
            <select class="populate placeholder" id="cbo_periodo">
                <?php
                    //if($_SESSION['rol'] == 1){

                        echo "<option value='0'>.:::Seleccione:::.</option>";

                        foreach($periodo as $item){

                            echo "<option value='" . $item['id'] . "'>" . $item['periodo'] . "</option>";

                        }
                    /*}else{

                        foreach ($_SESSION['periodo'] as $value) {
                            echo "<option value='" . $value['period_id'] . "'>" . $value['periodo'] . "</option>";
                        }

                    }*/
                ?>
            </select>
        </div>
        <div class="col-sm-2" id="div_cbo_cat"><label>Programa *</label>
            <select class="populate placeholder" id="cbo_cat">
                <?php
                    if($_SESSION['rol'] == 1){

                        echo "<option value='0'>.:::Seleccione:::.</option>";
                        echo "<option value='A'>PREGRADO</option>";
                        echo "<option value='B'>PPE</option>";
                        echo "<option value='C'>PET</option>";

                    }else{

                        foreach ($_SESSION['category'] as $value) {
                            echo "<option value='" . $value['category_id'] . "'>" . $value['category'] . "</option>";
                        }

                    }
                ?>
            </select>
        </div>
        <div class="col-sm-3" id="div_cbo"><label>Secciones</label>
            <select class="populate placeholder" id="cbo_secciones">
                <option value="0">.:::Todos:::.</option>
            </select>
        </div>
    </div><br/>
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Herramientas</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <h4 class="page-header">Contenido</h4>
                <div class="row form-group">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="documents"> Documentos
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="learnpaths"> Mis clases
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="links"> Enlaces
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <h4 class="page-header">Interacci&oacute;n</h4>
                <div class="row form-group">
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="forums"> Foros
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="announcements"> Anuncios
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="chats"> Chat
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="works"> Tareas
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="quizzes"> Evaluaciones
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="agenda"> Agenda
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="dropbox"> Comp. Documentos
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="survey"> Encuesta
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="groups"> Grupos
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="gradebook"> Form. Evaluaci&oacute;n
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="course_progress"> Prog. Did&aacute;ctica
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="wiki"> Wiki
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br />
    <div class="box-content">
        <form class="form-horizontal" role="form">
            <div class="form-group has-feedback">
                <div class="col-sm-2"><label>Desde *</label>
                    <!--<input type="text" id="input_date" class="form-control" placeholder="Date">
                    <span class="fa fa-calendar txt-danger form-control-feedback"></span>-->
                    <select class="populate placeholder" id="input_date">
                        <option value="0">.:::Seleccione:::.</option>
                        <?php
                        for ($i = 1; $i <= 14; $i++) {
                            echo "<option value='" . $i . "'>Semana " . $i . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-sm-2"><label>Hasta *</label>
                    <!--<input type="text" id="input_date2" class="form-control" placeholder="Date">
                    <span class="fa fa-calendar txt-danger form-control-feedback"></span>-->
                    <select class="populate placeholder" id="input_date2">
                        <option value="0">.:::Seleccione:::.</option>
                        <?php
                        for ($i = 1; $i <= 14; $i++) {
                            echo "<option value='" . $i . "'>Semana " . $i . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-offset-1 col-sm-2">
                    <button type="button" id="btn_send" class="btn btn-primary btn-label-left">
                        <span><i class="fa fa-search"></i></span>
                        Consultar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--End Dashboard 1-->
<!--Start Dashboard 2-->
<div class="row-fluid">
    <div class="clearfix"></div>
    <div id="dashboard_tabs" class="col-xs-12 col-sm-12">
        <div class="box-content no-padding">
            <table class="display hidden" cellspacing="0" width="100%" id="datatable_area">
                <thead>
                    <tr id="thead">
                        <th>Categoria</th>
                        <th>Facultad</th>
                        <th>Escuela</th>
                        <th>Num_usuarios</th>
                        <th>Cod_seccion</th>
                        <th>Cod_curso</th>
                        <th>Turno</th>
                        <th>Curso</th>
                        <th>Cod_docente</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr id="tfoot">
                        <th>Categoria</th>
                        <th>Facultad</th>
                        <th>Escuela</th>
                        <th>Num_usuarios</th>
                        <th>Cod_seccion</th>
                        <th>Cod_curso</th>
                        <th>Turno</th>
                        <th>Curso</th>
                        <th>Cod_docente</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!--End Dashboard 2 -->
<script type="text/javascript">
    function cargar_select_seccion( valchk ) {
        var select = "";
        var prg = $('#cbo_cat').val() + $('#cbo_periodo').val();
        $('#cbo_secciones')
                .attr('disabled', true)
                .html("<option value='0'>Cargando.....</option>");
        $.post('secciones-getSecciones', {
            'chk': valchk,
            'programa': prg
        }, function (e) {
            var json = eval('(' + e + ')');
            select += "<option value='0'>.:::Todos:::.</option>";
            for (var cbo = 0; cbo < json.listas.length; cbo++) {
                select += "<option " +
                        "value = '" + 
                        json.listas[cbo]['name'] + "'>" +
                        json.listas[cbo]['id'] + ' - ' +
                        json.listas[cbo]['name'] +
                        "</option>";
            }

            $('#cbo_secciones').removeAttr('disabled').html(null).append(select);
        });
    }
    
    $(document).ready(function () {
        $('#cbo_periodo, #cbo_cat, #cbo_secciones, #input_date, #input_date2').select2();

        $('input:radio[name=radio-inline]').each(function () {
            $(this).click(function () {
                $('#cbo_cat, #cbo_periodo').validate({
                    required: true,
                    message: {
                        required: 'Requerido'
                    }
                });

                if ($.isValid) {
                    var chk = $(this).val();
                    cargar_select_seccion(chk);
                }
            });
        });
        
        $('#cbo_cat, #cbo_periodo').change(function(){
            var chk = "";
            $('input:radio[name=radio-inline]').each(function () {
                if($(this).is(':checked')){
                    chk = $(this).val();
                }
            });
            
            $('#cbo_periodo').validate({
                required : true,
                message : {
                    required : 'Requerido'
                }
            });
            
            if($.isValid){
                cargar_select_seccion(chk);
            }
        });

        var chk ="";
        $('input:radio[name=radio-inline]').each(function () {
            if($(this).is(':checked')){
                chk = $(this).val();
            }
        });
        cargar_select_seccion(chk);
        
        $('#btn_send').click(function () {

            $('#input_date, #input_date2, #cbo_periodo, #cbo_cat').validate({
                required: true,
                message: {
                    required: 'Requerido'
                }
            });

            if ($.isValid) {

                var tables = $.fn.dataTable.fnTables(true);
                $(tables).each(function () {
                    $(this).dataTable().fnClearTable();
                    $(this).dataTable().fnDestroy();
                });
                
                $('input:checkbox').each(function () {
                    $('#thead').find("#" + $(this).val() + "_head").remove();
                    $('#tfoot').find("#" + $(this).val() + "_foot").remove();
                });
                
                var radio = [];
                var check = [];
                var icheck = 0;
                var iradio = 0;
                
                $('input:radio[name=radio-inline]').each(function () {
                    if ($(this).is(':checked')) {
                        radio[iradio] = $(this).val();
                        iradio++;
                    }
                });

                if(radio == ""){
                    radio[iradio] = $('#city').val();
                }

                $('input:checkbox').each(function () {
                    if ($(this).is(':checked')) {
                        var txt = $(this).val();
                        add_columnas('datatable_area', txt);
                        check[icheck] = txt;
                        icheck++;
                    }
                });

                var e = document.getElementById('cbo_cat');
                var prg = $('#cbo_cat').val() + $('#cbo_periodo').val() + e.options[e.selectedIndex].text;
                var cbo = $('#cbo_secciones').val();
                var f1 = $('#input_date').val();
                var f2 = $('#input_date2').val();

                $('#datatable_area').removeClass('hidden').dataTable({
                    'scrollX': true,
                    'language': {
                        //'zeroRecords': 'No hay registros disponibles',
                        'infoEmpty': 'No hay registros disponibles'
                    },
                    'dom': 'Bfrtip',
                    'buttons': ['excelHtml5', 'csvHtml5'],
                    'ajax': {
                        'type': 'POST',
                        'url': 'secciones-listar',
                        'dataSrc': "estadisticas",
                        'dataType': 'json',
                        'data': {
                            'radio': radio,
                            'prg': prg,
                            'check': check,
                            'cbo': cbo,
                            'f1': f1,
                            'f2': f2
                        }
                    }
                });
            }
        });
    });
</script>