<?php

namespace Database\Factories;

use App\Models\Variable;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class VariableFactory extends Factory
{
    protected $model = Variable::class;

    #[ArrayShape(['title' => "string", 'description' => "array|string", 'opc_ua_namespace_index' => "int", 'opc_ua_identifier' => "int", 'enable' => "bool"])]
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->words(4, true),
            'opc_ua_namespace_index' => $this->faker->numberBetween(0, 5),
            'opc_ua_identifier' => $this->faker->unique()->numberBetween(1000, 1500),
            'enable' => true,
        ];
    }
}
