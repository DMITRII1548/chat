<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = collect();
        for ($i = 1; $i < 4; $i++) {
            $users->push(\App\Models\User::factory()->create([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@gmail.com',
            ]));
        }

        $chats = Chat::factory(3)->create();

        $chats[0]->users()->attach($users[0]->id);
        $chats[0]->users()->attach($users[1]->id);

        $chats[1]->users()->attach($users[1]->id);
        $chats[1]->users()->attach($users[2]->id);

        $chats[2]->users()->attach($users[0]->id);
        $chats[2]->users()->attach($users[1]->id);
        $chats[2]->users()->attach($users[2]->id);
    }
}
