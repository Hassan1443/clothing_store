<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     *
     */
    protected $model = Product::class;
    public function definition()
    {
        return [
            //
            'product_name'=>$this->faker->word,
            'category'=>$this->faker->word,
            'brand'=>$this->faker->company,
            'description'=>$this->faker->sentence,
            'unit_price'=>$this->faker->numberBetween($min = 1000, $max = 9000),
            'image_1'=>$this->faker->randomElement(["assets/images/product_01.jpg","assets/images/product_02.jpg","assets/images/product_03.jpg","assets/images/product_04.jpg","assets/images/product_05.jpg","assets/images/product_06.jpg"]),
            'image_2'=>$this->faker->randomElement(["assets/images/product_01.jpg","assets/images/product_02.jpg","assets/images/product_03.jpg","assets/images/product_04.jpg","assets/images/product_05.jpg","assets/images/product_06.jpg"]),
            'image_3'=>$this->faker->randomElement(["assets/images/product_01.jpg","assets/images/product_02.jpg","assets/images/product_03.jpg","assets/images/product_04.jpg","assets/images/product_05.jpg","assets/images/product_06.jpg"]),
        ];
    }
}
