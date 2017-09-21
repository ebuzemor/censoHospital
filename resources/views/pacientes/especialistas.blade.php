<label for="cedula">Médico Especialista:</label>
<select name="cedula" id="cedula" class="selectpicker form-control" data-live-search="true">
	@if(count($medesp) > 0)
		<option value="0" selected="selected" disabled>---ELIJA UN MEDICO ESPECIALISTA---</option>
		@foreach ($medesp as $fila)
			<option value="{{$fila->cedula}}" data-tokens="{{$fila->nombre_medico}}">{{$fila->nombre_medico}}</option>
		@endforeach
	@else
		<option value="0" selected="selected" disabled>***NO HAY MEDICOS ESPECIALISTAS***</option>
	@endif
</select>
