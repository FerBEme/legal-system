<?php
namespace Database\Seeders;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SpecialtySeeder extends Seeder {
    public function run(): void {
        $bigBranchesRight = [
            ['name' => 'Derecho Público', 'description' => 'Regula la relación entre el Estado y los ciudadanos','parent_id' => null, 'level' => 1,],
            ['name' => 'Derecho Privado', 'description' => 'Regula relaciones entre particulares (personas o empresas)','parent_id' => null, 'level' => 1,],
            ['name' => 'Derecho Social', 'description' => 'Protege sectores vulnerables y equilibra desigualdades','parent_id' => null, 'level' => 1,],
        ];
        foreach ($bigBranchesRight as $big) {
            Specialty::create([
                'name' => $big['name'],
                'description' => $big['description'],
                'parent_id' => $big['parent_id'],
                'level' => $big['level'],
            ]);
        }
        $public = Specialty::whereName('Derecho Público')->first()->id;
        $pivate = Specialty::whereName('Derecho Privado')->first()->id;
        $social = Specialty::whereName('Derecho Social')->first()->id;
        $mainBranches = [
            ['name' => 'Derecho Constitucional', 'description' => 'Normas y derechos fundamentales del Estado','parent_id' => $public, 'level' => 2,],
            ['name' => 'Derecho Administrativo', 'description' => 'Gestión y actos de la administración pública','parent_id' => $public, 'level' => 2,],
            ['name' => 'Derecho Penal', 'description' => 'Normas y derechos fundamentales del Estado','parent_id' => $public, 'level' => 2,],
            ['name' => 'Derecho Procesal', 'description' => 'Delitos y sanciones','parent_id' => $public, 'level' => 2,],
            ['name' => 'Derecho Internacional Público', 'description' => 'Relaciones entre Estados','parent_id' => $public, 'level' => 2,],

            ['name' => 'Derecho Civil', 'description' => 'Relaciones entre personas (bienes, contratos, familia)','parent_id' => $pivate, 'level' => 2,],
            ['name' => 'Derecho Comercial / Mercantil', 'description' => 'Actividad empresarial y comercio','parent_id' => $pivate, 'level' => 2,],
            ['name' => 'Derecho Empresarial', 'description' => 'Regulación integral de empresas','parent_id' => $pivate, 'level' => 2,],
            ['name' => 'Derecho Internacional Privado', 'description' => 'Conflictos legales entre países (particulares)','parent_id' => $pivate, 'level' => 2,],

            ['name' => 'Derecho Laboral', 'description' => 'Relación trabajador–empleador','parent_id' => $social, 'level' => 2,],
            ['name' => 'Derecho de Seguridad Social', 'description' => 'Pensiones, salud y beneficios sociales','parent_id' => $social, 'level' => 2,],
        ];
        foreach ($mainBranches as $branch) {
            Specialty::create([
                'name' => $branch['name'],
                'description' => $branch['description'],
                'parent_id' => $branch['parent_id'],
                'level' => $branch['level'],
            ]);
        }
        $specialties = Specialty::whereLevel(2)->pluck('id')->toArray();
        $lawyers = User::whereRole('lawyer')->get();
        foreach ($lawyers as $lawyer) {
            $randomCount = rand(1,4);
            $randomSpecialties = Arr::random($specialties,$randomCount);
            $randomSpecialties = (array) $randomSpecialties;
            $lawyer->specialties()->sync($randomSpecialties);
        }
    }
}