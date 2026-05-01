<?php
namespace App\Policies;
use App\Models\File;
use App\Models\User;
class FilePolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function view(User $user, File $file): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $file->folder->numberCase->lawyer_id === $user->id;
        if($user->role === 'secretary')
            return $file->folder->numberCase->lawyer_id === $user->lawyer_id;
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function update(User $user, File $file): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $file->folder->numberCase->lawyer_id === $user->id;
        if($user->role === 'secretary'){
            $belongsToLawyer = $file->folder->numberCase->lawyer_id === $user->lawyer_id;
            $isOwner = $file->uploaded_by === $user->id;
            $before24Hours = $file->created_at->gte(now()->subHour(24));
            return $belongsToLawyer && $isOwner && $before24Hours;
        }
        return false;
    }
    public function delete(User $user, File $file): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $file->folder->numberCase->lawyer_id === $user->id;
        if($user->role === 'secretary'){
            $belongsToLawyer = $file->folder->numberCase->lawyer_id === $user->lawyer_id;
            $isOwner = $file->uploaded_by === $user->id;
            $before24Hours = $file->created_at->gte(now()->subHour(24));
            return $belongsToLawyer && $isOwner && $before24Hours;
        }
        return false;
    }
    public function restore(User $user, File $file): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $file->folder->numberCase->lawyer_id === $user->id;
        if($user->role === 'secretary'){
            $belongsToLawyer = $file->folder->numberCase->lawyer_id === $user->lawyer_id;
            $isOwner = $file->uploaded_by === $user->id;
            $before24Hours = $file->created_at->gte(now()->subHour(24));
            return $belongsToLawyer && $isOwner && $before24Hours;
        }
        return false;
    }
    public function forceDelete(User $user, File $file): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer')
            return $file->folder->numberCase->lawyer_id === $user->id;
        if($user->role === 'secretary'){
            $belongsToLawyer = $file->folder->numberCase->lawyer_id === $user->lawyer_id;
            $isOwner = $file->uploaded_by === $user->id;
            $before24Hours = $file->created_at->gte(now()->subHour(24));
            return $belongsToLawyer && $isOwner && $before24Hours;
        }
        return false;
    }
}