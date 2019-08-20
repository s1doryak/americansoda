<?php

namespace App\Policies;

use App\CustomerInvoiceAttachment;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CustomerInvoiceAttachment policy.
 *
 * @package App\Policies
 */
class CustomerInvoiceAttachmentPolicy implements DatatablePolicyContract
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
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function action(Authenticatable $authenticatable)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerInvoiceAttachment $customerInvoiceAttachment
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CustomerInvoiceAttachment $customerInvoiceAttachment)
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
	 * @param CustomerInvoiceAttachment $customerInvoiceAttachment
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CustomerInvoiceAttachment $customerInvoiceAttachment)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CustomerInvoiceAttachment $customerInvoiceAttachment
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CustomerInvoiceAttachment $customerInvoiceAttachment)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param CustomerInvoiceAttachment $customerInvoiceAttachment
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CustomerInvoiceAttachment $customerInvoiceAttachment)
    {

        return true;
    }
}
