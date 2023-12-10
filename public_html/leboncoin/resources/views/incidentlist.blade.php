@extends('layouts.app')

@section('content')

<h2>Incidents en cours</h2>
<table>
    @foreach($incidents->where('resolu', false) as $incident)
        <tr>
            <td>ID Annonce: {{ $incident->idannonce }}</td>
            <td>Titre Annonce: {{ $incident->titre_annonce }}</td>
            <td>Commentaire: {{ $incident->commentaire }}</td>
            <td>
            <form action="{{ route('changer-statut', ['id' => $incident->idincident]) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="PUT"> <!-- Ajoute cette ligne -->
    <input type="hidden" name="resolu" value="true">
    <button type="submit">Marquer comme résolu</button>
</form>
            </td>
        </tr>
    @endforeach
</table>

<h2>Incidents clos</h2>
<table>
    @foreach($incidents->where('resolu', true) as $incident)
        <tr>
            <td>ID Annonce: {{ $incident->idannonce }}</td>
            <td>Titre Annonce: {{ $incident->titre_annonce }}</td>
            <td>Commentaire: {{ $incident->commentaire }}</td>
        </tr>
    @endforeach
</table>

@endsection