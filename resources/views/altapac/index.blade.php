@extends('layout.master')
@section('contenido')
	<div id="controles">
		<h4 class="page-header"><i class="glyphicon glyphicon-open"></i> Elija un período para mostrar los pacientes dados de alta</h4>	
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
                    {!! Form::button('Ultimos 10 pacientes...', ['class' => 'btn btn-info form-control', 'id' => 'btn_ultimos']) !!}                   
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
    <div id="area_datos"></div>
@stop
@section('js')
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
        		if ($post.fecini != "" && $post.fecfin != "" && $post.fecfin >= $post.fecini) {
        			$('#controles').hide(300);                    
        			$("#area_datos").html("<center><br><br><br><img src='img/cargando.gif'/></center>");
                    Solicitud_POST('buscarPacientes', $post, function(respuesta) {
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

        	$('#btn_ultimos').click(function(event) {
        		event.preventDefault();
        		var $post = {};
        		$('#area_datos').html("");
        		$('#controles').hide(300);
                $("#area_datos").html("<center><br><br><br><img src='img/cargando.gif'/></center>");
                Solicitud_POST('ultimosPacientes', null, function(respuesta) {
                	if(respuesta != ""){
                            $('#area_datos').html(respuesta);
                            $("#regresar").toggle();
                    }
                    else
                        $("#areadatos").html("<center><h4><span class='label label-info'>NO HAY DATOS DISPONIBLES</span></h4></center>");
                });
        	});

            $('body').on('click', '[data-pac="alta"]', function(e){
                e.preventDefault();
                var clap = $(this).closest('tr').find('.clap').text();
                console.log('altaPac:'+clap);
                Solicitud_POST('modalPaciente', {clap}, function(respuesta){
                    $(respuesta).modal();
                });
            });

        	$("#btn_Regresar").click(function() {
        		$('#controles').show(300);
        		$('#area_datos').html("");                
        		$('#regresar').toggle();
        	});
		});
	</script>
@stop