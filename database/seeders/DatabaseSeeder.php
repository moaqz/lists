<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $group = Group::factory()->create([
            'user_id' => $user->id,
        ]);

        Task::factory(40)->create([
            'user_id' => $user->id,
            'group_id' => $group->id,
        ]);
    }
}
