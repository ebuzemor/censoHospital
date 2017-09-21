<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Iniciar sesion...</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <!--Hojas de estilo necesarias-->
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/default.css') !!}
        {!! Html::style('css/isstech.css') !!}
    </head>

    <body>
        <div id="wrapper">    
            <!--Login-->
            <div class="row">
                <div class="bienvenida container">                
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <!--logo isstech-->
                                {!! Html::image('img/isstechlogin.png', '',['class' => 'isstech-login']) !!}
                                
                            </div>
                            <div class="row">
                                <!--imagen del Login-->
                                {!! Html::image('img/trabajo_social_logo.png', 'Censo Hospital', ['class'=>'app-login']) !!}
                                
                            </div>   
                        </div>
                        <div class="col-md-5">
                            <div class="login">
                                <div class="col-xs-12">
                                    {!! Html::image('img/trabajo_social.png', 'Trabajo Social', ['class' => 'app-titulo']) !!}
                                    {!! Form::open(['url' => 'login', 'role' => 'form']) !!}

                                    <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                                        {!! Form::text('usuario', old('usuario'), ['class' => 'form-control', 
                                        'id' => 'usuario', 'placeholder' => 'Ingrese Usuario por favor']) !!}
                                        @if($errors->has('usuario'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('usuario') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password',
                                        'placeholder' => 'Ingrese Password por favor']) !!}
                                        @if($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {!! Form::submit('Iniciar Sesión', ['class' => 'boton btn btn-lg btn-primary']) !!}                                    
                                    {!! Form::close() !!}
                                    <div>
                                    @if ($errors->has('msjError'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden=true>&times;</span>
                                            </button>
                                            <strong>{{$errors->first('msjError')}}</strong>
                                        </div>
                                    @endif
                                    @if (session('msjLogout'))
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden=true>&times;</span>
                                            </button>
                                            <ul><li>{{session('msjLogout')}}</li></ul>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                
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
    </body>
</html>