<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['id' => 1],
            [
                'name'=>'Promobit',
                'email'=>'usuario@promobit.com.br',
                'password'=> '123123123',
             ]
        );
    }
}
