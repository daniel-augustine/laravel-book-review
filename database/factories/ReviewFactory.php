<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => null,
            'rating' => fake()->numberBetween(1, 5),
            'review' => fake()->paragraph,
            'created_at' => fake()->dateTimeBetween('-2years'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    public function good(){
        return $this->state(function(array $attributes){
            return [
                'rating' => fake()->numberBetween(4,5)
            ];
        });
    }

    public function average(){
        return $this->state(function(array $attributes){
            return [
                'rating' => fake()->numberBetween(2,4)
            ];
        });
    }

    public function bad(){
        return $this->state(function(array $attributes){
            return [
                'rating' => fake()->numberBetween(1,2)
            ];
        });
    }
}
