<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Usuario...</h4>
            </div>
            {!! Form::open(['route'=>'usuarios.store', 'id'=>'user-add-form', 'class'=>'bootstrap-modal-form']) !!}
            <div class="modal-body">
                <div class="box-body">                    
                    @include('usuarios.addformulario')
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group col-sm-12">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit( 'Guardar', ['class'=>'btn btn-success']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>