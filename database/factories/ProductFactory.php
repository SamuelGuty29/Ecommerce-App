<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
	protected $model = Product::class;

	public function definition()
	{
		return [
			'name' => $this->faker->sentence(),
			'description' => $this->faker->paragraph(),
			'price' => $this->faker->randomFloat(),
			'stock' => $this->faker->randomDigit(),
			'category_id' => $this->faker->randomElement([1, 2, 3]),
		];
	}

	public function configure()
	{
		return $this->afterCreating(function (Product $product) {
			$file = new File(['route' => '/storage/images/products/default.jpg']);
			$product->file()->save($file);
		});
	}
}
