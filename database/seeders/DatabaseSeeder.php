<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeder = [
        UserSeeder::class,
        BranchSeeder::class,
        PlanSeeder::class,
        ClientSeeder::class,
        AddressSeeder::class
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BranchSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(AddressSeeder::class);
    }
}
