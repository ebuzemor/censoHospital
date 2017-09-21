@include('alertas.msjExito')
<table data-toggle="table"
       data-locale="es-MX"
       data-search="true" 
       data-pagination="true"
       showPaginationSwitch="true" 
       data-striped="true"
       data-sort-name="id"
       data-show-toggle="false"           
   	   data-show-columns="false">
    <thead>
        <tr>
            <th data-sortable="true">CLAP</th>
            <th data-sortable="true">RFC</th>
            <th data-sortable="true">Parentesco</th>
            <th data-sortable="true">Paciente</th>                
            <th data-sortable="true">Sector</th>
            <th data-sortable="true">Fecha Salida</th>
            <th data-sortable="true">Tiempo Hospitalizacion</th>
            <th data-sortable="false">+ Información</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($lista as $fila)
    		<tr>
                <td class="clap">{{ $fila->clap }}</td>
            	<td>{{ $fila->rfc }}</td>
                <td>{{ $fila->parentesco}}</td>
                <td>{{ $fila->paciente }}</td>
                <td>{{ $fila->sector}}</td>
                <td>{{ $fila->fecha_salida}}</td>
                <td>{{ $fila->duracion }}</td>
                <td>
                    <span data-toggle="tooltip" data-placement="top" title="Ver más información">
                    <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#{{$fila->clap}}" 
                    data-pac="alta"><i class="glyphicon glyphicon-eye-open"></i></button></span>
                </td>
        	</tr>
    	@endforeach
    </tbody>
</table>
<div class="push"></div>
<script src="js/bootstrap-table.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        /*$('#MasInfoModal').on('show.bs.modal', function(e) {
            var btn = $(e.relatedTarget);
            //$('#MasInfoModal #myModalLabel').text('Paciente: ' + btn.data("clap"));
            
            console.log(btn.data("clap"));
        });*/
    });
</script>