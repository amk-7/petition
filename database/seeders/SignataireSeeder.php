<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Signataire;
use App\Models\Petition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignataireSeeder extends Seeder
{
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@ifnti.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Assurez-vous de changer le mot de passe
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Attacher des signataires à la première pétition
        $petition1 = Petition::create([
            'titre' => 'Pétition pour la protection de l\'environnement',
            'etat' => 1,
            'objectif' => 10000,
            'description' => 'Signez cette pétition pour montrer votre soutien à la protection de l\'environnement.',
            'image' => 'default.png',
        ]);

        Signataire::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john@example.com',
            'telephone' => '123456789',
            'pays' => 'France',
            'ville' => 'Paris',
            'petition_id' => $petition1->id,
        ]);

        Signataire::create([
            'nom' => 'Smith',
            'prenom' => 'Jane',
            'email' => 'jane@example.com',
            'telephone' => '987654321',
            'pays' => 'USA',
            'ville' => 'New York',
            'petition_id' => $petition1->id,
        ]);

        // Attacher des signataires à la deuxième pétition
        $petition2 = Petition::create([
            'titre' => 'Pétition pour l\'éducation de qualité',
            'etat' => 1,
            'objectif' => 5000,
            'description' => 'Soutenez l\'éducation de qualité en signant cette pétition.',
            'image' => 'default.png',
        ]);

        Signataire::create([
            'nom' => 'Martin',
            'prenom' => 'Alice',
            'email' => 'alice@example.com',
            'telephone' => '555555555',
            'pays' => 'Canada',
            'ville' => 'Toronto',
            'petition_id' => $petition2->id,
        ]);
    }
}
