
@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('sidebar')
    @parent

   


@endsection




@section('content')
<h2>Les annonces</h2>
<ul>
   @foreach ($annonce as $leboncoins)
       <li>
         <a href="{{ url("/annonce/".$leboncoin->idleboncoin) }}">
            {{ $annonce->name }} 
         </a>
       </li>
  @endforeach
</ul>
@endsection
