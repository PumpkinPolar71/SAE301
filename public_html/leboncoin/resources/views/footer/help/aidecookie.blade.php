@extends('layouts.app')

@section('content')

<h1 class="h1aide">Comment gérer les cookies ?</h1>
<h3>Qu'est-ce qu'un cookie ?</h3>
<p>    Un cookie (ou autre traceur) est un fichier texte stocké sur le disque dur de votre terminal (ordinateur, tablette, mobile) par le biais de votre logiciel de navigation à l'occasion de la consultation d'un service en ligne.

Les cookies enregistrés par nous ou par des tiers lorsque vous visitez notre Site ou nos Applications ne vous reconnaissent pas personnellement en tant qu'individu, mais reconnaissent seulement l'appareil que vous êtes en train d'utiliser. 
Les cookies ne stockent aucune donnée personnelle sensible ou directement identifiante mais donnent simplement une information sur votre navigation de façon à ce que votre terminal puisse être reconnu plus tard.

Le mot "cookies" dans la présente politique désigne tous traceurs pouvant être utilisés dans le cadre de notre Service et notamment ceux utilisés dans nos Applications.</p>
<h3>Comment gérer les cookies ?</h3>
<p>   Dès que vous vous connectez depuis un nouvel appareil ou une nouveau navigateur une fenetre apparait pour vous demandez vos choix concernant les cookies.<br>
<p>   Vous pouvez choisir soit de : "Tout accepter", "Tout refuser" ou alors "Personnaliser"</p>
<img src="{{ asset('AidesImages/panneaucookie.png') }}" ><br>
Vous seul(e) choisissez si vous souhaitez avoir des cookies enregistrés sur votre appareil et vous pouvez facilement contrôler l'enregistrement des cookies. Pour une information spécifique sur la gestion et le contrôle des cookies, veuillez-vous référer à la rubrique « Cookies » …<br>

• Vous pouvez modifier vos choix à tout moment à partir de l'onglet gestion des cookies présent en bas à gauche de chaque page ("Logo tarte citron").<br>
<img src="{{ asset('AidesImages/logocookie.png') }}" ><br>
L'accord ainsi donné est valable pour une durée maximum de treize (13) mois à compter du premier dépôt dans l'équipement du terminal.<br>

• Pour la gestion des cookies, la configuration de chaque navigateur est différente. Elle est décrite dans le menu d'aide de votre navigateur, qui vous permettra de savoir de quelle manière modifier vos souhaits<br>
• Vous refusez l'enregistrement de cookies dans votre terminal ou navigateur en : <br>
• En cliquant sur le bouton « Tout refuser » dans le bandeau après avoir cliqué sur le bouton « Personnaliser »<br>
• En paramétrant vos choix dans le gestionnaire de cookies accessible depuis le bouton « Personnaliser »</p>
<img src="{{ asset('AidesImages/panneau1.png') }}" ><br>
@endsection
