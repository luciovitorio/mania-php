<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'id'                               => uuid_create(),
            'name'                             => 'ECONOMICO 2022',
            'piece_quantity'                   => 20,
            'simple_piece_quantity'            => 20,
            'difficult_piece_quantity'         => 6,
            'simple_piece_value'               => '3,45',
            'difficult_piece_value'            => '5,45',
            'additional_simple_piece_value'    => '4,29',
            'additional_difficult_piece_value' => '7,50',
            'is_active'                        => 'on'
        ]);

        Plan::create([
            'id'                               => uuid_create(),
            'name'                             => 'Avulso',
            'piece_quantity'                   => 0,
            'simple_piece_quantity'            => 0,
            'difficult_piece_quantity'         => 0,
            'simple_piece_value'               => '3,90',
            'difficult_piece_value'            => '6,45',
            'additional_simple_piece_value'    => '3,90',
            'additional_difficult_piece_value' => '6,70',
            'is_active'                        => 'on'
        ]);

        Plan::create([
            'id'                               => uuid_create(),
            'name'                             => 'Familiar 2022',
            'piece_quantity'                   => 40,
            'simple_piece_quantity'            => 40,
            'difficult_piece_quantity'         => 12,
            'simple_piece_value'               => '3,30',
            'difficult_piece_value'            => '6,00',
            'additional_simple_piece_value'    => '3,90',
            'additional_difficult_piece_value' => '6,90',
            'is_active'                        => 'on'
        ]);

        Plan::create([
            'id'                               => uuid_create(),
            'name'                             => 'Casal 2021',
            'piece_quantity'                   => 30,
            'simple_piece_quantity'            => 30,
            'difficult_piece_quantity'         => 9,
            'simple_piece_value'               => '3,00',
            'difficult_piece_value'            => '5,15',
            'additional_simple_piece_value'    => '3,70',
            'additional_difficult_piece_value' => '6,00',
            'is_active'                        => 0
        ]);
    }
}
