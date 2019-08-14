<?php

namespace App\Console\Commands\Resources;

use App\CompanyBankAccount;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CompanyRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CompanyBankAccount resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CompanyBankAccountCreator extends ResourceCreator
{
    protected $name = 'resource:create:company_bank_account';


	/**
	 * @var CompanyRepository
	 */
	protected $companies;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'companies' => 'name',
	];

	public function __construct(
	    CompanyBankAccount $companyBankAccount,
		CompanyBankAccountRepository $companyBankAccountRepository,
		CompanyRepository $companyRepository
	)
	{
	    $this->resource = $companyBankAccount;
		$this->repository = $companyBankAccountRepository;
		$this->companies = $companyRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'company_bank_account';
	}

	/**
	 * @param CompanyBankAccount $company_bank_account
	 * @return array
	 */
	public function getEventAttributes($company_bank_account)
	{
		return $company_bank_account->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
