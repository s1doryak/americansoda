<?php

namespace App\Policies;

use App\CustomerInvoiceItem;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerInvoiceItem policy.
 *
 * @package App\Policies
 */
class CustomerInvoiceItemPolicy implements DatatablePolicyContract
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list of entities.
     *
     * @param Authenticatable $authenticatable
     *
     * @return boolean
     */
    public function index(Authenticatable $authenticatable)
    {
        return true;
    }

    /**
     * Determine whether the user can list of trashed entities.
     *
     * @param Authenticatable $authenticatable
     *
     * @return boolean
     */
    public function trashed(Authenticatable $authenticatable)
    {
        return true;
    }

    /**
     * Determine whether the user can view action column.
     *
     * @param Authenticatable $authenticatable
     *
     * @return boolean
     */
    public function export(Authenticatable $authenticatable)
    {

        return true;
    }

    /**
     * Determine whether the user can view action column.
     *
     * @param Authenticatable $authenticatable
     *
     * @return boolean
     */
    public function action(Authenticatable $authenticatable)
    {

        return true;
    }

    /**
     * Determine whether the user can view the entity.
     *
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceItem $customerInvoiceItem
     *
     * @return boolean
     */
    public function view(Authenticatable $authenticatable, CustomerInvoiceItem $customerInvoiceItem)
    {

        return false;
    }

    /**
     * Determine whether the user can create entity.
     *
     * @param Authenticatable $authenticatable
     *
     * @return boolean
     */
    public function create(Authenticatable $authenticatable)
    {

        return true;
    }

    /**
     * Determine whether the user can update the entity.
     *
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceItem $customerInvoiceItem
     *
     * @return boolean
     */
    public function update(Authenticatable $authenticatable, CustomerInvoiceItem $customerInvoiceItem)
    {

        return true;
    }

    /**
     * Determine whether the user can trash the entity.
     *
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceItem $customerInvoiceItem
     *
     * @return boolean
     */
    public function trash(Authenticatable $authenticatable, CustomerInvoiceItem $customerInvoiceItem)
    {

        return true;
    }

    /**
     * Determine whether the user can restore the entity.
     *
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceItem $customerInvoiceItem
     *
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerInvoiceItem $customerInvoiceItem)
    {

        return true;
    }

    /**
     * Determine whether the user can destroy the entity.
     *
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceItem $customerInvoiceItem
     *
     * @return boolean
     */
    public function destroy(Authenticatable $authenticatable, CustomerInvoiceItem $customerInvoiceItem)
    {

        return true;
    }
}
