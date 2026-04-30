<?php
namespace App\Providers;
use App\Models\Customer;
use App\Models\Specialty;
use App\Models\User;
use App\Policies\CustomerPolicy;
use App\Policies\SpecialtyPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }
    public function boot(): void {
        //
    }
    protected array $policies = [
        User::class => UserPolicy::class,
        Specialty::class => SpecialtyPolicy::class,
        Customer::class => CustomerPolicy::class,
    ];
}