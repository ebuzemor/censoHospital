<!DOCTYPE html>
<html lang="es-mx">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$titulo}}</title>
        <!--Hojas de estilo necesarias-->
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/default.css') !!}
        {!! Html::style('css/isstech.css') !!}
        {!! Html::style('css/datepicker.css') !!}        
        {!! Html::style('css/bootstrap-table.min.css') !!}
        {!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
        {!! Html::style('css/bootstrap-select.min.css') !!}
        <style type="text/css">
            .navbar-sis{
                background-color: #6E6E6E !important; /*Color del menu*/              
            }
            .navbar-sis .seleccionadoActive, .navbar-sis a:hover, .navbar-sis a:focus {
                background-color: #EA0E6A !important; /*Color del seleccionado*/              
            }            
            .datepicker{z-index:1151 !important;} /*con esto el datepicker aparece en un modal*/
            .modal-body{padding-top: 0px !important; padding-bottom: 0px !important;} /*con esto la linea inferior del modal desaparece*/
        </style>
        @yield('css')
    </head>
    <body>
        
        <div id="wrapper">    
            <!--Encabezado-->
            <div class="app-header">
                <!--Logo app-->
                {!! Html::image('img/trabajo_social_2.png', 'Trabajo Social', []) !!}
            </div>
            <nav class="navbar navbar-static-top navbar-sis" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="background-color:#ffffff;"></span>
                        <span class="icon-bar" style="background-color:#ffffff;"></span>
                        <span class="icon-bar" style="background-color:#ffffff;"></span>
                    </button>
                </div>
                <!--Menu-->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-left navbar-user">           
                        @foreach($ltarutas->rutas as $ind => $opcion)
                            <li>{!!html_entity_decode(HTML::link($opcion, $ltarutas->iconos[$ind])) !!} </li>
                        @endforeach
                    </ul>
                    <ul class="nav navbar-nav navbar-right navbar-user" style="margin-right:0px;">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i> {{Auth::User()->NombreCompleto}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>{!!html_entity_decode(Html::link('/logout', '<i class="glyphicon glyphicon-share"></i> Salir'))!!}</li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </nav>
            <!--Contenido-->
            <div class="cont-page container">
                <div id="principal" class="row">                    
                    @yield('contenido')
                </div>
            </div>
            <div class="push"></div>
        </div>
        <!--Footer-->
        <div class="row app-footer">
            <div class="col-md-6 izquierda">
                <a href="#">Marco Legal</a>            
                &nbsp;|&nbsp;
                <a href="#">Asistencia en L&iacute;nea</a>
            </div>
            <div class="col-md-6 hidden-xs derecha">
                Gobierno del Estado de Chiapas&nbsp;&nbsp;
                <div class="logoChis"></div>
            </div>                   
        </div>
        <!-- JavaScript -->
        {!! Html::script('js/jquery-1.12.0.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/bootstrap-datepicker.js') !!}
        {!! Html::script('js/moment-with-locales.min.js') !!}
        {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}        
        {!! Html::script('js/bootstrap-select.min.js') !!}
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
            });

            function Solicitud_POST(URL, params, todo) {    //Funcion principal
                $.ajax({
                    url: URL,
                    type: 'POST',
                    data: params,
                    cache: false,
                    success: function (resp) {
                        if (todo != null)
                            todo(resp);
                    },
                    error: function (resp) {                        
                        $('#principal').html('<div class="alert alert-danger"><b>ERROR AL PROCESAR LA SOLICITUD DE INFORMACION (POSIBLES CAUSAS):<ul><li>ERROR EN EL SISTEMA</li><li>ACCESO NO AUTORIZADO, FAVOR DE REINICIAR SESION</li><li>VERIFIQUE CON EL ADMINISTRADOR DEL SISTEMA</li></ul></b></div>');
                    }
                });            
            }
        </script>
        @yield('js')
    </body>
</html>