<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $authors = Author::factory()->count(4)->create();
        foreach ($authors as $author){
            Book::factory()->count(rand(1, 10))->create(['author_id' => $author->id]);
        }
    }
}
