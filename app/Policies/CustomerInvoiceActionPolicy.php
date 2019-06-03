<?php

namespace App\Policies;

use App\CustomerInvoiceAction;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerInvoiceAction policy.
 *
 * @package App\Policies
 */
class CustomerInvoiceActionPolicy implements DatatablePolicyContract
{
	use HandlesAuthorization;

	/**
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function index(Authenticatable $authenticatable)
	{
		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function action(Authenticatable $authenticatable)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerInvoiceAction $customerInvoiceAction
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CustomerInvoiceAction $customerInvoiceAction)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function create(Authenticatable $authenticatable)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerInvoiceAction $customerInvoiceAction
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CustomerInvoiceAction $customerInvoiceAction)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerInvoiceAction $customerInvoiceAction
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CustomerInvoiceAction $customerInvoiceAction)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceAction $customerInvoiceAction
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerInvoiceAction $customerInvoiceAction)
    {

        return true;
    }
}
