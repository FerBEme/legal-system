<?php
namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class UserFactory extends Factory {
    protected $model = User::class;
    public function definition(): array {
        $documentType = $this->faker->randomElement(['dni','ce']);
        $documentNumber = match ($documentType) {
            'dni' => fake()->unique()->numerify('########'),
            'ce' => fake()->unique()->numerify('#########'),
        };
        return [
            'document_type' => $documentType,
            'document_number' => $documentNumber,
            'first_names' => fake()->firstName() . ' ' . fake()->firstName(),
            'paternal_surname' => fake()->lastName(),
            'maternal_surname' => fake()->lastName(),
            'phone' => fake()->numerify('9########'),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'profile_photo' => null,
            'role' => null,
            'tuition_number' => fake()->numerify('#####'),
            'lawyer_id' => null
        ];
    }
}