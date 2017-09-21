<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
	<label for="nombre">Nombre:</label>	
	{!!Form::text('nombre', null, ['placeholder'=>'Ingrese Nombre', 'class'=>'form-control'])!!}
	@if($errors->has('nombre'))
        <span class="help-block">
	        <strong>{{ $errors->first('nombre') }}</strong>
	    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
	<label for="apellidos">Apellidos:</label>	
	{!!Form::text('apellidos', null, ['placeholder'=>'Ingrese Apellidos', 'class'=>'form-control'])!!}
	@if($errors->has('apellidos'))
        <span class="help-block">
	        <strong>{{ $errors->first('apellidos') }}</strong>
	    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	<label for="email">E-mail:</label>	
	{!!Form::text('email', null, ['placeholder'=>'Ingrese Correo Electrónico', 'class'=>'form-control'])!!}
	@if($errors->has('email'))
        <span class="help-block">
	        <strong>{{ $errors->first('email') }}</strong>
	    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
	<label for="usuario">Usuario:</label>
	{!!Form::text('usuario', null, ['placeholder'=>'Ingrese el nombre de inicio de sesión', 'class'=>'form-control'])!!}
	@if($errors->has('usuario'))
        <span class="help-block">
	        <strong>{{ $errors->first('usuario') }}</strong>
	    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	<label for="password">Password:</label>
	{!!Form::password('password', ['placeholder'=>'Ingrese el password del usuario', 'class'=>'form-control'])!!}
	@if($errors->has('password'))
        <span class="help-block">
	        <strong>{{ $errors->first('password') }}</strong>
	    </span>
    @endif
</div>
<div class="form-group">
	<label for="password_confirmation">Confirmación:</label>
	{!!Form::password('password_confirmation', ['placeholder'=>'Ingrese el password del usuario', 'class'=>'form-control'])!!}
</div>
<div class="form-group">
	<label for="permisos">Privilegios:</label>
	@foreach($chkText as $p)
		<div class="checkbox">
			<label>
				{{ Form::checkbox('permisos[]', array_search($p, $chkText), in_array($p, $ltaperm))}}
				{{$p}}
			</label>
	    </div>	
	@endforeach
</div>