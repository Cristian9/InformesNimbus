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
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-asterisk"></i>
                    <span>Listado de Usuarios</span>
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
            <div class="clearfix">&nbsp;</div>
            <div class="box-content padding-15">
                <table class="table table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Status</th>
                            <th>Asignado a</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Start: list_row -->
                        <?php
                            foreach($user as $value){
                        ?>
                        <tr>
                            <td><?php echo $value['username']; ?></td>
                            <td><img class="img-rounded" src="<?php echo base_url()?>static/images/avatar.jpg" alt=""><?php echo $value['firstname']; ?></td>
                            <td><?php echo $value['lastname']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['perfil']; ?></td>
                            <td><?php echo $value['active']; ?></td>
                            <td><?php echo $value['Accesos']; ?></td>
                            <td align="center" >
                                <a class="delete" href="users-delete?uid=<?php echo base64_encode($value['id']) ?>&uname=<?php echo base64_encode($value['username']) ?>&role=<?php echo base64_encode($value['perfil']) ?>" title="Eliminar asignacion" class="del_assign">
                                    <i class="fa fa-chain-broken fa-2x"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <!-- End: list_row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--End Dashboard 2 -->
<div class="clearfix"></div>
<p>&nbsp;</p>
<div class="row-fluid" id="d_bar"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable-1').dataTable({
            'scrollX': true,
            'language': {
                //'zeroRecords': 'No hay registros disponibles',
                'infoEmpty': 'No hay registros disponibles'
            },
            'dom': 'Bfrtip',
            'buttons': ['excelHtml5'],
        });

        $('.delete').each(function(){
            $(this).click(function(e){
                var _self = $(this);
                e.preventDefault();
                var dialog = new BootstrapDialog({
                    title : 'Confirmar !!',
                    message: 'Va a eliminar la asignación del usuario, desea continuar?',
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
                                window.location = _self.attr('href');
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
        });
    });
</script>