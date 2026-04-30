<?php
namespace App\Policies;
use App\Models\Folder;
use App\Models\User;
class FolderPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function view(User $user, Folder $folder): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $folder->numberCase?->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $folder->numberCase?->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function update(User $user, Folder $folder): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $folder->numberCase?->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $folder->numberCase?->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function delete(User $user, Folder $folder): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $folder->numberCase?->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $folder->numberCase?->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function restore(User $user, Folder $folder): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $folder->numberCase?->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $folder->numberCase?->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function forceDelete(User $user, Folder $folder): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $folder->numberCase?->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $folder->numberCase?->lawyer_id === $user->lawyer_id;
        return false;
    }
}