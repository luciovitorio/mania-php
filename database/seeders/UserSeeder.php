<?php

namespace Database\Seeders;

use App\Enums\UserProfileEnum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch_id = DB::table('branches')
            ->where('name', 'Loja A')
            ->first()
            ->id;

        $date_of_birth = Carbon::createFromFormat('d/m/Y', '09/06/1981')->format('Y-m-d');

        User::create([
            'branch_id'     => $branch_id,
            'name'          => 'Lucio Vitorio',
            'email'         => 'lucio@email.com',
            'password'      => '12345',
            'cpf'           => '09098059708',
            'date_of_birth' => $date_of_birth,
            'profile'       => UserProfileEnum::Administrador,
        ]);

        User::create([
            'branch_id'     => $branch_id,
            'name'          => 'Barbara Bandeira',
            'email'         => 'barbara@email.com',
            'password'      => '12345',
            'cpf'           => '12345678901',
            'date_of_birth' => $date_of_birth,
            'profile'       => UserProfileEnum::Passadeira,
            'percent'       => 10
        ]);
    }
}
