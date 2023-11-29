
@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('sidebar')
    @parent

   


@endsection




@section('content')
<div class="welcome">
<h2>Pour un Noël plus abordable, plus chaud, logez vous sur leboncoin</h2>
<script>
   /* $(document).ready(function() {
        let html = $("html");
        $(html).on('mouseover', function() {
            console.log("sdg")
            document.location.href="{{ url("/annonce-filtres?ville=."&".type_hebergement=."&".datedebut=") }}";
        })
    })*/
</script>
</div>
<?php

?>







</form>


@endsection
