
@extends('layouts.app')

<!--@section('title', 'LeBonCoin')-->
<!-- 
@section('sidebar')
    @parent

   


@endsection -->




@section('content')


<div id="Recherche">
      <label>Rechercher</label>
      <input class="typeahead" type="text" name="rechercher" placeholder="Ex: Apagnyan" OnKeyPress="if (event.keyCode == 13)recherche()"  value="{{ old("name") }}">
      <!-- OnKeyPress="if (event.keyCode == 13)recherche()" -->
  </div>

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
