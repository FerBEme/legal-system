<?php
namespace Database\Factories;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class FileFactory extends Factory {
    protected $model = File::class;
    public function definition(): array {
        $files = [
            ['ext' => 'pdf',  'mime' => 'application/pdf'],
            ['ext' => 'docx', 'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            ['ext' => 'doc',  'mime' => 'application/msword'],
            ['ext' => 'xlsx', 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
            ['ext' => 'xls',  'mime' => 'application/vnd.ms-excel'],
        ];
        $file = $this->faker->randomElement($files);
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1,9999),
            'path' => 'files/' . now()->format('Y/m') . '/' . Str::uuid() . '.' . $file['ext'],
            'mime_type' => $file['mime'],
            'extension' => $file['ext'],
            'size' => fake()->numberBetween(10_000,5_000_000),
            'uploaded_by' => null,
            'folder_id' => null,
        ];
    }
}