<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\SettingDataTable;
use App\Repositories\Contracts\SettingRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Setting controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class SettingsController extends \Crmplease\MaterialAdmin\Routing\ResourceController
{
	/**
	 * @var Gate
	 */
	protected $gate;

    /**
     * @var string
     */
	protected $defaultMiddleware = 'auth:dashboard';

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'setting';

    /**
     * @var string
     */
    protected $dataTable = SettingDataTable::class;

    /**
     * @var string
     */
    protected $translationPrefix = 'models/';

    /**
     * @var array
     */
    protected $with = [

    ];



	/**
	 * Popup windows. @see getPopupActions()
	 *
	 * Example:
	 *
	 *  'create',
	 *  'edit',
	 *
	 * or size specific:
	 *
	 *  'create' => 'large',
	 *  'edit' => 'fullscreen',
	 *
	 * or advanced configuration:
	 *
	 *  'create' => [
	 *      'resource' => 'user',
	 *      'title' => 'Custom Title',
	 *      'class' => 'modal-lg',
	 *  ],
	 *  'edit' => [
	 *      'resource' => 'user',
	 *      'title' => 'Custom Title',
	 *      'class' => 'modal-fluid',
	 *  ],
	 *
	 */
	protected $popupActions = [

	];

	/**
	 * Array describing additional data for the HTML 'create' form.
	 *
	 * Example:
	 *
	 * 'customer_orders' => [
	 *     'repository' => 'orders',
	 *     'lists' => 'number', // or 'lists' => ['number', 'id']
	 *     'selected' => 'order' // or 'selected' => ['order, 'id']
	 * ],
	 * 'employees' => [
	 *     'repository' => 'employees',
	 *     'lists' => 'name',
	 *     'selected' => 'employee'
	 * ]
	 *
	 * @var array
	 * @see mapFormDataConfigToAction()
	 */
	protected $createActionFormData = [

	];

	/**
	 * Array describing additional data for the HTML 'edit' form.
	 *
	 * @var array
	 */
	protected $editActionFormData = [

	];

	/**
	 * Custom editing actions. @see getEditingActions()
	 *
	 * @var array
	 */
	protected $editingActions = [

	];

	/**
	 * Custom editing actions. @see getPersistingActions()
	 *
	 * @var array
	 */
	protected $persistingActions = [

	];

	/**
	 * Additional view response data.
	 *
	 * @var array
	 */
	protected $defaultViewData = [

	];

    /**
     * SettingsController constructor.
     * @param Gate $gate
	 * @param SettingRepository $settingRepository
     * @return void
     */
	public function __construct(
	    Gate $gate,
		SettingRepository $settingRepository
	)
	{
	    parent::__construct();

	    $this->gate = $gate;
		$this->repository = $settingRepository;
	}
}
