<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder {
    public function run(): void {
        User::create([
            'document_type' => 'dni',
            'document_number' => '74877861',
            'first_names' => 'Mauro Fernando',
            'paternal_surname' => 'Caritas',
            'maternal_surname' => 'Borja',
            'phone' => '987590855',
            'email' => 'mfcaritasbdos@gmail.com',
            'password' => 'password',
            'profile_photo' => null,
            'role' => 'admin',
            'tuition_number' => null,
            'lawyer_id' => null,
        ]);
    }
}