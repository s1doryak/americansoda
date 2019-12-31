<?php

namespace App\Console\Commands\Resources;

use App\Assembly;
use App\Repositories\Contracts\AssemblyRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Assembly resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class AssemblyCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:assembly';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'assembly';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    Assembly $assembly,
		AssemblyRepository $assemblyRepository
	)
	{
	    $this->model = $assembly;
		$this->repository = $assemblyRepository;

        parent::__construct();
	}

	/**
	 * @param Assembly $assembly
	 * @return array
	 */
	public function getEventAttributes($assembly)
	{
		return $assembly->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
