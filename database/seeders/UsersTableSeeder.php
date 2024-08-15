<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    public function run(): void {
        User::create([
            'name'          => 'Thiago César',
            'description'   => 'Gestor Principal',
            'address'       => 'Rua Rio Eufrates, 62',
            'cpfcnpj'       => '01010101010',
            'type'          => 1,
            'status'        => 1,
            'email'         => 'thiago@ifuture.cloud',
            'password'      => bcrypt('123456'),
            'api_key'       => env('API_KEY_ASSAS'),
            'wallet'        => env('API_WALLET_ASSAS')
        ]);
    }
}
