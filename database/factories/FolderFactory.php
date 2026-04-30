<?php
namespace Database\Factories;
use App\Models\CaseModel;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;
class FolderFactory extends Factory {
    protected $model = Folder::class;
    public function definition(): array {
        $caseId = CaseModel::inRandomOrder()->value('id');
        return [
            'name' => fake()->unique()->word(),
            'parent_id' => null,
            'case_id' => $caseId,
        ];
    }
    public function child(){
        return $this->state(function (array $attributes) {
            $parent = Folder::whereCaseId($attributes['case_id'] ?? null)
                ->inRandomOrder()
                ->first();
                return [
                    'parent_id' => $parent?->id,
                ];
        });
    }
}