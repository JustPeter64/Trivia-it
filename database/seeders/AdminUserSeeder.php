<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //maak standaard een admin user aan
        $user = new \App\Models\User();
        $user->name = "Peter";
        $user->email = "peter@admin.com";
        $user->password = bcrypt("Geheimpje!!69420");
        $user->admin = true;
        $user->save();
        
    }
}
