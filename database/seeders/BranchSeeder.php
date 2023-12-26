<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            'id'       => uuid_create(),
            'name'     => 'loja a',
            'phone'    => '3103-1368',
            'whatsapp' => '98729-9278',
            'email'    => 'lojaA@email.com'
        ]);

        DB::table('branches')->insert([
            'id'       => uuid_create(),
            'name'     => 'loja b',
            'phone'    => '1111-1111',
            'whatsapp' => '98729-9278',
            'email'    => 'lojaB@email.com'
        ]);
    }
}
