<?php
namespace App\Policies;
use App\Models\Specialty;
use App\Models\User;
class SpecialtyPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer']);
    }
    public function view(User $user, Specialty $specialty): bool {
        if($user->role === 'lawyer')
            return $user->specialties->contains('id', $specialty->id);
        if($user->role === 'admin')
            return true;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer']);
    }
    public function update(User $user, Specialty $specialty): bool {
        if($user->role === 'lawyer')
            return $user->specialties->contains('id', $specialty->id);
        if($user->role === 'admin')
            return true;
        return false;
    }
    public function delete(User $user, Specialty $specialty): bool {
        if($user->role === 'lawyer')
            return $user->specialties->contains('id', $specialty->id);
        if($user->role === 'admin')
            return true;
        return false;
    }
    public function restore(User $user, Specialty $specialty): bool {
        return $user->role === 'admin';
    }
    public function forceDelete(User $user, Specialty $specialty): bool {
        return $user->role === 'admin';
    }
}