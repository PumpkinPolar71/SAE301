@extends('layouts.app')

@section('content')

<h2>Mes incidents</h2>


@if($incidents->count() > 0)
    <br><h3>Nombre total d'incidents réalisés : {{ $incidents->count() }}</h3>
    <table>
        @foreach($incidents as $incident)
            <tr>
                <td>ID Annonce : {{ $incident->idannonce }}</td>
                    @foreach ($annonces as $annonce)
                        @if ($annonce->idannonce == $incident->idannonce)
                        <td>Titre Annonce: {{ $annonce->titreannonce }}</td>
                        @endif
                    @endforeach
                <td>Commentaire: {{ $incident->commentaire }}</td>
            </tr>
        @endforeach
</table>
    <!-- mes_incidents.blade.php -->

    <br><h3>Incidents en cours : </h3>
    <table>
        @foreach($incidents->where('resolu', false) as $incident)
            <tr>
                <td>ID Annonce : {{ $incident->idannonce }}</td>
                @foreach ($annonces as $annonce)
                    @if ($annonce->idannonce == $incident->idannonce)
                    <td>Titre Annonce: {{ $annonce->titreannonce }}</td>
                    @endif
                @endforeach
                <td>Commentaire: {{ $incident->commentaire }}</td>
                <td>
                    @if (!$incident->resolu)
                        <form action="{{ route('reconnaissance-justifie', $incident->idincident) }}" method="post">
                            @csrf
                            <button type="submit">Reconnaître comme justifié</button>
                        </form>
                    @else
                    <p>Aucun incident en cours.</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <br><h3>Incidents résolus : </h3>
    <table>
        @foreach($incidents->where('resolu', true) as $incident)
            <tr>
                <td>ID Annonce: {{ $incident->idannonce }}</td>
                <td>Titre Annonce: {{ $incident->titre_annonce }}</td>
                <td>Commentaire: {{ $incident->commentaire }}</td>
                <td>Statut: justifié</td>
            </tr>
        @endforeach
    </table>
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

