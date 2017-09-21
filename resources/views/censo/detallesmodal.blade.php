<div class="modal fade" id="DetallesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Paciente: <span id="paciente"></span></h4>
            </div>
            {!! Form::open(['id'=>'detalleform', 'method'=>'PATCH', 'class'=>'bootstrap-modal-form']) !!}
            <div class="modal-body">
                <div class="box-body">
                    @include('censo.detallesformulario')
                </div>
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