@extends('layouts.app')

@section('content')

@auth
    @foreach($comptes as $compte)
        @if ($compte->idcompte == Auth::user()->compte->idcompte)
            <p>bite</p>
        @else 
        @endif
    @endforeach
@else
<p>Vous devez être connecté pour accéder à ceci. <a href="connect">Se connecter</a></p>

@endauth

@endsection