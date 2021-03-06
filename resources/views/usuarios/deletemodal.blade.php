<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar Usuario...</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <span id="datosUsr"></span>
                </div>
            </div>
            <div class="modal-footer">
                {!!Form::open(['method'=>'DELETE', 'id'=>'delform'])!!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit( 'Eliminar', ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>            
        </div>
    </div>
</div>