<?php
namespace Database\Factories;
use App\Models\CaseModel;
use Illuminate\Database\Eloquent\Factories\Factory;
class CaseModelFactory extends Factory {
    protected $model = CaseModel::class;
    public function definition(): array {
        $status = $this->faker->randomElement(['EN TRAMITE','SENTENCIADO','ARCHIVADO']);
        return [
            'file_number' => $this->generateFileNumber(),
            'jurisdictional_body' => fake()->randomElement(['1° JUZGADO CIVIL','2° JUZGADO CIVIL','JUZGADO CIVIL TRANSITORIO']),
            'judge' => strtoupper(fake()->name()),
            'start_date' => fake()->date(),
            'subject' => fake()->randomElement(['NULIDAD DE ACTO JURIDICO','OBLIGACION DE DAR SUMA DE DINERO','IMPUGNACION DE ACUERDO']),
            'procedural_stage' => 'GENERAL',
            'location' => 'POOL ASIST. JUDICIAL',
            'sumilla' => fake()->sentence(6),
            'judicial_district' => fake()->randomElement(['LIMA','LIMA NORTE','HUANUCO']),
            'legal_specialist' => strtoupper(fake()->name()),
            'process' => fake()->randomElement(['ABREVIADO','CONOCIMIENTO']),
            'specialty' => 'CIVIL',
            'status' => $status,
            'completion_date' => $status === 'ARCHIVADO' ? fake()->date() : null,
            'reason_conclusion' => $status === 'ARCHIVADO' ? fake()->sentence(10) : null,
            'lawyer_id' => null,
            'customer_id' => null,
        ];
    }
    private function generateFileNumber():string{
        return $this->faker->unique()->numerify('#####-####-#-####-JR-CI-##');
    }
}