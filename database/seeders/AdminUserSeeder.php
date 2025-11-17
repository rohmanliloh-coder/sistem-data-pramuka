<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin@toko.id';

        if (! User::where('email', $email)->exists()) {
            User::create([
                'name'        => 'Admin Toko',
                'username'    => 'admin_toko',
                'email'       => $email,
                'phone'       => '+62800000000',
                'password'    => Hash::make('Admin12345!'),
                'is_verified' => true,
                'role'        => 'admin',
            ]);
        }
    }
}
