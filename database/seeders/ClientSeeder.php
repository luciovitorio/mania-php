<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', '06/06/1982')->format('Y-m-d');
        $branchId = DB::table('branches')
            ->where('name', 'Loja A')
            ->first()
            ->id;
        $planId01 = DB::table('plans')
            ->where('name', 'ECONOMICO 2022')
            ->first()
            ->id;
        $planId02 = DB::table('plans')
            ->where('name', 'Avulso')
            ->first()
            ->id;

        Client::create([
            'id'                   => uuid_create(),
            'plan_id'              => $planId01,
            'branch_id'            => $branchId,
            'name'                 => 'Leonardo Henrique da Silva',
            'cpf'                  => '09431641763',
            'rg'                   => '132482498',
            'date_of_birth'        => $dateOfBirth,
            'email'                => 'michelle.oliveiraimenes@gmail.com',
            'home_phone'           => '2121797952',
            'cell_phone'           => '21980376882',
            'collection_frequency' => 'SEMANAL',
            'collection_day'       => 'QUARTA',
            'collection_time'      => '09:00',
            'delivery_day'         => 'QUARTA',
            'delivery_time'        => '09:00',
            'collection_start'     => null,
            'description'          => null,
            'delivery_amount'      => null,
            'due_date'             => 5,
            'is_active'            => true
        ]);

        Client::create([
            'id'                   => uuid_create(),
            'plan_id'              => $planId02,
            'branch_id'            => $branchId,
            'name'                 => 'Lucia AVULSO',
            'cpf'                  => '09098059708',
            'cell_phone'           => '21980376882',
            'collection_frequency' => 'AVULSO',
            'delivery_amount'      => 10.00,
            'is_active'            => true
        ]);
    }
}
