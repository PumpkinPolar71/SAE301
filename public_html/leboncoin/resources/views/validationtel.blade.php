@extends('layouts.app')

@section('content')
@auth 
    @if (Auth::user()->compte->codeetatcompte == 13 )
        <h1>Numéro de Téléphone non vérifiées</h1>

        @foreach($annoncesNonValidees as $annonce)
            <div class="numtel">
                <h3>{{ $annonce->titreannonce }}</h3>
                <p>ID Annonce: {{ $annonce->idannonce }}</p>
                <?php
                foreach ($particuliers as $particulier) {
                    if ($annonce->idcompte == $particulier->idcompte) {
                        echo "Numéro de teléphone : {$particulier->numtelparticulier}";
                    }
                }
                 
                ?>
                @if (!$annonce->codeetattelverif)
                    <form method="post" action="{{ route('validerAnnonce', ['idannonce' => $annonce->idannonce]) }}">
                        @csrf
                        <input type="hidden" name="idannonce" value="{{ $annonce->idannonce }}">
                        <button type="submit">Valider le Téléphone</button>
                    </form>
                @endif
            </div>
        @endforeach
        @else
            <p>Vous n'avez pas les autorisations requises pour accéder à cette page, cette incident à été signalé</p>
        @endif
@else 
    <p>Vous n'avez pas les autorisations requises pour accéder à cette page, cette incident à été signalé</p>
@endauth
@endsection
