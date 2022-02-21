<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'image'=>'1644931561.jrg',
            'text'=>'grqi masin',
            'file'=>'1644787955.docx',
            'author_id' => $this->faker->numberBetween(1,50)
        ];
    }
}
