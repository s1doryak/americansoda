<?php

namespace App\Console\Commands;

use App\Assembly;
use App\Repositories\Contracts\AssemblyRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Assembly resource creator.
 *
 * @package App\Console\Commands
 */
class AssemblyCreator extends ResourceCreator
{
    protected $name = 'resource:create:assembly';



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
	    $this->resource = $assembly;
		$this->repository = $assemblyRepository;

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
		return 'assembly';
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