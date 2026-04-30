<?php
namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
class CustomerFactory extends Factory {
    protected $model = Customer::class;
    public function definition(): array {
        $documentType = $this->faker->randomElement(['dni','ce','ruc']);
        $documentNumber = match ($documentType) {
            'dni' => fake()->unique()->numerify('########'),
            'ce' => fake()->unique()->numerify('#########'),
            'ruc' => fake()->unique()->numerify('20#########'),
        };
        return [
            'document_type' => $documentType,
            'document_number' => $documentNumber,
            'business_name' => $documentType === 'ruc' ? fake()->company() : null,
            'first_names' => $documentType !== 'ruc' ? fake()->firstName() . ' ' . fake()->firstName() : null,
            'paternal_surname' => $documentType !== 'ruc' ? fake()->lastName() : null,
            'maternal_surname' => $documentType !== 'ruc' ? fake()->lastName() : null,
            'phone' => fake()->optional(0.8)->numerify('9########'),
            'email' => fake()->optional(0.8)->safeEmail(),
            'home_address' => fake()->optional(0.6)->address(),
            'district_address' => fake()->optional(0.6)->address(),
            'province_address' => fake()->optional(0.6)->word(),
            'department_address' => fake()->optional(0.6)->word(),
        ];
    }
}