<?php

namespace Database\Seeders;

use App\Models\Clothin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClothinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branchId = DB::table('branches')
            ->where('name', 'Loja A')
            ->first()
            ->id;

        $clothinData = [
            [
                'id'   => uuid_create(),
                'name' => 'Bata Feminina',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Bermuda',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Blusa Manga Longa',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Calça',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Camiseta',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Camisa Polo',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Camisola',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Fronhas',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Pano de Prato',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Peça de Bebê',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Regata',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Saia',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Toalha',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Toalha de Mesa',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Vestido',
                'type' => 'EASY',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Camisa Social',
                'type' => 'HARD',
            ],
            [
                'id'   => uuid_create(),
                'name' => 'Lençol',
                'type' => 'HARD',
            ],
        ];

        // Loop para criar os registros
        foreach ($clothinData as $data) {
            Clothin::create(array_merge($data, ['branch_id' => $branchId]));
        }
    }
}
