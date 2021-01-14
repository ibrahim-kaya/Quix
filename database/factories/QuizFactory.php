<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cat = array(
            'tarih', 'cografya', 'yemek', 'moda', 'burclar', 'bilim', 'teknoloji', 'genel-kultur', 'yabanci-dil', 'egitim', 'oyunlar', 'dizi-film', 'sanat'
        );

        return [
            'uniqueid' => bin2hex(random_bytes(6)),
            'baslik' => $this->faker->sentence(rand(3,7)),
            'olusturan_id' => rand(1,10),
            'aciklama' => $this->faker->text(200),
            'kategori' => $cat[rand(0, sizeof($cat)-1)]
        ];
    }
}
