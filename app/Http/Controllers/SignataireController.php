<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signataire;
use App\Models\Petition;


class SignataireController extends Controller
{
    public function store(Request $request, $petitionId)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:signataires,email',
            'telephone' => 'required|unique:signataires,telephone',
            'pays' => 'required',
            'ville' => 'required',
        ]);

        $signataire = new Signataire($request->all());
        $petition = Petition::findOrFail($petitionId);
        $petition->signataires()->save($signataire);

        return redirect()->route('petitions.show', $petitionId);
    }
}
