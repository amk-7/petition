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
            'email' => 'required|email',
            'telephone' => [
                'required',
            ],
            'pays' => 'required',
            'ville' => 'required',
        ]);

        $exists = Signataire::all()->where('petition_id', $petitionId)
            ->where('nom', $request->nom)
            ->where('prenom', $request->prenom)
            ->where('telephone', $request->telephone);        

        if ($exists->count()>0) {
            return redirect()->back()->withInput()->withErrors(['telephone' => 'Une entrée avec ces valeurs existe déjà.']);
        }

        $signataire = new Signataire($request->all());
        $petition = Petition::findOrFail($petitionId);
        $petition->signataires()->save($signataire);

        return redirect()->route('petitions.show', $petitionId);
    }
}
