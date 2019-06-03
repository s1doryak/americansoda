<?php

namespace App\Policies;

use App\CompanyBankAccount;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * CompanyBankAccount policy.
 *
 * @package App\Policies
 */
class CompanyBankAccountPolicy implements DatatablePolicyContract
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
	 * @param CompanyBankAccount $companyBankAccount
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, CompanyBankAccount $companyBankAccount)
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
	 * @param CompanyBankAccount $companyBankAccount
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, CompanyBankAccount $companyBankAccount)
	{

		return true;
	}

	/**
	 * @param Authenticatable $authenticatable
	 * @param CompanyBankAccount $companyBankAccount
	 * @return boolean
	 */
	public function delete(Authenticatable $authenticatable, CompanyBankAccount $companyBankAccount)
	{

		return true;
	}

    /**
     * @param Authenticatable $authenticatable
     * @param CompanyBankAccount $companyBankAccount
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, CompanyBankAccount $companyBankAccount)
    {

        return true;
    }
}
