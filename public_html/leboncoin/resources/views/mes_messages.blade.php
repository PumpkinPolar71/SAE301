
@extends('layouts.app')

@section('content')

<h2>Mes recherches</h2>
@auth

@else
<p>Vous devez être connécté pour voir vos recherhces sauvegardées</p>
@endauth

@endsection
