<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Feature;
use App\Models\Login;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(10)
            ->has(
                User::factory(random_int(5,10))
                    ->has(Login::factory(random_int(5,10)))
            )
            ->create();

        $users = User::all('id');
        Feature::factory(60)
            ->create()
            ->each(function ($feature) use ($users) {
                $feature->comments()->createmany(
                    Comment::factory(rand(1, 50))->make()->each(function ($comment) use ($users) {
                        $comment->user_id = $users->random()->id;
                    })->toArray()
                );
            });
    }
}
