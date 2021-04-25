<?php

namespace App\Console\Commands\Resources;

use App\LtpMessage;
use App\Repositories\Contracts\LtpMessageRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * LtpMessage resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class LtpMessageCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:ltp_message';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'ltp_message';

    /**
     * @var string
     */
    protected $action = 'store';

    /**
     * @var array
     */
    protected $params = [];



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    LtpMessage $ltpMessage,
		LtpMessageRepository $ltpMessageRepository
	)
	{
	    $this->model = $ltpMessage;
		$this->repository = $ltpMessageRepository;

        parent::__construct();
	}
}
