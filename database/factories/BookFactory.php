<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(10),
            'author_id' => function(){
                return Author::factory()->create()->id;
            },
            'pages' => $this->faker->randomNumber(3, true),
        ];
    }
}
