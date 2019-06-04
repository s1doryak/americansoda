<?php

namespace App\Repositories\Contracts;

use Crmplease\MaterialAdmin\Repositories\RepositoryInterface as BaseRepository;
use Illuminate\Support\Collection;

interface CustomerRevisionRepository extends BaseRepository
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