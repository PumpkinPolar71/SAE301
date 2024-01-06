@extends('layouts.app')

@section('content')
    @auth

    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection