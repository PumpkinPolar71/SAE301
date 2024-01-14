@extends('layouts.app')

@section('content')

<h2>Incidents en cours</h2>
<table>
    @foreach($incidents->where('resolu', false) as $incident)
        <tr class="trincid">
            <td>ID Annonce: <b>{{ $incident->idannonce }}</b></td>
            @foreach ($annonces as $annonce)
                @if ($annonce->idannonce == $incident->idannonce )
                <td>Titre Annonce: <b>{{ $annonce->titreannonce }}</b></td>
                @endif
            @endforeach
            <td>Commentaire: <b>{{ $incident->commentaire }}</b></td>
            <td>
                <form action="{{ url('/classement-sans-suite/'.$incident->idincident) }}" method="post">
                    @csrf
                    <label for="statut">Statut :</label>
                    <select name="statut" id="statut">
                        <option value="resolu">Problème résolu</option>
                        <option value="non-resolu">Problème non résolu</option>
                    </select>
                    <button type="submit">Classer sans suite</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<h2>Incidents clos</h2>
<table>
    @foreach($incidents->where('resolu', true ) as $incident)
        <tr class="trincid">
            <td>ID Annonce: <b>{{ $incident->idannonce }}</b></td>
            @foreach ($annonces as $annonce)
                @if ($annonce->idannonce == $incident->idannonce )
                <td>Titre Annonce: <b>{{ $annonce->titreannonce }}</b></td>
                @endif
            @endforeach
            <td>Commentaire: <b>{{ $incident->commentaire }}</b></td>
        </tr>
    @endforeach
</table>

@endsection

