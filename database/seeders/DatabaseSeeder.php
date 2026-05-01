<?php
namespace Database\Seeders;
use App\Models\CaseModel;
use App\Models\Customer;
use App\Models\Event;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;
    public function run(): void {
        $this->call([
            UserSeeder::class,
            SpecialtySeeder::class,
        ]);
        User::factory(3)->create(['role' => 'lawyer',]);        
        $customers = Customer::factory(25)->create();
        $lawyers = User::whereRole('lawyer')->pluck('id');
        foreach ($lawyers as $lawyer) {
            User::factory(random_int(1,3))->create([
                'role' => 'secretary',
                'tuition_number' => null,
                'lawyer_id' => $lawyer,
            ]);
        }
        foreach ($customers as $item) {
            CaseModel::factory(random_int(1,3))->create([
                'lawyer_id' => $lawyers->random(),
                'customer_id' => $item->id,
            ]);
        }
        Folder::factory(20)->create();
        Folder::factory(60)->child()->create();
        $users = User::all();
        foreach (Folder::all() as $item) {
            File::factory(random_int(1,4))->create([
                'uploaded_by' => $users->random()->id,
                'folder_id' => $item->id,
            ]);
        }
        Event::factory(120)->create();
    }
}