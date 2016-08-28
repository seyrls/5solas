<?php
use Illuminate\Database\Seeder;
use App\User as User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Seyr Lemos',
            'username' => 'seyrls',
            'email'    => 'seyrls@gmail.com',
            'password' => Hash::make('123456'),
        ));
    }

}