<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $myUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
        ]);

        Task::factory(500)->recycle($users)->create();
        Task::factory(100)->recycle($myUser)->create();
    }
}
