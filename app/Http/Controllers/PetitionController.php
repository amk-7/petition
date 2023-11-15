<?php

// app/Http/Controllers/PetitionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition;
use App\Exports\SignatairesExport;
use Maatwebsite\Excel\Facades\Excel;

class PetitionController extends Controller
{
    public function index()
    {
        $petitions = Petition::all();
        return view('dashboard', compact('petitions'));
    }

    public function show(Petition $petition)
    {
        return view('petitions.show', compact('petition'));
    }

    public function create()
    {
        return view('petitions.create_or_edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|unique:petitions',
            'etat' => 'required|boolean',
            'objectif' => 'required|integer|gt:0',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->file('file')){
            $file =  $request->file('file');
            $name = str_replace(' ', '_', strtolower($request['titre'])).".".$file->getClientOriginalExtension();
            $file->storeAs('public/petitions', $name);
            $request['image'] = $name;
        } else {
            $request['image'] = "default.png";
        }

        $petition = Petition::create($request->all());

        return redirect()->route('petitions.show', $petition->id);
    }

    public function edit(Petition $petition)
    {
        return view('petitions.create_or_edit', compact('petition'));
    }

    public function update(Request $request, Petition $petition)
    {
        $request->validate([
            'titre' => 'required|unique:petitions,titre,' . $petition->id,
            'etat' => 'required|boolean',
            'objectif' => 'required|integer|gt:0',
            'description' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        if ($request->file('file')){
            $file =  $request->file('file');
            $name = str_replace(' ', '_', strtolower($petition->titre)).".".$file->getClientOriginalExtension();
            $file->storeAs('public/petitions', $name);
            $request['image'] = $name;
        }
        $petition->update($request->all());

        return redirect()->route('petitions.index');
    }
    
    public function destroy(Petition $petition)
    {
        if ($petition->image) {
            Storage::disk('public')->delete($petition->image);
        }

        $petition->delete();

        return redirect()->route('petitions.index');
    }

    public function exportSignataires(Request $request, Petition $petition)
    {
        return Excel::download(new SignatairesExport($petition->id), 'signataires_export.xlsx');
    }
}
