<label class="control-label" for="dx_entrada">Diagnóstico:</label>
<select name="dx_entrada" id="dx_entrada" class="selectpicker form-control" data-live-search="true">
	@if(count($dxCie10) > 0)
		<option value="0" selected="selected" disabled>---SELECCIONE UN DIAGNOSTICO---</option>
		@foreach ($dxCie10 as $fila)
			<option value="{{$fila->codigo}}" data-tokens="{{$fila->descripcion}}">{{$fila->descripcion}}</option>
		@endforeach
	@else
		<option value="0" selected="selected" disabled>***EL TEXTO INGRESADO NO TIENE COINCIDENCIAS***</option>
	@endif
</select>