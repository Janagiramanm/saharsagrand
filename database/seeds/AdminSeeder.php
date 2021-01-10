<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(User::class, 'admin')->create([
            'name' => 'SAHASRA Admin',
            'email' =>'admin@sahasra.com',
            'password' => Hash::make('admin1234$$'),
            'type' => 'superadmin',
            'role' => 'superadmin',
            'active' => 1
           
        ]);

       
    }
}
