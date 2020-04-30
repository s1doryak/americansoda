<?php

namespace App\Policies;

use App\StockProduct;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * StockProduct policy.
 *
 * @payment App\Policies
 */
class StockProductPolicy implements DatatablePolicyContract
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

        return false;
    }

    /**
     * Determine whether the user can view the entity.
     *
     * @param Authenticatable $authenticatable
     * @param StockProduct $stockProduct
     *
     * @return boolean
     */
    public function view(Authenticatable $authenticatable, StockProduct $stockProduct)
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
     * @param StockProduct $stockProduct
     *
     * @return boolean
     */
    public function update(Authenticatable $authenticatable, StockProduct $stockProduct)
    {

        return true;
    }

    /**
     * Determine whether the user can trash the entity.
     *
     * @param Authenticatable $authenticatable
     * @param StockProduct $stockProduct
     *
     * @return boolean
     */
    public function trash(Authenticatable $authenticatable, StockProduct $stockProduct)
    {

        return true;
    }

    /**
     * Determine whether the user can restore the entity.
     *
     * @param Authenticatable $authenticatable
     * @param StockProduct $stockProduct
     *
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, StockProduct $stockProduct)
    {

        return true;
    }

    /**
     * Determine whether the user can destroy the entity.
     *
     * @param Authenticatable $authenticatable
     * @param StockProduct $stockProduct
     *
     * @return boolean
     */
    public function destroy(Authenticatable $authenticatable, StockProduct $stockProduct)
    {

        return true;
    }
}
