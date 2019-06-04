<?php

namespace App\Repositories\Contracts;

use Crmplease\MaterialAdmin\Repositories\RepositoryInterface as BaseRepository;

interface ProductGroupRepository extends BaseRepository {
	/**
	 * @param $id
	 * @return mixed
	 */
	public function getGroupsByCustomerId($id);
}