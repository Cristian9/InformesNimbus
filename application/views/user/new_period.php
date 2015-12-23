<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Nuevo periodo</a></li>
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
</div>
<script type="text/javascript">
    $(document).ready(function () {     
        //Nuevo periodo
        var btnnewperiod = document.getElementById('btnnewperiod');
        btnnewperiod.addEventListener("click", function(){
            $('#id_periodo, #desc_periodo').validate({
                required : true,
                message : {
                    required : 'Requerido'
                }
            });
            if($.isValid){
                $('#btnnewperiod').attr('disabled', true).text('Registrando, espere por favor...');
                $.post('addcal', {
                    id : $.trim($('#id_periodo').val()),
                    desc : $.trim($('#desc_periodo').val())
                })
                .done(function(e){
                    if (!e) {
                        var alert = new BootstrapDialog({
                            title : 'Aviso',
                            cssClass : 'alert',
                            message : 'El periodo ingresado ya existe !!!',
                            buttons : [
                                {
                                    label : 'Aceptar',
                                    cssClass : 'btn-primary',
                                    action : function(dialogRef){
                                        dialogRef.close();
                                        
                                    }
                                }
                            ]
                        });
                        $('#btnnewperiod').attr('disabled', false).text('Agregar periodo');
                        $('input:text').val(null);
                        $('#id_periodo').focus();
                        alert.open();
                    } else {
                        var alert = new BootstrapDialog({
                            title : 'Aviso',
                            cssClass : 'alert',
                            message : 'Periodo ingresado correctamente',
                            buttons : [
                                {
                                    label : 'Aceptar',
                                    cssClass : 'btn-primary',
                                    action : function(){
                                        location.reload();
                                    }
                                }
                            ]
                        });
                        alert.open();
                    }
                });
            }
        });
    });
</script>