@extends('layouts.app')

@section('content')


   <?php
   



   foreach ($enregistres as $enregistre) {
      if (Auth::id() == $enregistre->idcompte) {
         foreach ($cartes as $carte) {
            if ($carte->idcarte == $enregistre->idcarte) 
                      echo "compte";
            }
      }
      else {
         echo "Nique Dahi";
         break;
      }
             
   }
   ?>
@endsection