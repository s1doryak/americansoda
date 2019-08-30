<?php

namespace App\Repositories\Eloquent;

use App\CustomerPricingPolicyRevision;
use App\Repositories\Contracts\CustomerPricingPolicyRevisionRepository;
use Carbon\Carbon;

class CustomerPricingPolicyRevisionRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPricingPolicyRevisionRepository
{
	/**
	 * @param $customerId
	 * @return mixed
	 */
	public function getLatestRevisions($customerId)
	{
		return $this->model
			->withTrashed()
			->where('customer_id', $customerId)
			->orderBy('id')
			->get();
	}

	/**
	 * Create new revision.
	 *
	 * @param array $attributes
	 * @param int $editorId
	 * @param string $type
	 *
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @throws \Prettus\Validator\Exceptions\ValidatorException
	 */
	public function addRevision(array $attributes, $editorId, $type = null)
	{
		array_forget($attributes, [
			'index',
			'created',
			'updated',
			'created_date',
			'updated_date'
		]);

		$trashed = array_pull($attributes, 'trashed', false);
		$attrs = array_merge($attributes, [
			'editor_id' => $editorId,
			'customer_pricing_policy_id' => $attributes['id']
		]);

		$where = array_except($attrs, [
			'customer',
			'region',
			'customer_type',
			'payment_type',
			'user',
			'editor',
			'product_group',
		]);

		$existing = $this->firstWhere($where);

		if (!$existing || $trashed === true) {
			if ($type) {
				$attrs['revision_type'] = $type;
			} else {
				if ($trashed === true) {
					$attrs['deleted_at'] = Carbon::now();
					$attrs['revision_type'] = CustomerPricingPolicyRevision::REV_TRASHED;
				} else {
					$attrs['revision_type'] = CustomerPricingPolicyRevision::REV_EDITED;
				}
			}

			$latest = $this->lastWhere(['customer_pricing_policy_id' => $attributes['id']]);
			$attrs['revision_number'] = 0;

			if ($latest) {
				$attrs['revision_number'] = $latest->revision_number + 1;
				$attrs['revision_id'] = $latest->id;
			}

			$this->create($attrs);
		}
	}
}
