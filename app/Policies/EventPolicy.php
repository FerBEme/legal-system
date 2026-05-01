<?php
namespace App\Policies;
use App\Models\Event;
use App\Models\User;
class EventPolicy {
    public function viewAny(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function view(User $user, Event $event): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->id;
            $isCreator   = $event->created_by === $user->id;
            $isSecretary = $user->secretaries()->where('id', $event->created_by)->exists();
            return $isOwnerCase || $isCreator || $isSecretary;
        }
        if($user->role === 'secretary'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->lawyer_id;
            $isCreator   = $event->created_by === $user->id;
            return $isOwnerCase || $isCreator;
        }
        return false;
    }
    public function create(User $user): bool {
        return in_array($user->role,['admin','lawyer','secretary']);
    }
    public function update(User $user, Event $event): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->id;
            $isCreator   = $event->created_by === $user->id;
            $isSecretary = $user->secretaries()->where('id', $event->created_by)->exists();
            return $isOwnerCase || $isCreator || $isSecretary;
        }
        if($user->role === 'secretary'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->lawyer_id;
            $isCreator   = $event->created_by === $user->id;
            $before24Hours = $event->created_at->isAfter(now()->subDay());
            return ($isOwnerCase || $isCreator) && $before24Hours;
        }
        return false;
    }
    public function delete(User $user, Event $event): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->id;
            $isCreator   = $event->created_by === $user->id;
            $isSecretary = $user->secretaries()->where('id', $event->created_by)->exists();
            return $isOwnerCase || $isCreator || $isSecretary;
        }
        if($user->role === 'secretary'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->lawyer_id;
            $isCreator   = $event->created_by === $user->id;
            $before24Hours = $event->created_at->isAfter(now()->subDay());
            return ($isOwnerCase || $isCreator) && $before24Hours;
        }
        return false;
    }
    public function restore(User $user, Event $event): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->id;
            $isCreator   = $event->created_by === $user->id;
            $isSecretary = $user->secretaries()->where('id', $event->created_by)->exists();
            return $isOwnerCase || $isCreator || $isSecretary;
        }
        if($user->role === 'secretary'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->lawyer_id;
            $isCreator   = $event->created_by === $user->id;
            $before24Hours = $event->created_at->isAfter(now()->subDay());
            return ($isOwnerCase || $isCreator) && $before24Hours;
        }
        return false;
    }
    public function forceDelete(User $user, Event $event): bool {
        if($user->role === 'admin')
            return true;
        if($user->role === 'lawyer'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->id;
            $isCreator   = $event->created_by === $user->id;
            $isSecretary = $user->secretaries()->where('id', $event->created_by)->exists();
            return $isOwnerCase || $isCreator || $isSecretary;
        }
        if($user->role === 'secretary'){
            $isOwnerCase = optional($event->numberCase)->lawyer_id === $user->lawyer_id;
            $isCreator   = $event->created_by === $user->id;
            $before24Hours = $event->created_at->isAfter(now()->subDay());
            return ($isOwnerCase || $isCreator) && $before24Hours;
        }
        return false;
    }
}