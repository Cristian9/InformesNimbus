<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="main-menu">Home</a></li>
            <li><a href="#">Habilitar &aacute;reas y facultades</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-dashboard"></i>
                    <span>&Aacute;reas</span>
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
                    <div class="col-xs-10 col-sm-5">
                    	<label>Deshabilitado</label><br>
                    	<select multiple id="disablearea" class="form-control" style="height: 300px;"></select>
                    </div>
                    <div class="col-xs-10 col-sm-1">
                    	<br><br><br><br>
                    	<button type="button" id="btn-enable-area" class="btn btn-success btn-app">
                    		<i class="fa fa-angle-double-right"></i>
                    	</button>
                    	<button type="button" id="btn-disable-area" class="btn btn-danger btn-app">
                    		<i class="fa fa-angle-double-left"></i>
                    	</button>
                    </div>
                    <div class="col-xs-10 col-sm-5">
                    	<label>Habilitado</label><br>
                    	<select multiple id="enablearea" class="form-control" style="height: 300px;"></select>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Facultades</span>
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
                    <div class="col-xs-10 col-sm-5">
                    	<label>Deshabilitado</label><br>
                    	<select multiple id="disablefacultad" class="form-control" style="height: 300px;"></select>
                    </div>
                    <div class="col-xs-1 col-sm-1">
                    	<br><br><br><br>
                    	<button type="button" id="btn-enable-fac" class="btn btn-success btn-app">
                    		<i class="fa fa-angle-double-right"></i>
                    	</button>
                    	<button type="button" id="btn-disable-fac" class="btn btn-danger btn-app">
                    		<i class="fa fa-angle-double-left"></i>
                    	</button>
                    </div>
                    <div class="col-xs-10 col-sm-5">
                    	<label>Habilitado</label><br>
                    	<select multiple id="enablefacultad" class="form-control" style="height: 300px;"></select>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function enabled(obj, type, action){
        var csrf = $.cookie('nbscookie');
        $.post('main-habilitar', {
            type : type,
            action : action,
            ids : $('#' + obj).val(),
            nbstoken : csrf

        })
        .done(function(response){
            if(response) {
                getItems(type);
            }
        });
	};

    function getItems(type){
        type = type || null;

        if (type == 'areas') {
            // areas
            $('#enablearea, #disablearea').html(null);
            cargar_select('enablearea', 'area-getAreas', '1');
            cargar_select('disablearea', 'area-getAreas', '0');

        } else if(type == 'faculty') {
            // facultades
            $('#enablefacultad, #disablefacultad').html(null);
            cargar_select('enablefacultad', 'main-getFacultades', '1');
            cargar_select('disablefacultad', 'main-getFacultades', '0');
        } else {
            // areas
            cargar_select('enablearea', 'area-getAreas', '1');
            cargar_select('disablearea', 'area-getAreas', '0');

            // facultades
            cargar_select('enablefacultad', 'main-getFacultades', '1');
            cargar_select('disablefacultad', 'main-getFacultades', '0');
        }
    }

	$(function(){
        
        getItems();

        // habilitar / deshabilitar facultades
        $('#btn-enable-fac').click(function(){
            enabled('disablefacultad', 'faculty', '1');
        });

        $('#btn-disable-fac').click(function(){
            enabled('enablefacultad', 'faculty', '0');
        });

        // habilitar / deshabilitar áreas
        $('#btn-enable-area').click(function(){
            enabled('disablearea', 'areas', '1');
        });

        $('#btn-disable-area').click(function(){
            enabled('enablearea', 'areas', '0');
        });

	});
</script>