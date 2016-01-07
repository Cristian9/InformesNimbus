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
                    <th>Usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Area</th>
                    <th>Facultad</th>
                    <th>Escuela</th>
                    <th>Curso</th>
                    <th>Ciudad</th>
                    <th>Programa</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Start: list_row -->
                <?php
                    foreach($user as $value){
                ?>
                <tr>
                    <td><?php echo $value['username']; ?></td>
                    <td><img class="img-rounded" src="<?php echo base_url()?>static/images/avatar.jpg" alt="">&nbsp;&nbsp;<?php echo $value['firstname']; ?></td>
                    <td><?php echo $value['lastname']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['perfil']; ?></td>
                    <td><?php echo $value['area']; ?></td>
                    <td><?php echo $value['facultad']; ?></td>
                    <td><?php echo $value['escuela']; ?></td>
                    <td><?php echo $value['curso']; ?></td>
                    <td><?php echo $value['ciudad']; ?></td>
                    <td><?php echo $value['programa']; ?></td>
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
            <tfoot>
                <tr>
                    <th>Usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Area</th>
                    <th>Facultad</th>
                    <th>Escuela</th>
                    <th>Curso</th>
                    <th>Ciudad</th>
                    <th>Programa</th>
                    <th>Eliminar</th>
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
        $('#view-users').dataTable({
            'scrollX': true,
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