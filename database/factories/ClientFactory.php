<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name' => $this->faker->name(),
          'email' => $this->faker->unique()->safeEmail(),
          'phone_number' => $this->faker->unique()->phoneNumber(),
          'company_name' => $this->faker->unique()->name(),
          'company_address' => $this->faker->address(),
          'company_city' => $this->faker->city(),
          'company_zip' => $this->faker->randomNumber(4),
          'company_vat' => $this->faker->unique()->randomNumber(4)
        ];
    }
}
