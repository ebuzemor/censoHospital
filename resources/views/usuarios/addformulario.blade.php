<div class="form-horizontal">
	<div class="form-group col-md-6">
		<label class="control-label" for="nombre">Nombre:</label>		
		{!!Form::text('nombre', null, ['placeholder'=>'Ingrese Nombre', 'class'=>'form-control'])!!}
	</div>
	<div class="form-group col-md-6">	
		<label class="control-label" for="apellidos">Apellidos:</label>			
		{!!Form::text('apellidos', null, ['placeholder'=>'Ingrese Apellidos', 'class'=>'form-control'])!!}
	</div>
	<div class="form-group col-md-6">
		<label class="control-label" for="email">E-mail:</label>	
		{!!Form::text('email', null, ['placeholder'=>'Ingrese Correo Electrónico', 'class'=>'form-control'])!!}	
	</div>
	<div class="form-group col-md-6">	
		<label class="control-label" for="usuario">Usuario:</label>
		{!!Form::text('usuario', null, ['placeholder'=>'Ingrese el nombre de inicio de sesión', 'class'=>'form-control'])!!}		
	</div>
	<div class="form-group col-md-6">
		<label class="control-label" for="password">Password:</label>
		{!!Form::password('password', ['placeholder'=>'Ingrese el password del usuario', 'class'=>'form-control'])!!}
	</div>
	<div class="form-group col-md-6">	
		<label class="control-label" for="password_confirmation">Confirmación:</label>
		{!!Form::password('password_confirmation', ['placeholder'=>'Ingrese el password del usuario', 'class'=>'form-control'])!!}		
	</div>
	<div class="form-group col-md-12">
		<label class="control-label" for="permisos">Privilegios:</label>
		<div class="checkbox">
			<label>
				{{ Form::checkbox('permisos[0]', '2') }} Pacientes Hospitalizados
			</label>
	    </div>
	    <div class="checkbox">
			<label>
				{{ Form::checkbox('permisos[1]', '4') }} Censo de Pacientes H.
			</label>
	    </div>
	    <div class="checkbox">
			<label>
				{{ Form::checkbox('permisos[2]', '8') }} Registrar Alta Paciente
			</label>
	    </div>
	    <div class="checkbox">
			<label>
				{{ Form::checkbox('permisos[2]', '16') }} Gestión de Usuarios
			</label>
	    </div>
	</div>
</div>