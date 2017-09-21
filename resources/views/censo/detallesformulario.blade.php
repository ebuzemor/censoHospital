<div class="form-horizontal">
	<div class="form-group col-md-12">
		<label class="control-label" for="diagnostico">Diagnóstico:</label>		
		{!!Form::textarea('diagnostico', null, ['class' => 'form-control', 'placeholder' => 'Describa el Diagnóstico del Paciente', 'rows'=>'2'])!!}
	</div>
	<div class="form-group col-md-6">	
		<label class="control-label" for="cama"># Cama:</label>
		{!!Form::text('cama', null, ['placeholder'=>'Ingrese Número de Cama', 'class'=>'form-control'])!!}
	</div>
	<div class="form-group col-md-6">
		<label class="control-label" for="turno">Turno:</label>	
		{!!Form::select('turno', ['Mat'=>'Matutino', 'Ves'=>'Vespertino', 'Noc'=>'Nocturno'], null, ['class'=>'form-control'])!!}	
	</div>
	<div class="form-group col-md-10">	
		<label class="control-label" for="tipo_svc">Elija un Servicio:</label>
		{!!Form::select('tipo_svc', $servicios, null, ['class'=>'form-control selectpicker', 'id'=>'tipo_svc', 'data-live-search'=>'true'])!!}
	</div>	
</div>