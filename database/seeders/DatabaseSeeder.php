<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags = \App\Models\Tag::factory(10)->create();
    
        \App\Models\User::factory(10)->create()->each(function ($user) use ($tags) {
            \App\Models\Event::factory(rand(2, 5))->create([
                'user_id' => $user->id
            ])->each(function ($event) use ($tags){
                $event->tags()->attach($tags->random(3));;
            });
        });
    }
}
