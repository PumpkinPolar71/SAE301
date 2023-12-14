@extends('layouts.app')

@section('title', 'Faire une réservation')

@section('content')
    <h1>Faire une réservation</h1>

    <form method="POST" action="{{ route('add-reservation') }}">
        @csrf

        <!-- Champs pour les détails de réservation -->
        <label for="idperiode">ID Période :</label>
        <input type="number" id="idperiode" name="idperiode" required>
        
        <!-- Ajoutez ici les autres champs nécessaires à la réservation -->

        <!-- Exemple de champs pour saisir les informations -->
        <label for="nbadulte">Nombre d'adultes :</label>
        <input type="number" id="nbadulte" name="nbadulte" required>

        <label for="nbenfant">Nombre d'enfants :</label>
        <input type="number" id="nbenfant" name="nbenfant" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
    
    $reservation->idannonce = $idannonce;
    $reservation->idcompte = $idcompte;
    
    $reservation->idparticulier = $idparticulier;
    $reservation->idcarte = $idcarte;
    $reservation->cal_idperiode = $cal_idperiode;
    $reservation->nbadulte = $nbadulte;
    $reservation->nbenfant = $nbenfant;
    $reservation->nbbebe = $nbbebe;
    $reservation->nbanimaux = $nbanimaux;
    $reservation->prenom = $prenom;
    $reservation->nom = $nom;
    $reservation->tel = $tel;
    $reservation->nbnuitee = $nbnuitee;
    $reservation->taxessejour = $taxessejour;
    $reservation->montantimmediatacompte = $montantimmediatacompte;
    $reservation->montantimmediat = $montantimmediat;
    $reservation->message = $message;
    $reservation->datedebutr = $datedebutr;
    $reservation->datefinr = $datefinr;
        <!-- Autres champs nécessaires -->

        <button type="submit">Réserver</button>
    </form>
@endsection