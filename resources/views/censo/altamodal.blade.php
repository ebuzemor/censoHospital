<div class="modal fade" id="AltaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Dar de Alta al Paciente: <span id="altaPac"></span></h4>
            </div>
            {!! Form::open(['route'=>'censo.store', 'id'=>'altaform', 'class'=>'bootstrap-modal-form']) !!}
            <div class="modal-body">                
                {!!Form::hidden('idPac', null, ['id'=>'idPac'])!!}
                @include('censo.altaformulario')            
            </div>                
                <div class="modal-footer">
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit( 'Guardar', ['class'=>'btn btn-success']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>