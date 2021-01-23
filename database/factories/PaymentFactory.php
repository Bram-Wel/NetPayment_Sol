<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = array('hotspot', 'PPOE');
        return [
            'phone' => $this->faker->phoneNumber,
            'receipt_number' => $this->faker->word,
            'amount' => random_int(10, 2500),
            'type' => $this->faker->randomElement($types),
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now')
        ];
    }
}
