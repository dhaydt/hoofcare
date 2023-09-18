<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'online_link' => $this->faker->url(),
            'pic1' => $this->faker->imageUrl(640,480),
            'pic2' => $this->faker->imageUrl(640,480),
            'pic3' => $this->faker->imageUrl(640,480),
            'pic4' => $this->faker->imageUrl(640,480),
            'pic5' => $this->faker->imageUrl(640,480),
            'file_link1' => $this->faker->url(),
            'file_link2' => $this->faker->url(),
            'category_id' => $this->faker->randomElement(Category::all())['id'],
            'credit' => $this->faker->sentence(),
        ];
    }
}
