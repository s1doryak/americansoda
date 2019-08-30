<?php

namespace App\Repositories\Contracts;
use Illuminate\Support\Collection;

interface CustomerRevisionRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
	/**
	 * Retrieve latest customer revisions.
	 *
	 * @param $customerId
	 *
	 * @return Collection
	 */
	public function getLatestRevisions($customerId);
}
