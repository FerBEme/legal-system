<?php
namespace Database\Seeders;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;
    public function run(): void {
        User::factory(3)->create(['role' => 'lawyer',]);
        $lawyers = User::whereRole('lawyer')->get();
        foreach ($lawyers as $lawyer) {
            User::factory(random_int(1,3))->create([
                'role' => 'secretary',
                'tuition_number' => null,
                'lawyer_id' => $lawyer->id,
            ]);
        }
        $this->call([
            UserSeeder::class,
            SpecialtySeeder::class,
        ]);
        Customer::factory(25)->create();
    }
}