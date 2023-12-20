@extends('layouts.app')

@section('content')

<form method="post">
    <label class="ncarte">Numéro de carte : </label>
    <input class="ncarte"></input>
    <label class="cvv">CVV : </label>
    <input class="cvv"></input>
    <label class="dateExpiration">Date d'expirations : </label>
    <input class="dateExpiration"></input>

    <button type="submit">BAMMM</button>
</form>




    

<h1>Résultats</h1>
<?php



















    $numCarte = array(
        '5167 5861 3927 3847',
        '5257 2616 2253 8889',
        '5133 6868 6962 7633',
        '4024 0071 9959 2741',
        '4556 3383 8145 2329',
        '5446 6846 4875 7971',
        '4929 3876 5547 7264',
        '4916 5356 2323 5421',
        '5361 9837 2936 7952',
        '4539 4194 8344 6468'
    );

    $cvv = array(
        '526',
        '118',
        '180',
        '387',
        '746',
        '640',
        '363',
        '267',
        '717',
        '546'
    );

    $expirationDate = array(
        '2024-11-23',
        '2024-11-25',
        '2024-11-30',
        '2024-11-15',
        '2024-12-18',
        '2024-10-25',
        '2024-11-29',
        '2024-11-29',
        '2024-12-03',
        '2024-12-11'
    );

    
    ?>

@endsection