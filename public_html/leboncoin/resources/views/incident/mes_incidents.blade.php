@extends('layouts.app')

@section('content')

<h2>Mes incidents</h2>


@if($incidents->count() > 0)
    <p>Nombre d'incidents réalisés : {{ $incidents->count() }}</p>
    <ul>
        @foreach($incidents as $incident)
            <li>
                {{ $incident->idannonce }} - {{ $incident->commentaire }}
            </li>
        @endforeach
    </ul>
@else
    <p>Aucun incident à afficher.</p>   
@endif

@endsection


<!-- Table incident :
idincident, 	idannonce, 	remboursement, 	commentaire, 	procedurejuridique, 	resolu;
6,  [fk]24,  FALSE,  Test,   FALSE,  FALSE;
7,  [fk]24,  FALSE,  Test2,   FALSE,  FALSE;

Table reservation :
idreservation, 	idannonce, 	idcompte;
25, [fk]24, [fk]25;

Table compte (User.php) :
idcompte;
25[fk]; -->

