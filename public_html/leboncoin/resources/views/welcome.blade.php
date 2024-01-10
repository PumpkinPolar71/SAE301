
@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('sidebar')
    @parent

@endsection

@section('content')

<div class="welcome">

<h2>Pour un Noël plus abordable, plus chaud, logez vous sur leboncoin</h2>
<div class="bakcenter"><b>C'est le moment de déposer une annonce <a style="z-index:1; position:relative;" href="{{ url("/createAnnonce") }}"><p class="depann">Déposer une annonce</p></a></b><div class="baccenter"></div></div>
<ul class="recommandation">
    <li></li>
    <li></li>
</ul>
<script>
        var botmanWidget = {
            aboutText: '',
            introMessage: "Bienvenue dans notre site web",
            title: "Chatbot",
            mainColor: '#ff6e14',
            bubbleBackground: '#EC5A13',
            bubbleAvatarUrl: ''
        };
        
    </script>
   
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</div>
<?php

?>







</form>


@endsection
