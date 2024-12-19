<?php

namespace App\Policies;

use App\Models\Approval;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApprovalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // Jika user adalah admin, izinkan akses ke semua Approval
        if ($user->hasRole('Super Admin')) {
            return Response::allow();
        }

        // Jika bukan admin, hanya izinkan melihat Approval yang approver_id-nya sesuai dengan user yang login
        return Approval::where('approver_id', $user->id)->exists()
            ? Response::allow()
            : Response::deny('You do not have permission to view this approval.');
    }



    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Approval $approval)
    {
                // Jika user adalah Admin atau Super Admin, mereka bisa melihat semua data
                if ($user->hasRole('Admin') || $user->hasRole('Super Admin')) {
                    return Response::allow();
                }

                // Jika user bukan Admin/Super Admin, hanya dapat melihat data dengan approver_id yang sama dengan ID pengguna
                return Approval::where('approver_id', $user->id)->exists()
                    ? Response::allow()
                    : Response::deny('You do not have permission to view this approval.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasRole('Super Admin')
        ? Response::allow()
        : Response::deny('You do not have permission to view this approval.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Approval $approval)
    {
        return $user->hasRole('Super Admin') || $user->id === $approval->approver_id
        ? Response::allow()
        : Response::deny('You do not have permission to update this approval.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Approval $approval)
    {
        return $user->hasRole('Admin') || $user->hasRole('Super Admin')
        ? Response::allow()
        : Response::deny('You do not have permission to view this approval.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Approval $approval)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Approval $approval)
    {
        //
    }
}
