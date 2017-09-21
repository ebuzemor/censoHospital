<div id="msj"></div>
<div class="form-horizontal">
	<fieldset>
		<div class="form-group col-lg-4">
			<label for="NombrePac">Nombre del Paciente:</label>
			{!!Form::text('NombrePac', $padron[0]->NombrePaciente, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-1">
			<label for="Edad">Edad:</label>
			{!!Form::text('Edad', $padron[0]->edad, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-1">
			<label for="Sexo">Sexo:</label>
			{!!Form::text('Sexo', $padron[0]->sexo, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-2">
			<label for="RFC">RFC:</label>
			{!!Form::text('RFC', $padron[0]->rfc, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-2">
			<label for="Codigo">Codigo:</label>
			{!!Form::text('Codigo', $padron[0]->clip, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-4">
			<label for="Sector">Sector:</label>
			{!!Form::text('Sector', $padron[0]->sector, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-8">
			<label for="Direccion">Direccion:</label>
			{!!Form::text('Direccion', $padron[0]->dir, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
		<div class="form-group col-lg-4">
			<label for="Municipio">Municipio:</label>
			{!!Form::text('Municipio', $padron[0]->municipio, ['class'=>'form-control', 'readonly'=>'true'])!!}
		</div>
	</fieldset>
	{!!Form::open(['url'=>'actualizaCenso', 'id'=>'frmActualizaCenso'])!!}
		<fieldset>
			<input type="hidden" name="clap" value="{{$cita->clap}}">
			<input type="hidden" name="fecini" value="{{$fecini or 0}}">
			<input type="hidden" name="fecfin" value="{{$fecfin or 0}}">
			<div class="form-group col-lg-7">
				<label for="ocupacion">Ocupacion:</label>
				{!!Form::text('ocupacion', $censo->ocupacion, ['class'=>'form-control', 'placeholder'=>'En caso de no tener escriba N/A'])!!}
			</div>
			<div class="form-group col-lg-4">
				<label for="telefono">Telefono: (ejemplo: 961-123-4567 o 55-1234-5678)</label>
				{!!Form::text('telefono', $censo->telefono, ['class'=>'form-control'])!!}
			</div>
			<div class="form-group col-lg-7">
				<label for="nom_familiar">Familiar Responsable:</label>
				{!!Form::text('nom_familiar', $censo->nom_familiar, ['class'=>'form-control'])!!}
			</div>
			<div class="form-group col-lg-4">
				<label for="tel_familiar">Telefono Familiar:</label>
				{!!Form::text('tel_familiar', $censo->tel_familiar, ['class'=>'form-control'])!!}
			</div>
			<div class="form-group col-lg-4">
				<label for="fecha_ingreso">Fecha y Hora de Ingreso:</label>
				{!!Form::text('fecha_ingreso', $censo->fecha_ingreso, ['class'=>'form-control', 'id'=>'fecha_ingreso', 
							  'readonly' =>'true'])!!}
			</div>
			<div class="form-group col-lg-4">	
				<label for="origen_ingreso">Origen de Ingreso:</label>
				<select name="origen_ingreso" id="origen_ingreso" class="selectpicker form-control" data-live-search="true">
					@foreach($origen as $fila)
						<option value="{{$fila['clv']}}" {{$censo->origen_ingreso == $fila['clv'] ? 'selected="selected"':''}}>{{$fila['desc']}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-lg-4">	
				<label for="tipo_svc">Servicio:</label>
				<select name="tipo_svc"  id="tipo_svc" class="selectpicker form-control" data-live-search="true">
					@foreach($servicios as $indice=>$dato)
						<option value="{{$indice}}" {{$censo->tipo_svc == $indice ? 'selected="selected"':''}}>{{$dato}}</option>
					@endforeach
				</select>				
			</div>
			<div class="form-group col-lg-5">	
				<label for="especialidad">Especialidad:</label>
				<select name="especialidad" id="especialidad" class="selectpicker form-control" data-live-search="true">
					<option value="0" selected="selected" disabled>---ELIJA UNA ESPECIALIDAD---</option>
					@foreach ($especial as $fila)
						<option value="{{$fila->clave}}" data-tokens="{{$fila->descripcion_nivel}}"
						{{$censo->especialidad == $fila->clave ? 'selected="selected"':''}} >{{$fila->descripcion_nivel}}</option>
					@endforeach
				</select>
			</div>
			<div id="especialistas" class="form-group col-lg-4">	
				<label for="cedula">Médico Especialista:</label>
				<select name="cedula" id="cedula" class="selectpicker form-control" data-live-search="true">
					<option value={{$medico->cedula}}>{{$medico->NombreMedico}}</option>
				</select>
			</div>
			<div class="form-group col-lg-2">
				<label class="control-label" for="cama"># Cama: (AAAA-123)</label>
				{!!Form::text('cama', $censo->cama, ['placeholder'=>'Num. de Cama', 'class'=>'form-control'])!!}
			</div>
			<div class="form-group col-lg-2">
				<label class="control-label" for="turno">Turno:</label>	
				<select name="turno" id="turno" class="selectpicker form-control" data-live-search="true">
					@foreach($turno as $fila)
						<option value="{{$fila['clv']}}" {{$censo->turno == $fila['clv'] ? 'selected="selected"':''}}>{{$fila['desc']}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-lg-4">
				<label class="control-label" for="buscarDx">Buscar CIE10:</label>
				<div class="input-group" id="buscarDx">
      				<input type="text" class="form-control" placeholder="Escriba y seleccione el diagnóstico" id="txt_eBuscarDx">
      				<span class="input-group-btn">
        				<button class="btn btn-info" type="button" id="btn_eBuscarDx">Buscar</button>
      				</span>
    			</div>
			</div>
			<div class="form-group col-lg-8" id="cie10">
				<label class="control-label" for="dx_entrada">Diagnóstico:</label>
				<select name="dx_entrada" id="dx_entrada" class="selectpicker form-control" data-live-search="true">
					<option value="{{empty($censo->dx_entrada) == false ? $censo->dx_entrada : 0}}" 
							selected="selected" {{empty($censo->dx_entrada) == false ? '' : 'disabled'}}>
							{{empty($censo->dx_entrada) == false ? $cie10->descripcion : '--SELECCIONE DIAGNOSTICO--'}}</option>
				</select>
			</div>
			<div class="form-group col-lg-2">
				{!!Form::submit('Actualizar datos del Paciente', ['class'=>'btn btn-success'])!!}
			</div>
		</fieldset>		
	{!!Form::close()!!}
</div>
<script type="text/javascript">
	$(function() {
		$('.selectpicker').selectpicker();

		$('#fecha_ingreso').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD hh:mm:ss A'
        });
        
        $('#especialidad').change(function (event) {
        	var clv = event.target.value;
        	Solicitud_POST("medicosEspecial", {clave:clv}, function(respuesta) {
        		$("#especialistas").html(respuesta);
        		$("#cedula").selectpicker();
        	});
        });

        $('#btn_eBuscarDx').click(function (event) {
        	var desc = $('#txt_eBuscarDx').val();
        	if(desc != "") {
        		Solicitud_POST("buscarCIE10", {desc}, function(respuesta) {
        			$("#cie10").html(respuesta);
        			$("#dx_entrada").selectpicker();
        		});
        	}
        });

        // Prepare reset.
	    function resetModalFormErrors() {
	        $('.form-group').removeClass('has-error');
	        $('.form-group').find('.help-block').remove();
	    }

	    // Intercept submit.
	    $('#frmActualizaCenso').on('submit', function(submission) {
	        submission.preventDefault();

	        // Set vars.
	        var form   = $(this),
	            url    = form.attr('action'),
	            submit = form.find('[type=submit]');

            var data    	= form.serialize(),
            	contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
	        
	        // Please wait.
	        if (submit.is('button')) {
	            var submitOriginal = submit.html();
	            submit.html('Espere...');
	        } else if (submit.is('input')) {
	            var submitOriginal = submit.val();
	            submit.val('Espere...');
	        }

	        // Request.
	        $.ajax({
	            type: "POST",
	            url: url,
	            data: data,
	            dataType: 'json',
	            cache: false,
	            contentType: contentType,
	            processData: false

	        // Response.
	        }).always(function(response, status) {

	            // Reset errors.
	            resetModalFormErrors();

	            // Check for errors.
	            if (response.status == 422) {
	                var errors = $.parseJSON(response.responseText);

	                // Iterate through errors object.
	                $.each(errors, function(field, message) {
	                    console.error(field+': '+message);
	                    var formGroup = $('[name='+field+']', form).closest('.form-group');
	                    formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
	                });

	                // Reset submit.
	                if (submit.is('button')) {
	                    submit.html(submitOriginal);
	                } else if (submit.is('input')) {
	                    submit.val(submitOriginal);
	                }

	            // If successful, reload.
	            } else {
	                //location.reload();
	                $('#area_ingreso').html(response.responseText);
	                console.log(response);
	            }
	        });
	    });	    
	});
</script>