
@extends('layouts.app')

@section('content')
    <h1>Locataires de l'annonce</h1>

    <h2>Annonce : {{ $annonce->titre }}</h2>

    @if ($annonce->reservations->isEmpty())
        <p>Aucune réservation pour cette annonce.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Locataire</th>
                    <th>Date de réservation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($annonce->reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->locataire->nom }}</td>
                        <td>{{ $reservation->date_reservation }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection