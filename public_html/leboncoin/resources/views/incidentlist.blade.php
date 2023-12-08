@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')
    <!-- Affichage des annonces -->
    <!-- ... Votre code actuel pour afficher les annonces ... -->

    <!-- Affichage des incidents -->
    <h2>Incidents en cours</h2>
<table>
    @foreach($incidents->where('resolu', false) as $incident)
        <tr>
            <td>ID Annonce: {{ $incident->idannonce }}</td>
            <td>Titre Annonce: {{ $incident->titre_annonce }}</td>
            <td>Commentaire: {{ $incident->commentaire }}</td>
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