@extends('layouts.app')

@section('content')
    @auth
        <div class="bandeau">
            <div class="pdp"><p>Q</p></div><br>
            <h1>Votre ID de compte : {{ Auth::user()->compte ? Auth::user()->compte->idcompte : 'Non défini' }}</h1>
            <h2>Votre email : {{ Auth::user()->compte ? Auth::user()->compte->email : 'Non défini' }}</h2>
            <h2>Votre Adresse : {{ Auth::user()->compte ? Auth::user()->compte->adresseruecompte : 'Non défini' }}, {{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}, {{ Auth::user()->ville ? Auth::user()->ville->nomville : 'Non défini' }}</h2>
            <!-- <h2>Votre Adresse cp : {{ Auth::user()->compte ? Auth::user()->compte->adressecpcompte : 'Non défini' }}</h2> -->
            @if (Auth::user()->particulier)
                <h2>Votre nom : {{ Auth::user()->particulier->nomparticulier ? Auth::user()->particulier->nomparticulier : 'Non défini'}}</h2>
                <h2>Votre prénom : {{ Auth::user()->particulier->prenomparticulier ? Auth::user()->particulier->prenomparticulier : 'Non défini'}}</h2>
            @else
                <p>Les informations du particulier ne sont pas définies.</p>
            @endif
        </div>
        <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Déconnexion</button>
        </form>
    @else
        <p>Vous n'êtes pas connecté.</p>
    @endauth
    
@endsection



