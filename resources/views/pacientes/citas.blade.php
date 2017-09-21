<table id="datosCitas"
data-toggle="table"
data-search="true" 
data-pagination="true"
showPaginationSwitch="true" 
data-striped="true"
data-show-toggle="false"           
data-show-columns="false"
data-click-to-select="true"
data-filter-control="true">
<thead>
    <tr>
        <th data-sortable="true" data-field="clap" data-visible="true">CLAP</th>
        <th data-sortable="true" data-field="folio" data-visible="false">Folio</th>
        <th data-sortable="true" data-field="clip" data-visible="false">CLIP</th>        
        <th data-sortable="true" data-field="rfc">RFC</th>
        <th data-sortable="true" data-field="parent">Parentesco</th>
        <th data-sortable="true" data-field="paciente">Paciente</th>
        <th data-sortable="true" data-field="fechaprog">FechaProg</th>
        <th data-sortable="true" data-field="medico">Medico</th>
        <th data-sortable="true" data-field="sector">Sector</th>
        <th data-sortable="false" data-field="ingreso">Ingreso</th>
    </tr>
</thead>
<tbody>
    @foreach($datos as $fila)
    <tr>
        <td class="clap">{{ $fila->clap }}</td>
        <td>{{ $fila->folio }}</td>
        <td>{{ $fila->clip }}</td>        
        <td>{{ $fila->rfc }}</td>
        <td>{{ $fila->parent }}</td>
        <td>{{ $fila->paciente}}</td>
        <td>{{ $fila->fechaprog}}</td>
        <td>{{ $fila->doctor}}</td>
        <td>{{ $fila->sector}}</td>
        <td>
            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left"  data-info="ingreso"
            title="Registrar Ingreso de: {{$fila->paciente}}"><i class="glyphicon glyphicon-list-alt"></i></button>
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
});
</script>