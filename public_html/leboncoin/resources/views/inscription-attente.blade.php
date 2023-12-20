@extends('layouts.app')

@section('content')

    <h1>Toutes les réservations</h1>

    @if ($reservationsParAnnonce->isEmpty())

        <p>Aucune réservation disponible.</p>

    @else

        @foreach ($reservationsParAnnonce as $annonceId => $reservations)

            <h2>Annonce : {{ $reservations->first()->annonce->titre }}</h2>

            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Locataire</th>
                        <th>Date de réservation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)

                    <tr>
                        @foreach ($annonces as $annonce)
                            @if ($reservation->idannonce == $annonce->idannonce)
                                <td>{{ $annonce->titreannonce }}</td>
                            @endif
                        @endforeach
                        @foreach ($particuliers as $particulier)
                            @if ($particulier->idparticulier == $reservation->idparticulier)
                                <td>{{ $particulier->nomparticulier." ".$particulier->prenomparticulier }}</td>
                            @endif

                        @endforeach
                        @foreach ($entreprises as $entreprise)
                            @if ($entreprise->idcompte == $reservation->idcompte)
                                <td>{{ $entreprise->societe}}</td>
                            @endif
                        @endforeach
                        <td>
                            {{ \Carbon\Carbon::parse($reservation->datedebutr)->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($reservation->datefinr)->format('d/m/Y') }}
                        </td>

                                
                    </tr>

                     @endforeach
                </tbody>
            </table>

        @endforeach

    @endif

@endsection
