<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Soru;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoruFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Soru::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'quiz_id'=>rand(1,10),
            'soru'=>$this->faker->sentence(rand(3,7)),
            'cevap1'=>$this->faker->sentence(rand(3,7)),
            'cevap2'=>$this->faker->sentence(rand(3,7)),
            'cevap3'=>$this->faker->sentence(rand(3,7)),
            'cevap4'=>$this->faker->sentence(rand(3,7)),
            'dogru_cevap'=>'cevap'.rand(1,4)
        ];
    }
}
