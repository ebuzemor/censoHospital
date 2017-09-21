@include('alertas.msjExito')
<table id="tblConsulta" 
       data-toggle="table"
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
            <th data-sortable="true">Parent.</th>
            <th data-sortable="true">Paciente</th>
            <th data-sortable="true">Sector</th>
            <th data-sortable="true">F. Ingreso</th>
            <th>Acciones</th>
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
                <td>{{ $fila->fecha_ingreso}}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" 
                    title="Mostrar información de ingreso" data-view="info"><i class="glyphicon glyphicon-eye-open"></i></button>
                                        
                    <button type="button" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" 
                    title="Editar información de Ingreso" data-edit="ingreso"><i class="glyphicon glyphicon-pencil"></i></button>

                    <span data-toggle="modal" data-target="#AltaModal" data-paciente="{{$fila->paciente}}" data-id="{{$fila->id}}">
                    <button type="button" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" 
                    title="Dar de Alta al Paciente"><i class="glyphicon glyphicon-thumbs-up"></i></button></span>
                </td>
        	</tr>
    	@endforeach
    </tbody>
</table>
<div class="push"></div>
@include('censo.altamodal')
<script src="js/bootstrap-table.min.js"></script>
<script src="js/laravel-bootstrap-modal-form.js"></script>
<script type="text/javascript">
    $(function() {
        $('.selectpicker').selectpicker();
        $('[data-toggle="tooltip"]').tooltip();
        $('#AltaModal').on('show.bs.modal', function(e) {            
            $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
            $('.form-group').removeClass('has-error');
            $('.form-group').find('.help-block').remove();
            var btn = $(e.relatedTarget);
            //var ruta = btn.data("route");
            $info = btn.data("paciente");
            var idPac = btn.data("id");
            $('#AltaModal #altaPac').text($info);
            //$('#altaform').attr('action', ruta);
            $('#idPac').attr('value', idPac);
        });
        $('#fecha_salida').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD hh:mm:ss A'
        });
    });
</script>