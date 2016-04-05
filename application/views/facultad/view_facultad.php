<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Facultad</a></li>
        </ol>
    </div>
</div>
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div id="dashboard-header">
    <div class="row" style="margin-left: 1px !important;">
        <div class="col-sm-4">
            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
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
            } else {
                $name_ciudad = [1 => 'Lima', 2 => 'Chiclayo'];
                foreach ($_SESSION['city'] as $value) {
                    echo "<div class='radio-inline'>";
                    echo "<label>";
                    echo "<input type='radio' name='radio-inline' value='" . $value['city_id'] . "' checked> " . $name_ciudad[$value['city_id']];
                    echo "<i class='fa fa-circle-o'></i>";
                    echo "</label>";
                    echo "</div>";
                }
            }
            ?>
        </div>
        <div class="col-sm-2" id="div_cbo_cat"><label>Programa *</label>
            <select class="populate placeholder" id="cbo_cat">
                <?php
                echo "<option value='0'>.:::Seleccione:::.</option>";

                foreach ($category as $item) {

                    echo "<option value='" . $item['id'] . "'>" . $item['category'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-sm-2" id="div_cbo_periodo"><label>Periodo *</label>
            <select class="populate placeholder" id="cbo_periodo">
                <?php
                echo "<option value='0'>.:::Seleccione:::.</option>";

                foreach ($periodo as $item) {

                    echo "<option value='" . $item['id'] . "'>" . $item['periodo'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-sm-3" id="div_cbo"><label>Facultades:</label>
            <select class="populate placeholder" id="cbo_facultades">
                <option value="0">.::: Todos :::.</option>
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
                                <input type="checkbox" value="documents" title="1"> Documentos
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="learnpaths" title="1"> Mis clases
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="links" title="1"> Enlaces
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
                                <input type="checkbox" value="forums" title="1"> Foros
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="announcements" title="1"> Anuncios
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="chats" title="0"> Chat
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="works" title="1"> Tareas
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="quizzes" title="1"> Evaluaciones
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="agenda" title="1"> Agenda
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="dropbox" title="0"> Comp. Documentos
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="survey" title="1"> Encuesta
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="groups" title="0"> Grupos
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="gradebook" title="1"> Form. Evaluaci&oacute;n
                                <i class="fa fa-square-o"></i>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="course_progress" title="1"> Prog. Did&aacute;ctica
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
                    <select class="populate placeholder" id="input_date">
                        <option value="-1">.:::Seleccione:::.</option>
                    </select>
                </div>

                <div class="col-sm-2"><label>Hasta *</label>
                    <select class="populate placeholder" id="input_date2">
                        <option value="-1">.:::Seleccione:::.</option>
                    </select>
                </div>
                <div class="col-sm-offset-1 col-sm-2">
                    <button type="button" id="btn_send" class="btn btn-primary btn-label-left">
                        <span><i class="fa fa-search"></i></span>
                        Consultar
                    </button>
                </div>
                <div class="col-sm-2">
                    <button type="button" id="btn_gr" class="btn btn-info btn-label-left">
                        <span><i class="fa fa-bar-chart-o"></i></span>
                        Graficar
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
                    <th>Tiempo de conexi&oacute;n</th>
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
                    <th>Tiempo de conexi&oacute;n</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!--End Dashboard 2 -->
<div class="clearfix"></div>
<p>&nbsp;</p>
<div class="row-fluid" id="d_bar"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('select').select2();

        var ciudad_select;
        $('input:radio[name=radio-inline]').each(function () {
            if ($(this).is(':checked')) {
                ciudad_select = $(this).val();
            }
        });

        cargar_select('cbo_facultades', 'facultad-getFacultad', ciudad_select);

        $('#cbo_cat').change(function () {
            var category = $(this).val();
            $('#cbo_periodo')
                .select2('val', 0)
                .html(null)
                .append("<option value='0'>.::: Seleccione :::.</option>");
            cargar_select('cbo_periodo', 'facultad-getPeriodos', category);
        });

        $('#cbo_periodo').change(function () {
            getWeeks();
        });

        $('input:radio[name=radio-inline]').each(function () {
            $(this).click(function () {
                ciudad_select = $(this).val();
                $('#cbo_facultades')
                    .select2('val', 0)
                    .html(null)
                    .append("<option value='0'>::: Todos :::</option>");
                cargar_select('cbo_facultades', 'facultad-getFacultad', ciudad_select);
            });
        });

        $('#btn_gr').click(function () {
            $('#cbo_periodo, #cbo_cat').validate({
                required: true,
                message: {
                    required: 'Requerido'
                }
            });
            
            if($('#input_date').val() == -1 || $('#input_date2').val() == -1){
                alert('Indicar el rango de semanas que desea consultar');
                return false;
            }

            if ($.isValid) {
                var ciudad = [];
                var herramienta = [];
                var iciudad = 0;
                var iherramienta = 0;
                $('input:radio[name=radio-inline]').each(function () {
                    if ($(this).is(':checked')) {
                        ciudad[iciudad] = $(this).val();
                        iciudad++;
                    }
                });
                $('input:checkbox').each(function () {
                    if ($(this).is(':checked')) {
                        var txt = $(this).val();
                        herramienta[iherramienta] = txt;
                        iherramienta++;
                    }
                });

                if (ciudad == "") {
                    ciudad[iciudad] = $('#city').val();
                }

                var e = document.getElementById('cbo_cat');
                var prg = $('#cbo_cat').val() + $('#cbo_periodo').val() + e.options[e.selectedIndex].text;
                var facultad = $('#cbo_facultades').val();
                var f1 = $('#input_date').val();
                var f2 = $('#input_date2').val();

                var params = {
                    'ciudad': ciudad,
                    'herramienta': herramienta,
                    'programa': prg,
                    'facultad': facultad,
                    'desde': f1,
                    'hasta': f2
                }

                graficar('facultad-graficar', params);
            }
        });
        $('#btn_send').click(function () {
            $('#d_bar').html(null);
            $('#cbo_periodo, #cbo_cat').validate({
                required: true,
                message: {
                    required: 'Requerido'
                }
            });
            
            if($('#input_date').val() == -1 || $('#input_date2').val() == -1){
                alert('Indicar el rango de semanas que desea consultar');
                return false;
            }
            if ($.isValid) {
                var tables = $.fn.dataTable.fnTables(true);
                $(tables).each(function () {
                    $(this).dataTable().fnClearTable();
                    $(this).dataTable().fnDestroy();
                });

                $('input:checkbox').each(function () {
                    $('#thead').find("#" + $(this).val() + "_head").remove();
                    $('#tfoot').find("#" + $(this).val() + "_foot").remove();
                    $('#thead').find("#" + $(this).val() + "_headbase").remove();
                    $('#tfoot').find("#" + $(this).val() + "_footbase").remove();
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
                $('input:checkbox').each(function () {
                    if ($(this).is(':checked')) {
                        var txt = $(this).val();
                        var base_course = $(this).attr('title');
                        add_columnas('datatable_area', txt, base_course);
                        check[icheck] = txt;
                        icheck++;
                        if (base_course == 1) {
                            check[icheck] = txt + '_course_base';
                            icheck++
                        }
                    }
                });

                if (radio == "") {
                    radio[iradio] = $('#city').val();
                }

                var e = document.getElementById('cbo_cat');
                var prg = $('#cbo_cat').val() + $('#cbo_periodo').val() + e.options[e.selectedIndex].text;
                var cbo = $('#cbo_facultades').val();
                var f1 = $('#input_date').val();
                var f2 = $('#input_date2').val();
                var csrf = $.cookie('nbscookie');

                $('#datatable_area').removeClass('hidden').dataTable({
                    'scrollX': true,
                    'language': {
                        'zeroRecords': 'No hay registros disponibles',
                        "infoEmpty": "Sin registros que mostrar",
                        "loadingRecords": "Cargando..."
                    },
                    'dom': 'Bfrtip',
                    'buttons': ['excelHtml5', 'csvHtml5'],
                    'ajax': {
                        'type': 'POST',
                        'url': 'facultad-listar',
                        'dataSrc': function (data) {
                            return (data != '') ? data['estadisticas'] : false;
                        },
                        'dataType': 'json',
                        'data': {
                            'nbstoken' : csrf,
                            'prg': prg,
                            'radio': radio,
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