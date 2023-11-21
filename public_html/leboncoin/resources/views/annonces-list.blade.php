
@extends('layouts.app')

@section('content')


<h2>Annonces : "..."</h2>

<ul class="ulAffiche">
   @foreach ($annonces as $annonce)
   <a href="{{ url("/annonce/".$annonce->idannonce) }}">
   <li>
       <?php
        /*if ($photo->idphoto != NULL) {
            echo "<img src='$photo->photo' />";
        } else {
            echo "Oups... Il semblerait que cette annonce ne contienne aucune image.";
        }
   */ ?>
         
         <img src=''>
            {{ $annonce->titreannonce }} 
        
       </li> </a>
  @endforeach
</ul>
@endsection
