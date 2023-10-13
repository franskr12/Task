<?php
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Gunakan factory User untuk membuat beberapa pengguna
        User::factory(10)->create();
    }
}
