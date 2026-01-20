<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FieldType;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FieldType');
    }

    public function view(AuthUser $authUser, FieldType $fieldType): bool
    {
        return $authUser->can('View:FieldType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FieldType');
    }

    public function update(AuthUser $authUser, FieldType $fieldType): bool
    {
        return $authUser->can('Update:FieldType');
    }

    public function delete(AuthUser $authUser, FieldType $fieldType): bool
    {
        return $authUser->can('Delete:FieldType');
    }

    public function restore(AuthUser $authUser, FieldType $fieldType): bool
    {
        return $authUser->can('Restore:FieldType');
    }

    public function forceDelete(AuthUser $authUser, FieldType $fieldType): bool
    {
        return $authUser->can('ForceDelete:FieldType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FieldType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FieldType');
    }

    public function replicate(AuthUser $authUser, FieldType $fieldType): bool
    {
        return $authUser->can('Replicate:FieldType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FieldType');
    }

}