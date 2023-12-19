@extends('layouts.app')

@section('content')

    <h1>Toutes les réservations</h1>

    @if ($reservations->isEmpty())

        <p>Aucune réservation disponible.</p>

    @else

        <table>

            <thead>

                <tr>

                    <th>Annonce</th>
                    
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
                        
                                <td>{{ $reservation->datedebutr."/".$reservation->datefinr  }}</td>
                        
                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

@endsection
