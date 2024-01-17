@extends('layouts.app')

@section('content')

@auth
<h2>Mes incidents</h2>


@if($incidents->count() > 0)
    <br><h3>Nombre total d'incidents réalisé : {{ $incidents->count() }}</h3>
    
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
                        <!-- Ne rien faire -->
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
                <td>ID Annonce: {{ $incident->idannonce }} | </td>
                <td>Titre Annonce: {{ $incident->titre_annonce }} | </td>
                <td>Commentaire: {{ $incident->commentaire }} | </td>
                <td>Statut: justifié</td>
            </tr>
        @endforeach
    </table>
@else
    <p>Aucun incident à afficher.</p>   
@endif

@if($annonceDeposee->count() > 0)
    <h2>Incidents sur mes reservations : </h2>
    @if($incidents->count() > 0)
        <br><h3>Nombre total d'incidents reçu : {{ $incidents->count() }}</h3>
        <br><h3>Incidents en cours : </h3>
        <table>
            @foreach($incidents->where('resolu', false) as $incident)
                <tr>
                    <td>ID Annonce : {{ $incident->idannonce }} | </td>
                    <td>ID Compte : {{ $incident->idcompte }} | </td>
                    @foreach ($annonces as $annonce)
                        @if ($annonce->idannonce == $incident->idannonce)
                        <td>Titre Annonce : {{ $annonce->titreannonce }} | </td>
                        @endif
                    @endforeach
                    <td>Commentaire : {{ $incident->commentaire }} | </td>
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
                    <td>ID Annonce : {{ $incident->idannonce }} | </td>
                    <td>ID Compte : {{ $incident->idcompte }} | </td>
                    @foreach ($annonces as $annonce)
                        @if ($annonce->idannonce == $incident->idannonce)
                        <td>Titre Annonce : {{ $annonce->titreannonce }} | </td>
                        @endif
                    @endforeach
                    <td>Commentaire : {{ $incident->commentaire }} | </td>
                    <td>Statut : justifié</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Aucun incident à afficher.</p>   
    @endif
@endif
@else
<p>Vous devez être connecté pour voir cette page</p>
@endauth
@endsection

