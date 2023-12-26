<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branchId1 = DB::table('branches')
            ->where('name', 'Loja A')
            ->first()
            ->id;

        $branchId2 = DB::table('branches')
            ->where('name', 'Loja B')
            ->first()
            ->id;

        $userId1 = DB::table('users')
            ->where('name', 'Lucio Vitorio')
            ->first()
            ->id;

        $userId2 = DB::table('users')
            ->where('name', 'Barbara Bandeira')
            ->first()
            ->id;

        $clientId1 = DB::table('clients')
            ->where('name', 'Leonardo Henrique da Silva')
            ->first()
            ->id;

        $clientId2 = DB::table('clients')
            ->where('name', 'Lucia AVULSO')
            ->first()
            ->id;

        Address::create([
            'user_id'  => $userId1,
            'cep'      => 26266070,
            'street'   => 'Castor',
            'number'   => '66',
            'district' => 'Jardmin Nova Era',
            'city'     => 'Nova Iguaçu',
            'state'    => 'Rio de Janeiro'
        ]);

        Address::create([
            'user_id'  => $userId2,
            'cep'      => 210521901,
            'street'   => 'Castor',
            'number'   => '66',
            'district' => 'Jardmin Nova Era',
            'city'     => 'Nova Iguaçu',
            'state'    => 'Rio de Janeiro'
        ]);

        Address::create([
            'branch_id' => $branchId1,
            'cep'       => 20530400,
            'street'    => 'Estrada da Independência',
            'number'    => '41',
            'district'  => 'Tijuca',
            'city'      => 'Rio de Janeiro',
            'state'     => 'Rio de Janeiro'
        ]);

        Address::create([
            'branch_id'  => $branchId2,
            'cep'        => 20550000,
            'street'     => 'Avenida Heitor Beltrão',
            'number'     => '456',
            'complement' => 'Loja A',
            'district'   => 'Jardmin Nova Era',
            'city'       => 'Nova Iguaçu',
            'state'      => 'Rio de Janeiro'
        ]);

        Address::create([
            'client_id' => $clientId1,
            'cep'       => 20270290,
            'street'    => 'Avenida Melo Matos',
            'number'    => '736',
            'district'  => 'Tijuca',
            'city'      => 'Rio de Janeiro',
            'state'     => 'Rio de Janeiro'
        ]);

        Address::create([
            'client_id'  => $clientId2,
            'cep'        => 20521390,
            'street'     => 'Beco Elza',
            'number'     => '23',
            'complement' => 'Ap 201 - Bloco 1',
            'district'   => 'Tijuca',
            'city'       => 'Rio de Janeiro',
            'state'      => 'Rio de Janeiro'
        ]);
    }
}
