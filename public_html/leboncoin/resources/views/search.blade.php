
@extends('layouts.app')

@section('content')



<!-- tentative de recherche par location : -->
<h1>Combobox de Villes</h1>

    <form action="{{ route('search') }}" method="post">
        @csrf

        <label for="ville">Sélectionnez une ville :</label>
        <select name="ville" id="ville">
            @foreach($cities as $id => $city)
                <option value="{{ $id }}">{{ $city }}</option>
            @endforeach
        </select>

        <button type="submit">Soumettre</button>
    </form>
    

<!-- traitement de la recherche et affichage : -->
    <h2>Résultats de la recherche :</h2>

   
        <p>Vous avez recherché : {{ $_POST['search'] }}</p></br>
        <?php
        $nom = $_POST['search'];
        pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
        pg_query("set names 'UTF8'");
        pg_query("SET search_path TO leboncoin");

        $query = "SELECT titreannonce FROM annonce WHERE titreannonce ILIKE '%$nom%'";
		$text = pg_query($query);

		echo "<table>";
        if (pg_fetch_assoc($text)!=0) {
		while ($row = pg_fetch_assoc($text)) {
		echo "<tr>";


        foreach($row as $key=>$value)
		echo "<td>".$value."</td>";
		echo "</tr>";
		} echo "</table>";
        }
        else {
            echo "<p>Désolé, nous n’avons pas ça sous la main !</p><p>Vous méritez tellement plus qu’une recherche sans résultat !st-il possible qu’une faute de frappe se soit glissée dans votre recherche ? N’hésitez pas à vérifier !</p>";
        }

?>








@endsection

