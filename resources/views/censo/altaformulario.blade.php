<div class="form-horizontal">
	<div class="form-group col-md-12">
		<label class="control-label" for="buscarDx">Buscar CIE10:</label>
		<div class="input-group" id="buscarDx">
				<input type="text" class="form-control" placeholder="Escriba y seleccione el diagnóstico" id="txt_BuscarDx">
				<span class="input-group-btn">
				<button class="btn btn-info" type="button" data-cie="def">Buscar</button>
				</span>
		</div>
	</div>
	<div class="form-group col-md-12" id="ciedef">
		<label class="control-label" for="dx_salida">Diagnóstico definitivo:</label>
		<select name="dx_salida" id="dx_salida" class="selectpicker form-control" data-live-search="true">
			<option value="0" selected="selected" disabled>---SELECCIONE DIAGNOSTICO---</option>
		</select>
	</div>
	<div class="form-group col-md-12">
		<label class="control-label" for="motivo">Motivo:</label>		
		{!!Form::textarea('motivo', null, ['class' => 'form-control', 'placeholder' => 'Describa el Motivo del Alta del Paciente', 'rows'=>'2'])!!}
	</div>
	<div class="form-group col-md-5">	
		<label class="control-label" for="fecha_salida">Fecha y Hora de Salida:</label>
		{!! Form::text('fecha_salida', null, ['class' => 'form-control', 'id' => 'fecha_salida', 'placeholder' => 'Fecha y Hora de Salida']) !!}
	</div>
	<div class="form-group col-md-7">	
		<label class="control-label" for="cedula_alta">Médico que otorga el Alta:</label>
		<select name="cedula_alta" id="cedula_alta" class="selectpicker form-control" data-live-search="true">
			<option value="0" selected="selected" disabled>---ELIJA UN MEDICO---</option>
			@foreach($medicos as $datos)
				<option value="{{$datos->cedula}}" data-tokens="{{$datos->nombre_medico}}">{{$datos->nombre_medico}}</option>
			@endforeach
		</select>
	</div>	
</div>
<script type="text/javascript">
	$(function() {
		$('[data-cie="def"]').click(function(e) {
            e.preventDefault();
            var desc = $('#txt_BuscarDx').val();
            if(desc != "") {
        		Solicitud_POST("buscarCIE10def", {desc}, function(respuesta) {
        			$("#ciedef").html(respuesta);
        			$("#dx_salida").selectpicker();
        		});
        	}
        });
	});
</script>