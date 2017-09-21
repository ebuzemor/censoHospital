@extends('layout.master')
@section('contenido')
	<div id="controles">
		<h4 class="page-header"><i class="glyphicon glyphicon-bed"></i> Elija un período para mostrar los pacientes hospitalizados</h4>	
		<fieldset>
			<div class="form-horizontal">
				<div class="form-group">
					{!! Form::label('desde', 'Desde: ', ['class' => 'control-label col-sm-1']) !!}
					<div class="col-sm-2">
					{!! Form::input('date', 'fecha_inicial', null, ['class' => 'form-control', 'id' => 'fecha_inicial','placeholder' => 'Fecha Inicial', 
                                    'required' => 'true']) !!}
					</div>
					{!! Form::label('hasta', 'Hasta: ', ['class' => 'control-label col-sm-1']) !!}
					<div class="col-sm-2">
					{!! Form::input('date', 'fecha_final', null, ['class' => 'form-control', 'id' => 'fecha_final','placeholder' => 'Fecha Final', 
                                    'required' => 'true']) !!}
					</div>
					<div class="col-sm-3">
                    {!! Form::button('Realizar consulta...', ['class' => 'btn btn-success form-control', 'id' => 'btn_consulta']) !!}					
					</div>
                    <div class="col-sm-3">
                    {!! Form::button('Pacientes de Hoy...', ['class' => 'btn btn-info form-control', 'id' => 'btn_hoypacientes']) !!}                   
                    </div>
				</div>
			</div>
		</fieldset>		
	</div>
	<div id="regresar" style="display:none">        
	    <center>
	    	<br>
            <button id="btn_Regresar" type="button" class="btn btn-primary">Consultar de nuevo...</button>
	    </center>
	</div>
    <div id="existe" style="display:none"></div>
    <div id="area_datos"></div>	
    <div id="ingreso_btn" style="display:none">
        <center>
            <br>
            <button id="btn_AtrasIngreso" type="button" class="btn btn-warning">Regresar a tabla...</button>
        </center>
    </div><br>
    <div id="area_ingreso" style="display:none"></div>
@stop
@section('js')
    <script src="js/laravel-bootstrap-modal-form.js"></script>
	<script type="text/javascript">
    	$(function() {
    		$('#fecha_inicial').datepicker({
            	format: "yyyy-mm-dd"
        	});
        	
        	$('#fecha_final').datepicker({
            	format: "yyyy-mm-dd"
        	});

        	$('#btn_consulta').click(function(event) {
        		event.preventDefault();
        		var $post = {};
        		$('#area_datos').html("");
        		$post.fecini = $('#fecha_inicial').val();
        		$post.fecfin = $('#fecha_final').val();
        		if ($post.fecini != "" && $post.fecfin != "" && $post.fecfin >= $post.fecini)
        		{
        			$('#controles').hide(300);                    
        			$("#area_datos").html("<center><br><br><br><img src='img/cargando.gif'/></center>");
                    /*$.get('consulta/'+$post.fecini+'/'+$post.fecfin, function(respuesta) {
                        if(respuesta != ""){
                            $('#area_datos').html(respuesta);
                            $("#regresar").toggle();
                        }
                        else
                            $("#areadatos").html("<center><h4><span class='label label-info'>NO HAY DATOS DISPONIBLES</span></h4></center>");
                    });*/
        			Solicitud_POST('consulta', $post, function(respuesta){
        				if(respuesta != ""){
        					$('#area_datos').html(respuesta);
        					$("#regresar").toggle();
        				}
                    	else
                        	$("#areadatos").html("<center><h4><span class='label label-info'>NO HAY DATOS DISPONIBLES</span></h4></center>");
        			});
        		}
        		else
        			$("#area_datos").html("<center><h4><span class='label label-danger'>DEBE SELECCIONAR UN PERÍODO VÁLIDO</span></h4></center>");
        	});

            $('#btn_hoypacientes').click(function(event) {
                event.preventDefault();
                $('#area_datos').html("");
                $('#controles').hide(300);
                $("#area_datos").html("<center><br><br><br><img src='img/cargando.gif'/></center>");
                Solicitud_POST('consulta_hoy', null, function(respuesta){
                    if(respuesta != ""){
                        $('#area_datos').html(respuesta);
                        $("#regresar").toggle();
                    }
                    else
                        $("#areadatos").html("<center><h4><span class='label label-info'>NO HAY DATOS DISPONIBLES</span></h4></center>");
                });
            });

        	$("#btn_Regresar").click(function() {
        		$('#controles').show(300);
        		$('#area_datos').html("");                
        		$('#regresar').toggle();
        	});

            $('body').on('click', '[data-info="ingreso"]', function(e) {
                e.preventDefault();
                var clap = $(this).closest('tr').find('.clap').text();
                $("#area_ingreso").html("");
                $("#area_ingreso").show(300);
                $.post('checarClap', {clap}, function(data) {
                    console.log(data);
                    if(data == "") {
                        Solicitud_POST('registraIngreso', {clap}, function(respuesta) {
                            $("#existe").empty();
                            $("#regresar").hide(300);
                            $("#area_datos").hide(300);
                            $('#ingreso_btn').show();
                            $("#area_ingreso").html(respuesta);
                        });    
                    }
                    else {
                        $("#existe").show();
                        $("#existe").html(data);
                    }
                });
            });

            $("#btn_AtrasIngreso").click(function() {
                $('#regresar').show(300);
                $('#area_datos').show(300);
                $('#ingreso_btn').hide(300);
                $('#area_ingreso').hide(300);
            });
    	});    	
	</script>
@stop