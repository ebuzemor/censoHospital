@extends('layout.master')

@section('contenido')
    <legend>Editando datos de usuario:</legend>
    <div class="row">
        {!! Form::model($usuario, array('route'=>['usuarios.update', $usuario->id], 'method'=>'PATCH'))!!}
        	@include('usuarios.editformulario')
        	<a class="btn btn-default" href="{{url('usuarios')}}">Cancelar</a>
        {!! Form::submit( 'Actualizar', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@stop