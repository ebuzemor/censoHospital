@extends('layout.master')

@section('contenido')    
    <ol class="breadcrumb">  
        <li><button class="btn btn-success btn-sm pull-right bootstrap-modal-form-open" data-toggle="modal" 
            data-target="#AddModal">Agregar Usuario</button></li>
    </ol>
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
                <th data-sortable="true">Nombre</th>
                <th data-sortable="true">Apellidos</th>
                <th data-sortable="true">Usuario</th>
                <th>Fecha Creación</th>
                <th>Fecha Modificación</th>                
                <th>Acciones</th>                
            </tr>
        </thead>
        <tbody>
        	@foreach($lista as $fila)
        		<tr>
                	<td>{{ $fila->nombre }}</td>
                	<td>{{ $fila->apellidos }}</td>
                    <td>{{ $fila->usuario }}</td>                    
                    <td>{{ $fila->created_at}}</td>                    
                    <td>{{ $fila->updated_at}}</td>                    
                    <td>                        
                        <a href="{{route('usuarios.edit', $fila->id)}}"class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                        @if ($fila->usuario != 'admin')    
                            <button type="button" data-route="{{route('usuarios.destroy', $fila->id)}}" data-toggle="modal" data-target="#DeleteModal"
                            data-message="¿Desea eliminar este usuario: {{$fila->nombre.' '.$fila->apellidos}}?" class="btn btn-xs btn-danger" >
                            <i class="glyphicon glyphicon-remove"></i></button>
                        @endif
                    </td>
            	</tr>
        	@endforeach            
        </tbody>
    </table>
    <div class="push"></div>
    @include('alertas.msjExito')
    @include('usuarios.addmodal')
    @include('usuarios.deletemodal')
@stop

@section('js')
<script src="js/bootstrap-table.min.js"></script>
<script src="js/laravel-bootstrap-modal-form.js"></script>
<script type="text/javascript">
    $(function() {
        $('#DeleteModal').on('show.bs.modal', function(e) {
            var btn = $(e.relatedTarget);
            var ruta = btn.data("route");
            $info = btn.attr("data-message");
            $('#DeleteModal #datosUsr').text($info);
            $('#delform').attr('action', ruta);
        });
    });
</script>
@stop