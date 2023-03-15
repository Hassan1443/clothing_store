<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Image::class;
    public function definition()
    {
        return [
            //
             'path'=>$this->faker->randomElement(["assets/images/product_01.jpg","assets/images/product_02.jpg","assets/images/product_03.jpg","assets/images/product_04.jpg","assets/images/product_05.jpg","assets/images/product_06.jpg"]),
             'imageable_id'=>$this->faker->randomElement([159,160, 161, 162, 163, 164, 165,166, 167, 168, 169, 170]),
             'imageable_type'=>'App\Models\Product',
        ];
    }
}
