<?php
namespace App\Providers;
use App\Models\CaseModel;
use App\Models\Customer;
use App\Models\File;
use App\Models\Folder;
use App\Models\Specialty;
use App\Models\User;
use App\Policies\CaseModelPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\FilePolicy;
use App\Policies\FolderPolicy;
use App\Policies\SpecialtyPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }
    public function boot(): void {
        $this->registerPolicies();
    }    
    protected $policies = [
        User::class => UserPolicy::class,
        Specialty::class => SpecialtyPolicy::class,
        Customer::class => CustomerPolicy::class,
        CaseModel::class => CaseModelPolicy::class,
        Folder::class => FolderPolicy::class,
        File::class => FilePolicy::class,
    ];
}