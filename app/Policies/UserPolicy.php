<?php
namespace App\Policies;
use App\Models\User;
class UserPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer']);
    }
    public function view(User $user, User $model): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $user->id === $model->id || $user->id === $model->lawyer_id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer']);
    }
    public function update(User $user, User $model): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $user->id === $model->id || $user->id === $model->lawyer_id;
        return false;
    }
    public function delete(User $user, User $model): bool {
        if($user->role === 'admin')
            return $user->id !== $model->id;
        if($user->role === 'lawyer')
            return $user->id === $model->lawyer_id;
        return false;
    }
    public function restore(User $user, User $model): bool {
        if($user->role === 'admin')
            return $user->id !== $model->id;
        if($user->role === 'lawyer')
            return $user->id === $model->lawyer_id;
        return false;
    }
    public function forceDelete(User $user, User $model): bool {
        return $user->role === 'admin';
    }
}