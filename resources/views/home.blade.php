@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection('titulo')

@section('contenido')    
    <x-listar-post :posts="$posts" />
@endsection('contenido')

