
@extends('layouts.app')

<!--@section('title', 'LeBonCoin')-->
<!-- 
@section('sidebar')
    @parent

   


@endsection -->




@section('content')


<h2>Annonces : "..."</h2>

<ul class="ulaffiche">
   @foreach ($annonces as $annonce)
       <li>
         <a href="{{ url("/annonce/".$annonce->idannonce) }}">
            {{ $annonce->titreannonce }} 
         </a>
       </li>
  @endforeach
</ul>
@endsection
