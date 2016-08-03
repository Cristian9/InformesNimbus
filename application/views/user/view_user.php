<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Usuarios asignados</a></li>
        </ol>
    </div>
</div>
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div class="row-fluid">
    <div class="clearfix"></div>
    <div class="box-content no-padding">
        <table class="display table-striped table-heading nowrap" cellspacing="0" width="100%" id="view-users">
            <thead>
                <tr>
                    <th></th>
                    <th>Usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th></th>
                    <th>Usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Opciones</th>
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
        var csrf = $.cookie('nbscookie');
        var tablejs = "";

        var tables = $.fn.dataTable.fnTables(true);
        $(tables).each(function () {
            $(this).dataTable().fnClearTable();
            $(this).dataTable().fnDestroy();
        });

        tablejs = $('#view-users').DataTable({
            'dom': 'Bfrtip',
            'buttons': ['excelHtml5'],
            'ajax' : {
                'type' : 'POST',
                'url' : 'users-getList',
                'dataType' : 'json',
                'data' : {
                    'nbstoken' : csrf
                }
            },
            'columns' : [
                {
                    'className' : 'details-control',
                    'orderable' : false,
                    'data' : null,
                    'defaultContent' : ''
                },
                {'data' : 'username'},
                {'data' : 'firstname'},
                {'data' : 'lastname'},
                {'data' : 'email'},
                {'data' : 'perfil'},
                {
                    'data' : function(data) {
                        return ('<a class="edit" title="Editar registro" style="cursor:pointer;">' + 
                                    '<i class="fa fa-pencil fa-lg fa-2x" alt="'+data.id+'"></i>' + 
                                '</a>&nbsp;&nbsp;&nbsp;' + 
                                '<a class="delete" alt="users-delete?type=0&uid=' + base64_encode(data.id) +
                                    '&uname='+base64_encode(data.username)+'&role=' + base64_encode(data.perfil) + 
                                    '" title="Eliminar asignacion" class="del_assign">' + 
                                    '<i class="fa fa-chain-broken fa-2x"></i>' + 
                                '</a>&nbsp;&nbsp;&nbsp;' + 
                                '<a class="delete" alt="users-delete?type=1&uid=' + base64_encode(data.id) +
                                    '&uname='+base64_encode(data.username)+'&role=' + base64_encode(data.perfil) + 
                                    '" title="Eliminar usuario" class="del_assign">' + 
                                    '<i class="fa fa-trash fa-2x"></i>' + 
                                '</a>'
                                );
                    }
                }
            ],
            'order' : [[5, 'asc']]
        });

        function format(d) {
            return '<table cellpadding="5" cellspacing="0" border="1" width="100%" style="padding-left:50px;">'+
                        '<tr style="background:#4cabfb; color:#FFF;">'+
                            '<td>Area</td>'+
                            '<td>Facultad</td>'+
                            '<td>Escuela</td>'+
                            '<td>Curso</td>'+
                            '<td>Ciudad</td>'+
                            '<td>Programa</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>'+d.area+'</td>'+
                            '<td>'+d.facultad+'</td>'+
                            '<td>'+d.escuela+'</td>'+
                            '<td>'+d.curso+'</td>'+
                            '<td>'+d.ciudad+'</td>'+
                            '<td>'+d.programa+'</td>'+
                        '</tr>'+
                    '</table>';
        }

        $('#view-users').on("click", '.delete', function(){
            var _self = $(this);
            var dialog = new BootstrapDialog({
                title : 'Confirmar !!',
                message: 'Seguro que quiere continuar?',
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
                            window.location = _self.attr('alt');
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
        });

        $('#view-users').on("click", '.edit', function(){
            var csrf = $.cookie('nbscookie');
            var uname = $(this).parent().prev().prev().prev().prev().prev().html();
            var fname = $(this).parent().prev().prev().prev().prev().html();
            var lname = $(this).parent().prev().prev().prev().html();
            var email = $(this).parent().prev().prev().html();
            var perfil = $(this).parent().prev().html();
            
            BootstrapDialog.show({
                title: "Editar",
                size : BootstrapDialog.SIZE_NORMAL,
                message: $('<div></div>').load('users-edit', {
                    uname       :   uname,
                    nbstoken    :   csrf,
                    fname       :   fname,
                    lname       :   lname,
                    email       :   email,
                    perfil      :   perfil
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

                        var uid   = $('#uid').val();
                        var uname = $('#uname').val();
                        var fname = $('#fname').val();
                        var lname = $('#lname').val();
                        var email = $('#email').val();
                        var perfil = $('#perfil').val();

                        $.post('users-upduser', {
                            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                            uid     : uid,
                            uname   : uname,
                            fname   : fname,
                            lname   : lname,
                            email   : email,
                            perfil  : perfil
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

        $('#view-users tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = tablejs.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
</script>