@extends('layout.master')
@section('contenido')
    <div id="controles">
        <h4 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> Elija un período para mostrar los pacientes censados</h4> 
        <fieldset>
            <div class="form-horizontal">
                <div class="form-group">
                    {!! Form::label('desde', 'Desde: ', ['class' => 'control-label col-sm-1']) !!}
                    <div class="col-sm-2">
                    {!! Form::input('date', 'fecha_inicial', null, ['class' => 'form-control', 'id' => 'fecha_inicial','placeholder' => 'Fecha Inicial', 
                                    'required' => 'true']) !!}
                    </div>
                    {!! Form::label('hasta', 'Hasta: ', ['class' => 'control-label col-sm-1']) !!}
                    <div class="col-sm-2">
                    {!! Form::input('date', 'fecha_final', null, ['class' => 'form-control', 'id' => 'fecha_final','placeholder' => 'Fecha Final', 
                                    'required' => 'true']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::button('Realizar consulta...', ['class' => 'btn btn-success form-control', 'id' => 'btn_Censados']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::button('Ultimos 20 censados...', ['class' => 'btn btn-info form-control', 'id' => 'btn_Recientes']) !!}
                    </div>
                </div>
            </div>
        </fieldset>     
    </div>
    <div id="regresar" style="display:none">        
        <center>            
            <button id="btn_Regreso" type="button" class="btn btn-primary">Consultar de nuevo...</button>
        </center>
    </div>
    <div id="existe" style="display:none"></div>
    <div id="area_datos"></div>
    <div id="ingreso_btn" style="display:none">
        <center>
            <br>
            <button id="btn_Atras" type="button" class="btn btn-warning">Regresar a tabla...</button>
        </center>
    </div><br>
    <div id="area_ingreso" style="display:none"></div>
@stop
@section('js')    
    <script type="text/javascript">
        $(function() {
            $('#fecha_inicial').datepicker({
                format: "yyyy-mm-dd"
            });
            
            $('#fecha_final').datepicker({
                format: "yyyy-mm-dd"
            });

            $('#btn_Censados').click(function(event) {
                event.preventDefault();
                var $post = {};
                $('#area_datos').html("");
                $post.fecini = $('#fecha_inicial').val();
                $post.fecfin = $('#fecha_final').val();
                if ($post.fecini != "" && $post.fecfin != "" && $post.fecfin >= $post.fecini)
                {
                    $('#controles').hide(300);
                    $("#area_datos").html("<center><br><br><br><img src='img/cargando.gif'/></center>");
                    Solicitud_POST('verPacientes', $post, function(respuesta){
                        if(respuesta != ""){
                            $('#area_datos').html(respuesta);
                            $("#regresar").toggle();
                        }
                        else
                            $("#areadatos").html("<center><h4><span class='label label-info'>NO HAY DATOS DISPONIBLES</span></h4></center>");
                    });
                }
                else
                    $("#area_datos").html("<center><h4><span class='label label-danger'>DEBE SELECCIONAR UN PERÍODO VÁLIDO</span></h4></center>");
            });

            $('#btn_Recientes').click(function(event) {
                event.preventDefault();
                $('#area_datos').html("");
                $('#controles').hide(300);
                $("#area_datos").html("<center><br><br><br><img src='img/cargando.gif'/></center>");
                Solicitud_POST('verRecientes', null, function(respuesta) {
                    if(respuesta != ""){
                            $('#area_datos').html(respuesta);
                            $("#regresar").toggle();
                    }
                    else
                        $("#areadatos").html("<center><h4><span class='label label-info'>NO HAY DATOS DISPONIBLES</span></h4></center>");
                });
            });

            $('body').on('click', '[data-view="info"]', function(e) {
                e.preventDefault();
                var clap = $(this).closest('tr').find('.clap').text();
                //$(this).closest('tr').find('data-clap').text();
                //e.target.parentNode.parentNode.parentElement.children[0].textContent;
                //console.log(clap);
                Solicitud_POST('infoPaciente', {clap}, function(respuesta) {
                    $(respuesta).modal();
                });                
            });

            $('body').on('click', '[data-edit="ingreso"]', function(e) {
                e.preventDefault();
                var clap = $(this).closest('tr').find('.clap').text();
                //console.log(clap);
                $("#area_ingreso").html("");
                $("#area_ingreso").show(300);
                Solicitud_POST('editPaciente', {clap}, function(respuesta) {
                    $("#existe").empty();
                    $("#regresar").hide(300);
                    $("#area_datos").hide(300);
                    $('#ingreso_btn').show();
                    $("#area_ingreso").html(respuesta);
                });                
            });

            $("#btn_Regreso").click(function() {
                $('#controles').show(300);
                $('#area_datos').html("");
                $('#regresar').toggle();
            });

            $('#btn_Atras').click(function() {
                $('#regresar').show(300);
                $('#area_datos').show(300);
                $('#ingreso_btn').hide(300);
                $('#area_ingreso').hide(300);
            });
        });     
    </script>
@stop