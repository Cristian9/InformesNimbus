<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Editar usuario</a></li>
        </ol>
    </div>
</div>
<div class="row" style="margin-left: 1px !important;">
    <?php
        $attr = array("class" => "form-horizontal", "id" => "defaultForm", "role" => "form");
        echo form_open("", $attr);
    ?>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Username:</label>
            <div class="col-sm-4">
                <input type="hidden" class="form-control" id="uid" value="<?php echo $uid; ?>" >
                <input type="text" class="form-control" id="uname" value="<?php echo $uname; ?>" >
            </div>
        </div>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Nombre:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="fname" value="<?php echo $fname; ?>" >
            </div>
        </div>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Apellido:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="lname" value="<?php echo $lname; ?>" >
            </div>
        </div>
        <div class="form-group has-success">
            <label class="col-sm-4 control-label">Email:</label>
            <div class="col-sm-4">
               <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" >
            </div>
        </div>
        <div class="form-group" id="div-message">
            <label class="col-sm-8 control-label" id="lbl-message"></label>
        </div>
    <?php echo form_close(); ?>
</div>