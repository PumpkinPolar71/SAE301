

@extends('layouts.app')

@section('content')

<h2>Mes incidents</h2>

@if(count($incidents) > 0)
    <h3>Incidents en cours : </h3>
    <table>
        @foreach($incidents->where('resolu', false) as $incident)
            <tr>
                <td>ID Annonce: {{ $incident->idannonce }}</td>
                <td>Titre Annonce: {{ $incident->titre_annonce }}</td>
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

    <h3>Incidents résolus : </h3>
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
