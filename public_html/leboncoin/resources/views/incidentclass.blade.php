@extends('layouts.app')

@section('content')

<h2>Incidents en cours</h2>
<table>
    @foreach($incidents->where('resolu', false) as $incident)
        <p>ID: {{ $incident->idincident }} - Annonce: {{ $incident->idannonce }} - Remboursement: {{ $incident->remboursement }} - Commentaire: {{ $incident->commentaire }} - Procedure Juridique: {{ $incident->procedurejuridique }} - Resolu: {{ $incident->resolu ? 'Oui' : 'Non' }}
            <a href="{{ url('/classement-sans-suite/'.$incident->idincident) }}">Classer sans suite</a>
            | <a href="{{ url('/resolution/'.$incident->idincident) }}">Marquer comme résolu</a>
        </p>
    @endforeach
</table>

<h2>Incidents clos</h2>
<table>
    @foreach($incidents->where('resolu', true) as $incident)
        <p>ID: {{ $incident->idincident }} - Annonce: {{ $incident->idannonce }} - Remboursement: {{ $incident->remboursement }} - Commentaire: {{ $incident->commentaire }} - Procedure Juridique: {{ $incident->procedurejuridique }} - Resolu: {{ $incident->resolu ? 'Oui' : 'Non' }}
            <a href="{{ url('/classement-sans-suite/'.$incident->idincident) }}">Classer sans suite</a>
            | <a href="{{ url('/resolution/'.$incident->idincident) }}">Marquer comme résolu</a>
        </p>
    @endforeach
</table>

@endsection
