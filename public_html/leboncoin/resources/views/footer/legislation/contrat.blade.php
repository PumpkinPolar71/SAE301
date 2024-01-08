@extends('layouts.app')

@section('content')

<div class="cookie">

<h1>Contrat OVH</h1>
<p>L'article 6 du contrat OVH aborde la mitigation contre les attaques de type DOS et DDOS. Cette clause présente des éléments clés concernant la protection offerte par OVH, mais également les limitations et les responsabilités du client en matière de sécurité informatique.<br><br>

<b>Compréhension de la Mitigation</b> :<br>
La mitigation vise à maintenir la disponibilité du service du client pendant une attaque en filtrant le trafic extérieur illégitime. Cela permet aux utilisateurs légitimes d'accéder aux applications malgré l'attaque. Cependant, la protection n'inclut pas toutes les attaques possibles, telles que l'injection SQL ou les exploitations de failles de sécurité.<br><br>
<b>Limites de la Protection</b> :<br>
OVH n'est tenu qu'à une obligation de moyens, ce qui signifie qu'il met en place des outils pour détecter et filtrer le trafic malveillant, mais ne peut garantir à 100 % la détection de toutes lesattaques. Il est possible que certaines attaques ne soient pas détectées ou que la mitigation ne puisse pas maintenir le service pendant l'attaque.
<br><br>
<b>Activation et Durée de la Mitigation</b> :<br>
La mitigation n'est activée qu'après la détection de l'attaque par les outils d'OVH. Pendant ce laps de temps, le service peut être indisponible. Une fois activée, la mitigation reste en place jusqu'à ce qu'OVH n'identifie plus d'activité malveillante.
<br><br>
<b>Responsabilités du Client</b> :<br>
Le client doit aussi prendre des mesures de sécurité complémentaires, comme sécuriser son service, mettre en place des pare-feu, effectuer des mises à jour régulières, sauvegarder ses données, et garantir la sécurité de ses propres programmes informatiques.
<br><br>
<b>Anticipation et Conséquences</b> :<br>
Le client peut activer la mitigation à l'avance, mais cela peut altérer la qualité du service. OVH rappelle donc l'impact potentiel sur la qualité du service et recommande une connaissance préalable des conséquences.
Il est important que le responsable juridique comprenne que la mitigation offre une protection partielle et que la responsabilité de la sécurité de l'infrastructure du client reste partagée. Il est également crucial que le client prenne des mesures de sécurité complémentaires pour renforcer la protection de son service.
<br><br>
Pour des éclaircissements approfondis ou pour des conseils spécifiques concernant les implications légales de cette clause, il pourrait être bénéfique de consulter un expert juridique spécialisé en droit des contrats informatiques.
</p>


</div>
@endsection