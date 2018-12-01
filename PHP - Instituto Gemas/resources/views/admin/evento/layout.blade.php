@extends('admin.layout')


@section('links')
    <li role="presentation"><a href="{{route("admin.evento.create")}}">Novo</a></li>
    <li role="presentation"><a href="{{route("admin.evento.index")}}">Todos</a></li>
    @if(isset($evento->id) && !isset($eventos))
        <li role="presentation"><a href="{{route("admin.evento.edit", $evento->id)}}">Informações</a></li>
        <li role="presentation"><a href="{{route("admin.evento.capa.edit", $evento->id)}}">Capa</a></li>
        <li role="presentation"><a href="{{route("admin.evento.galeria.edit", $evento->id)}}">Galeria</a></li>
    @endif

@endsection