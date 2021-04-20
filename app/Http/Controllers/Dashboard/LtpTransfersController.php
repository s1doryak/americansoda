<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\LtpTransferRepository;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * LtpTransfer controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class LtpTransfersController extends ResourceController
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
    protected $resource = 'ltp_transfer';

    /**
     * @var array
     */
    protected $with = [
        'items',
    ];

    /**
     * @var array
     */
    protected $editActionFormData = [

    ];

    /**
     * @var array
     */
    protected $popupActions = [
//        'create' => 'fullscreen',
//        'edit' => 'fullscreen'
    ];

    public function __construct(
        Gate $gate,
        LtpTransferRepository $ltpTransferRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $ltpTransferRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
        parent::__construct();
    }
}
