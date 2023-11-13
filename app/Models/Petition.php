<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $fillable = ['titre', 'image', 'etat', 'objectif', 'description'];

    public function signataires()
    {
        return $this->hasMany(Signataire::class);
    }

    public function showDescription()
    {
        return substr($this->description, 0, 500)."...";
    }
}
