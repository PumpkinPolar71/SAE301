
@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('sidebar')
    @parent

   


@endsection




@section('content')
<h2>Ajouter une annonce</h2>


<form method="post" action="{{ url("/annonce/save") }}">
  @csrf
  {{ session()->get("error") }}
  <div>
      <label>Nom</label>
      <input type="text" name="name" value="{{ old("name") }}">
  </div>
  <div>
      <label>Description</label>
      <input type="text" name="descr" value="{{ old("descr") }}">
  </div>
  <div>
      <label>Type Logement</label>
      <input type="text" name="type" value="{{ old("type") }}">
  </div>
  <div>
      <label>image</label>
      <input type="text" name="img" value="{{ old("img") }}">
  </div>
  <div>
      <label></label>
      <input type="submit" value="Valider">
  </div>





</form>


@endsection
