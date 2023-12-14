@extends('layouts.app')

@section('content')
    <h2>Créer un nouvel équipement</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('equipements.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nomequipement">Nom de l'équipement</label>
            <input type="text" name="nomequipement" id="nomequipement" class="form-control" required>
        </div>

        <!-- Ajoutez d'autres champs de formulaire selon vos besoins -->

        <button type="submit" class="btn btn-primary">Créer l'équipement</button>
    </form>

    <!-- Ajoutez le reste du contenu de la vue service_annonces ici -->
@endsection
