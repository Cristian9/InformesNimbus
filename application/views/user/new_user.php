<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Nuevo usuario</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-user"></i>
                    <span>Agregar usuario</span>
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
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#usuario').blur(function(){
            var _self = $(this);
            var username = _self.val();
            $.ajaxreq({
                url : 'users-review',
                type : 'POST',
                params : 'username=' + username + '&type=new',
                callback : function(e){
                    if(e){
                        alert('Ya existe un usuario con ese mismo nombre!!!');
                        $('#btnnew').attr('disabled', true);
                        _self.focus();
                    }else{
                        $('#btnnew').attr('disabled', false);
                    }
                }
            });
        });
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
                        if(e != 'error'){
                            alert('Usuario registrado!!!');
                            location.reload();
                        } else {
                            alert('Error al intentar registrar al usuario, verifique por favor.');
                        }
                    }
                });
            }
        });
    });
</script>