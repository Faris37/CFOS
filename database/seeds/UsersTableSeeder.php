<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','Faris Izwan')->first();
        $parentRole = Role::where('name','Afiq Iskandar')->first();
        $publicRole = Role::where('name','Haqeem Solehan')->first();

        $admin = User::create([
            'name' => 'Faris Izwan Admin',
            'email' => 'farisizwanahmadfauzi@gmail.com',
            'OID' => 1,
            'password' => Hash::make('1300882525tT')
        ]);

        $parent = User::create([
            'name' => 'Afiq Iskandar',
            'email' => 'aIskandar@gmail.com',
            'OID' => 1,
            'password' => Hash::make('1300882525tT')
        ]);

        $public = User::create([
            'name' => 'Haqeem Solehan',
            'email' => 'haqeemChak@gmail.com',
            'OID' => 1,
            'password' => Hash::make('1300882525tT')
        ]);

        $admin->roles()->attach($adminRole);
        $parent->roles()->attach($parentRole);
        $public->roles()->attach($publicRole);
    }
}
