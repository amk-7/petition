<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Signataire extends Model
{
    protected $fillable = ['nom', 'prenom', 'email', 'telephone', 'pays', 'ville'];

    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }
}
