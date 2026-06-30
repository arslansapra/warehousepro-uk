<?php

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PurchaseOrderPolicy
{
        /**
     * Only Admin + Warehouse Manager can approve
     */
    public function approve(User $user, PurchaseOrder $po): bool
    {
        return in_array($user->role->slug, [
            'admin',
            'warehouse_manager',
        ]);
    }

    /**
     * Only Admin + Warehouse Manager can receive
     */
    public function receive(User $user, PurchaseOrder $po): bool
    {
        return in_array($user->role->slug, [
            'admin',
            'warehouse_manager',
        ]);
    }

    /**
     * Only Admin can cancel OR manager before receiving
     */
    public function cancel(User $user, PurchaseOrder $po): bool
    {
        return $user->role->slug === 'admin'
            || ($user->role->slug === 'warehouse_manager' && $po->status !== 'received');
    }
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return false;
    }
}
