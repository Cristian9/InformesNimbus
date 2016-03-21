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
<div class="row" style="margin-left: 1px !important;">
    <?php
        $attr = array("class" => "form-horizontal", "id" => "defaultForm", "role" => "form");
        echo form_open("", $attr);
    ?>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Programa:</label>
            <div class="col-sm-4">
                <input type="hidden" class="form-control" id="category_id" value="<?php echo $idcategory; ?>" >
                <?php echo $programaid; ?>
            </div>
        </div>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Fecha inicio:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="start_date_edit" value="<?php echo $fechainicio; ?>" >
            </div>
        </div>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Fecha final:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="end_date_edit" value="<?php echo $fechafin; ?>" >
            </div>
        </div>
        <div class="form-group" id="div-message">
            <label class="col-sm-8 control-label" id="lbl-message"></label>
        </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(function(){
        $('select').select2();
        $('#start_date_edit, #end_date_edit').datepicker();
    });
</script>