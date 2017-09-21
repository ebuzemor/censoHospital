<label class="control-label" for="dx_salida">Diagnóstico definitivo:</label>
<select name="dx_salida" id="dx_salida" class="selectpicker form-control" data-live-search="true">
	@if(count($dxCie10) > 0)
		<option value="0" selected="selected" disabled>---SELECCIONE UN DIAGNOSTICO---</option>
		@foreach ($dxCie10 as $fila)
			<option value="{{$fila->codigo}}" data-tokens="{{$fila->descripcion}}">{{$fila->descripcion}}</option>
		@endforeach
	@else
		<option value="0" selected="selected" disabled>***EL TEXTO INGRESADO NO TIENE COINCIDENCIAS***</option>
	@endif
</select>