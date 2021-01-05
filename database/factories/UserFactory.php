<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = array('hotspot', 'PPPOE');

        return [
            'phone' => $this->faker->phoneNumber,
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '12345678', // password
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'type' => $this->faker->randomElement($type)
        ];
    }
}
