
@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('sidebar')
    @parent

   


@endsection




@section('content')
<div class="welcome">

<h2>Pour un Noël plus abordable, plus chaud, logez vous sur leboncoin</h2>
    <div class="bakcenter"><b>C'est le moment de déposer une annonce <a  href="{{ url("/createAnnonce") }}"><p class="depann">Déposer une annonce</p></a></b><div class="baccenter"></div></div>
<script>
   /* $(document).ready(function() {
        let html = $("html");
        $(html).on('mouseover', function() {
            console.log("sdg")
            document.location.href="{{ url("/annonce-filtres?ville=."&".type_hebergement=."&".datedebut=") }}";
        })
    })*/
</script>
<script>
        var botmanWidget = {
            aboutText: '',
            introMessage: "Bienvenue dans notre site web"
        };
    </script>
   
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</div>
<?php

?>







</form>


@endsection
