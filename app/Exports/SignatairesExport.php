<?php

// app/Exports/SignatairesExport.php

namespace App\Exports;

use App\Models\Signataire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SignatairesExport implements FromCollection, WithHeadings
{
    private $petitionId;

    public function __construct($petitionId)
    {
        $this->petitionId = $petitionId;
    }

    public function collection()
    {
        return Signataire::where('petition_id', $this->petitionId)->get(['nom', 'prenom', 'email', 'telephone', 'pays', 'ville']);
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Prénom',
            'Email',
            'Téléphone',
            'Pays de résidence',
            'Ville de résidence',
        ];
    }
}

