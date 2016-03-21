<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Fechas de inicio</a></li>
        </ol>
    </div>
</div>
<div id="dashboard-header">
    <div class="row" style="margin-left: 1px !important;">
        <div class="col-sm-2" id="div_cbo_cat"><label>Programa *</label>
            <select class="populate placeholder" id="cbo_cat">
                <option value="0">.::: Seleccione :::.</option>
                <?php
                foreach ($programs as $value):
                ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->category; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-sm-2" id="div_cbo_periodo"><label>Periodo *</label>
            <select class="populate placeholder" id="cbo_periodo">
                <option value="0">.::: Seleccione :::.</option>
                <?php
                foreach ($periodos as $value):
                ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->periodo; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-sm-2" id="div_startdate"><label>Fecha inicio *</label>
            <input type="text" class="form-control" id="start_date" placeholder="dd/mm/YYYY">
        </div>
        <div class="col-sm-2" id="div_enddate"><label>Fecha final *</label>
            <input type="text" class="form-control" id="end_date" placeholder="dd/mm/YYYY">
        </div>
        <div class="col-sm-2"><br>
            <button type="button" id="btnguardar" class="btn btn-info">Guardar</button>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<p>&nbsp;</p>
<div class="col-xs-12 col-sm-10">
    <div class="row-fluid" id="d_bar">
        <div class="box-content no-padding">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Fechas establecidas</span>
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
                    <table class="display table-striped table-heading nowrap" cellspacing="0" width="100%" id="view-users">
                        <thead>
                            <tr>
                                <th>Categor&iacute;a id</th>
                                <th>Periodo</th>
                                <th>Categor&iacute;a</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de fin</th>
                                <th>Semanas</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($periodcate as $value):
                            
                            ?>
                            <tr>
                                <td><?php echo $value->category_id; ?></td>
                                <td><?php echo $value->period; ?></td>
                                <td><?php echo $value->category; ?></td>
                                <td><?php echo $value->start_date; ?></td>
                                <td><?php echo $value->end_date; ?></td>
                                <td><?php echo $value->weeks; ?></td>
                                <td>
                                    <a class="edit" title="Editar registro" style="cursor:pointer;">
                                        <i class="fa fa-pencil fa-lg" alt="<?php echo base64_encode($value->id); ?>"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Categor&iacute;a id</th>
                                <th>Periodo</th>
                                <th>Categor&iacute;a</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de fin</th>
                                <th>Semanas</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        function dialogs(type, btnlabel, classbtn, message, title, reload){
            return (
                BootstrapDialog.show({
                    type     : type,
                    title    : title,
                    size     : BootstrapDialog.SIZE_NORMAL,
                    message  : message,
                    cssClass : 'alert',
                    buttons  : [{
                        label: btnlabel,
                        cssClass: classbtn,
                        action: function(dialogRef){   
                            if(reload)
                                location.reload();
                            dialogRef.close();
                        }
                    }]
                })
            );
        }

        $('#btnguardar').click(function(){
            $('#cbo_cat, #cbo_periodo, #start_date, #end_date').validate({
                required : true,
                message : {
                    required : 'Requerido'
                }
            });

            if($.isValid){
                var indice      = document.getElementById('cbo_cat');
                var programa    = indice.options[indice.selectedIndex].text;
                var idprograma  = $('#cbo_cat').val();
                var periodo     = $('#cbo_periodo').val();
                var fec_inicio  = $('#start_date').val().split('/').reverse().join('-');
                var fec_final   = $('#end_date').val().split('/').reverse().join('-');
                var csrf        = $.cookie('nbscookie');
                
                $.post('main-addfechainicio', {
                    programa    : programa,
                    idprograma  : idprograma,
                    periodo     : periodo,
                    fec_inicio  : fec_inicio,
                    fec_final   : fec_final,
                    nbstoken    : csrf
                })
                .done(function(response){
                    if(response){
                        dialogs(BootstrapDialog.TYPE_SUCCESS,
                            'Aceptar', 
                            'btn-primary',
                            'Registrado correctamente!',
                            'Confirmación', 1);
                    } else {
                        dialogs(BootstrapDialog.TYPE_DANGER,
                            'Aceptar', 
                            'btn-danger',
                            'No se guardo el registro, verifique!',
                            'Error', 0);
                    }
                });
            }
        });

        $('#view-users').dataTable({
            'scrollX': true,
            'dom': 'Bfrtip',
            'buttons': ['excelHtml5'],
        });

        $('select').select2();
        $('#start_date, #end_date').datepicker();

        $('.edit').each(function(){
            $(this).click(function(){

                var csrf = $.cookie('nbscookie');
                var idcategory  = $(this).find('i').attr('alt');
                var programaid  = $(this).parent().prev().prev().prev().prev().html();
                var fechainicio = $(this).parent().prev().prev().prev().html();
                var fechafin    = $(this).parent().prev().prev().html();

                BootstrapDialog.show({
                    title: "Editar",
                    size : BootstrapDialog.SIZE_NORMAL,
                    message: $('<div></div>').load('main-edit', {
                        idcategory  :   idcategory,
                        nbstoken    :   csrf,
                        programaid  :   programaid,
                        fechainicio :   fechainicio.split('-').reverse().join('/'),
                        fechafin    :   fechafin.split('-').reverse().join('/')
                    }),
                    closable: false,
                    cssClass : 'modal_page',
                    buttons: [{
                        label: 'Cancelar',
                        cssClass: 'btn-danger',
                        action: function(dialogRef){
                            dialogRef.close();
                        }
                    }, {
                        label: 'Actualizar',
                        cssClass: 'btn-primary',
                        action: function(dialogRef){

                            var start_edit = $('#start_date_edit').val().split('/').reverse().join('-');
                            var end_edit = $('#end_date_edit').val().split('/').reverse().join('-');
                            var idcategory = $('#category_id').val();

                            $.post('main-updfechas', {
                                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                                start_edit : start_edit,
                                end_edit : end_edit,
                                idcategory : idcategory
                            })
                            .done(function(response){
                                if(response){
                                    $('#div-message').removeClass('has-error').addClass('has-success');
                                    $('#lbl-message').text('Registro actualizado correctamente!');
                                    setTimeout(function(){
                                        location.reload();
                                        dialogRef.close();
                                    }, 500);
                                } else {
                                    $('#div-message').removeClass('has-success').addClass('has-error');
                                    $('#lbl-message').text('Hubo un error intentado actualizar, verifique!');
                                }
                            });
                        }
                    }]
                });
            });
        });
    });
</script>