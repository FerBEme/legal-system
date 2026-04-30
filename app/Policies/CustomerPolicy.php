<?php
namespace App\Policies;
use App\Models\Customer;
use App\Models\User;
class CustomerPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function view(User $user, Customer $customer): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function update(User $user, Customer $customer): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function delete(User $user, Customer $customer): bool {
        return in_array($user->role,['admin','lawyer']);
    }
    public function restore(User $user, Customer $customer): bool {
        return in_array($user->role,['admin','lawyer']);
    }
    public function forceDelete(User $user, Customer $customer): bool {
        return in_array($user->role,['admin']);
    }
}