<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Moto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->password = '1234';
        $user->role = 'admin';

        $user->save();

        
        $newUser = new User;
        $newUser->name = 'daniel';
        $newUser->email = 'daniel.pdfg@gmail.com';
        $newUser->password = '123';
        $newUser->role = '';

        $newUser->save();

        $newUser2 = new User;
        $newUser2->name = 'prueba';
        $newUser2->email = 'prueba@gmail.com';
        $newUser2->password = '123';
        $newUser2->role = '';
        
        $newUser2->save();



    }
}
