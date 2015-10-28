<!--Start Breadcrumb-->
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Usuarios</a></li>
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
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Start: list_row -->
                        <?php
                            foreach($user as $value){
                        ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><img class="img-rounded" src="<?php echo base_url()?>static/images/avatar.jpg" alt=""><?php echo $value['firstname']; ?></td>
                            <td><?php echo $value['lastname']; ?></td>
                            <td><?php echo $value['username']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['active']; ?></td>
                            <td align="center"><a href="" title="Eliminar asignacion"><i class="fa fa-trash-o fa-2x"></i></a></td>
                        <?php
                            }
                        ?>
                        <!-- End: list_row -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
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
    });
</script>