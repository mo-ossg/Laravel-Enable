<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'=>$this->faker->city() // city و بقله اخر اشي نوع البيانات وهي عندي اسماء مدن  name هيك انا بقله اسم العمود الي بدي اعطيه البيانات
        ];
    }
}
