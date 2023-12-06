@extends('layouts.app')


@section('content')

<table>
@foreach($incidents as $incident)
    <p>ID: {{ $incident->idincident }} - Annonce: {{ $incident->idannonce }} - Remboursement: {{ $incident->remboursement }} - Commentaire: {{ $incident->commentaire }} - Procedure Juridique: {{ $incident->procedurejuridique }} - Resolu: {{ $incident->resolu ? 'Oui' : 'Non' }}
        <a href="{{ url('/classement-sans-suite/'.$incident->idincident) }}">Classer sans suite</a>
        | <a href="{{ url('/resolution/'.$incident->idincident) }}">Marquer comme résolu</a>
    </p>
@endforeach
</table>
@endsection