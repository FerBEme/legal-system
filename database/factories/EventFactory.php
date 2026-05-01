<?php
namespace Database\Factories;
use App\Models\CaseModel;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class EventFactory extends Factory {
    protected $model = Event::class;
    public function definition(): array {
        $eventType = $this->faker->randomElement(['audience','client_meeting','task']);
        $start = $this->faker->dateTimeBetween('-3 month','+1 month');
        $end = (clone $start)->modify('+' . rand(1,3) . ' hours');
        return [
            'title' => fake()->sentence(4),
            'event_type' => $eventType,
            'start_date' => $start,
            'end_date' => $end,
            'meeting_link' => $eventType === 'audience' ? fake()->url() : null,
            'description' => fake()->optional()->paragraph(),
            'case_id' => $eventType === 'audience' ? fake()->randomElement(CaseModel::pluck('id')->toArray()) : null,
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}