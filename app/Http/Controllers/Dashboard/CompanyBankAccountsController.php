<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CompanyRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CompanyBankAccount controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CompanyBankAccountsController extends ResourceController
{
	use DashboardSidebar;

	/**
	 * @var Gate
	 */
	protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'company_bank_account';

	
	/**
	 * @var CompanyRepository
	 */
	protected $companies;

    /**
     * @var array
     */
	protected $editActionFormData = [
		'companies' => 'name',
	];

    /**
     * CompanyBankAccountsController constructor.
     * @param Gate $gate
	 * @param CompanyBankAccountRepository $companyBankAccountRepository
	 * @param CompanyRepository $companyRepository
     */
	public function __construct(
	    Gate $gate,
		CompanyBankAccountRepository $companyBankAccountRepository,
		CompanyRepository $companyRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $companyBankAccountRepository;
		$this->companies = $companyRepository;

		$this->middleware('auth:dashboard');
		$this->shareSidebar();
	}
}
