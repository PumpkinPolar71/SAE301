@extends('layouts.app')

@section('content')

@auth
    <h1>Vos informations personelles</h1>
    <div>Voici les informations que nous avons à votre sujet :</div><br>
    @foreach($comptes as $compte)
        @if ($compte->idcompte == Auth::user()->compte->idcompte)
        <div>Adresse rue : <p style="display:inline;">{{$compte->adresseruecompte}}</p></div>
            @foreach($villes as $ville)
                @if ($ville->idville == $compte->idville)
                    <div>Adresse ville : <p style="display:inline;">{{$ville->nomville}}</p></div>
                @endif
            @endforeach
            <div>Adresse Code Postal : <p style="display:inline;">{{$compte->adressecpcompte}}</p></div>
            <div>Email : <p style="display:inline;">{{$compte->email}}</p></div>
            <div>Pseudo : <p style="display:inline;">{{$compte->pseudo}}</p></div>
            <div>PDP : <p style="display:inline;">{{$compte->pdp}}</p></div>
            <div>SIRET : <p style="display:inline;">{{$compte->siret}}</p></div>
            @foreach($particuliers as $particulier)
                @if ($particulier->idcompte == $compte->idcompte)
                    <div>Civilité : <p style="display:inline;">@if($particulier->civilite == true)Homme @else Femme @endif</p></div>
                    <div>Nom : <p style="display:inline;">{{$particulier->nomparticulier}}</p></div>
                    <div>Prenom : <p style="display:inline;">{{$particulier->prenomparticulier}}</p></div>
                    <?php
                        $date = new DateTime($particulier->datenaissanceparticulier);
                        $dateFormattee = $date->format('d-m-Y');
                    ?>
                    <div>Date de naissance : <p style="display:inline;">{{$dateFormattee}}</p></div>
                    <div>Téléphone : <p style="display:inline;">{{$particulier->numtelparticulier}}</p></div>
                @endif
            @endforeach
            <h2>Informations bancaires</h2>
            @foreach ($enregistres as $enregistre)
                @foreach ($cartes as $carte)
                    @if ($enregistre->idcompte == $compte->idcompte && $enregistre->idcarte == $carte->idcarte)
                        <div>Numero carte : <p style="display:inline;">{{$carte->numerocarte}}</p></div>
                        <div>cryptogramme : <p style="display:inline;">{{$carte->cryptogramme}}</p></div>
                        <div>Date expiration : <p style="display:inline;">{{$carte->dateexpiration}}</p></div>
                        <div>Nom : <p style="display:inline;">{{$carte->nomcarte}}</p></div>
                    @endif
                    @endforeach
            @endforeach 
        @endif
    @endforeach
    <form action="{{ url('/supprinfo') }}" method="POST">
        <button type="submit">Supprimer mes informations personelles</button>
    </form>
@else
<p>Vous devez être connecté pour accéder à ceci. <a href="connect">Se connecter</a></p>

@endauth

@endsection