@extends('layouts.app')

@section('title', 'LeBonCoin')

@section('content')
<div class="bandeau">
    <div class="pdp"><p class="pDeMrd">Q</p></div>
    <h1>{{ $proprio->nomparticulier }}</h1>
    <h1>{{$proprio->prenomparticulier}}</h1>
    <h1>{{$proprio->adressemailparticulier}}</h1>
    <h1>{{$proprio->nomville}}

</div>
@endsection