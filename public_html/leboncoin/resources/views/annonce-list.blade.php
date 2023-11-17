
@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('sidebar')
    @parent

   


@endsection




@section('content')
<h2>Les annonces</h2>
<ul>
   @foreach ($annonces as $annonce)
       <li>
         <a href="{{ url("/annonce/".$annonce->idannonce) }}">
            {{ $annonce->name }} 
         </a>
       </li>
  @endforeach
</ul>
@endsection