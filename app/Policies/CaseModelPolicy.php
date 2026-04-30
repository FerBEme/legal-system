<?php
namespace App\Policies;
use App\Models\CaseModel;
use App\Models\User;
class CaseModelPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function view(User $user, CaseModel $case): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $case->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function update(User $user, CaseModel $case): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $case->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function delete(User $user, CaseModel $case): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $case->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function restore(User $user, CaseModel $case): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $case->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $case->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function forceDelete(User $user, CaseModel $case): bool {
        return in_array($user->role,['admin']);
    }
}
