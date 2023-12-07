@extends('layouts.app')

@section('content')

<h2>Incidents en cours</h2>
<table>
    @foreach($incidents->where('resolu', false) as $incident)
        <tr>
            <td>ID Annonce: {{ $incident->idannonce }}</td>
            <td>Titre Annonce: {{ $incident->titre_annonce }}</td>
            <td>Commentaire: {{ $incident->commentaire }}</td>
            <td><a href="{{ url('/classement-sans-suite/'.$incident->idincident) }}">Classer sans suite</a></td>
            <td><a href="{{ url('/resolution/'.$incident->idincident) }}">Marquer comme résolu</a></td>
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
            <td><a href="{{ url('/classement-sans-suite/'.$incident->idincident) }}">Classer sans suite</a></td>
        </tr>
    @endforeach
</table>

@endsection
