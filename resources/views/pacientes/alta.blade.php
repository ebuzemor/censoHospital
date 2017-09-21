@extends('layout.master')

@section('contenido')
    @include('alertas.msjExito')
    <table data-toggle="table"
           data-locale="es-MX"
           data-search="true" 
           data-pagination="true"
           showPaginationSwitch="true" 
           data-striped="true"
           data-sort-name="id"
           data-show-toggle="true"           
       	   data-show-columns="true">
        <thead>
            <tr>
                <th data-sortable="true">CLAP</th>
                <th data-sortable="true">RFC</th>
                <th data-sortable="true">Parentesco</th>
                <th data-sortable="true">Paciente</th>                
                <th data-sortable="true">Sector</th>
                <th data-sortable="true">Medico que otorga Alta</th>                
                <th data-sortable="true">Fecha Salida</th>
                <th data-sortable="true">Tiempo Hospitalizacion</th>
                
            </tr>
        </thead>
        <tbody>
        	@foreach($lista as $fila)
        		<tr>
                    <td>{{ $fila->clap }}</td>
                	<td>{{ $fila->rfc }}</td>
                    <td>{{ $fila->parentesco}}</td>
                    <td>{{ $fila->paciente }}</td>
                    <td>{{ $fila->sector}}</td>
                    <td>{{ $fila->doctor}}</td>
                    <td>{{ $fila->fecha_salida}}</td>
                    <td>{{ $fila->duracion }}</td>
            	</tr>
        	@endforeach
        </tbody>
    </table>
    <div class="push"></div>
@stop
@section('js')
<script src="js/bootstrap-table.min.js"></script>
@stop