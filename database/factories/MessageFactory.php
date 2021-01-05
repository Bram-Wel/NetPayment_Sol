<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = array('SMS', 'Email');

        return [
            'username' => $this->faker->firstName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->sentence,
            'type' => $this->faker->randomElement($type),
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now')
        ];
    }
}
