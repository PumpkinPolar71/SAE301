@extends('layouts.app')

@section('content')

@auth
    @if (Auth::user()->compte->codeetatcompte == 11 )
    <h2>Gestion des avis non validés</h2>
    <table>
        <thead>
            <tr>
                <th>ID Avis</th>
                <th>Contenu</th>
                <th>Valide</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avisNonValides as $avis)
                <tr>
                    <td>{{ $avis->idavis }}</td>
                    <td>{{ $avis->commentaire }}</td>
                    <td>
                        <form action="{{ url('/modifierAvis/'.$avis->idavis) }}" method="POST">
                            @csrf
                            <select name="valide" onchange="this.form.submit()">
                                <option value="0" {{ $avis->valide == false ? 'selected' : '' }}>Non valide</option>
                                <option value="1" {{ $avis->valide == true ? 'selected' : '' }}>Valide</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <!-- Ajoutez ici d'autres actions si nécessaire avisDetails -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else 
    <p>Vous n'avez pas les autorisation requises pour voir cette page, cette incident à été signalé.</p>
    @endif
@endauth


@endsection