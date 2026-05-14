<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create([
            'role' => function () {
                return collect(['admin', 'professeur', 'etudiant'])->random();
            }
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Professeur',
            'prenom' => 'Ahmed',
            'email' => 'prof@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'professeur',
        ]);

        User::factory()->create([
            'name' => 'Etudiant',
            'prenom' => 'Yassine',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'etudiant',
        ]);
    }
}
