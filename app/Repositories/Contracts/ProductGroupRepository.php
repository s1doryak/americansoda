<?php

namespace App\Repositories\Contracts;

interface ProductGroupRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface {
	/**
	 * @param $id
	 * @return mixed
	 */
	public function getGroupsByCustomerId($id);
}
