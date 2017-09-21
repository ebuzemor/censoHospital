<div class="modal fade" id="InfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Paciente: {{$infoPac[0]->paciente}}</span></h4>
            </div>
            <div class="modal-body form-horizontal">
                    <div class="form-group col-sm-12">
                        <label class="control-label" for="dx_entrada">Diagnóstico de Entrada:</label>     
                        {!!Form::textarea('dx_entrada', $infoPac[0]->dx_entrada, ['class' => 'form-control', 'readonly' => 'true', 'rows'=>'2'])!!}
                    </div>
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="cama"># Cama:</label>     
                        {!!Form::text('cama', $infoPac[0]->cama, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>
                    <div class="form-group col-sm-2">
                        <label class="control-label" for="turno">Turno:</label>     
                        {!!Form::text('turno', $infoPac[0]->turno, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>                    
                    <div class="form-group col-sm-8">
                        <label class="control-label" for="servicio">Servicio:</label>     
                        {!!Form::text('servicio', $infoPac[0]->servicio, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label" for="doctor">Doctor:</label>     
                        {!!Form::text('doctor', $infoPac[0]->doctor, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label" for="especialidad">Especialidad:</label>     
                        {!!Form::text('especialidad', $infoPac[0]->especialidad, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label" for="telefono"># Teléfono:</label>     
                        {!!Form::text('telefono', $infoPac[0]->telefono, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>                    
                    <div class="form-group col-sm-5">
                        <label class="control-label" for="nom_familiar">Nombre Familiar:</label>     
                        {!!Form::text('nom_familiar', $infoPac[0]->nom_familiar, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label" for="tel_familiar"># Tel. Familiar:</label>     
                        {!!Form::text('tel_familiar', $infoPac[0]->tel_familiar, ['class' => 'form-control', 'readonly' => 'true'])!!}
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group col-sm-12">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>