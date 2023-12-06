<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        // Enregistrez le chemin dans la base de données ou effectuez toute autre opération que vous souhaitez.

        return redirect('/upload')->with('success', 'Image téléchargée avec succès.');
    }
}
