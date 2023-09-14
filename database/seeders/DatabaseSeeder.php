<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Console\Commands\checkfungamess;
use App\Console\Commands\checkfungamessproviders;
use Illuminate\Database\Seeder;
use Tests\HelpTestTrait;

class DatabaseSeeder extends Seeder
{
    use HelpTestTrait;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(GroupTableSeeder::class);

        $this->call(InsertGames::class);
        $this->call(InsertFunGames::class);

        for ($i = 1; $i <= 10; $i++) {
            $this->generateRandomUser();
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
