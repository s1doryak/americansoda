<?php

namespace App\Repositories\Eloquent;

use Auth;
use App\Repositories\Contracts\CustomerPricingPolicyRevisionRepository;
use App\Repositories\Contracts\CustomerRevisionRepository;
use Illuminate\Support\Collection;

class CustomerRevisionRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerRevisionRepository {
	/**
	 * Retrieve latest customer revisions.
	 *
	 * @param $customerId
	 *
	 * @return Collection
	 */
	public function getLatestRevisions($customerId)
	{
		$revisions = $this->getRevisionsByCustomerId($customerId);
		$revisions = $this->groupRevisionsByEntityType($revisions)->all();

		krsort($revisions);

		return new Collection($revisions);
	}

	/**
	 * Find revisions by customer ID and group them by creation date.
	 *
	 * @param int $customerId
	 *
	 * @return Collection
	 */
	private function getRevisionsByCustomerId($customerId)
	{
		/** @var Collection $policies */
		$policies = app(CustomerPricingPolicyRevisionRepository::class)
			->getLatestRevisions($customerId);

		/** @var Collection $customers */
		$customers = $this->model
			->withTrashed()
			->where('customer_id', $customerId)
			->orderBy('id')
			->get();

		return $policies->add($customers)
			->flatten()
			->groupBy(function ($revision) {
				return (string)$revision->created_at;
			});
	}

	/**
	 * Group all revisions by entity type.
	 *
	 * @param Collection $collection
	 *
	 * @return Collection
	 */
	private function groupRevisionsByEntityType(Collection $collection)
	{
		$all = new Collection;

		$collection->each(function (Collection $revisions, $datetime) use ($all) {
			$grouped = [
				'policies' => [],
				'customers' => []
			];

			foreach ($revisions as $revision) {
				$key = ($revision instanceof \App\CustomerRevision ? 'customers' : 'policies');

				$grouped[$key][] = $revision;
			}

			$all->put($datetime, $grouped);
		});

		return $all;
	}

	/**
	 * Create new revision.
	 *
	 * @param string $type
	 * @param array $attributes
	 *
	 * @return mixed
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @throws \Prettus\Validator\Exceptions\ValidatorException
	 */
	public function addRevision($type, array $attributes)
	{
		$id = array_pull($attributes, 'id');
		$attributes = array_merge($attributes, [
			'editor_id' => $this->obtainEditorId($attributes),
			'customer_id' => $id
		]);

		$where = array_except($attributes, ['created_at', 'updated_at', 'deleted_at']);

		if (!$this->firstWhere($where)) {
			$latest = $this->lastWhere(['customer_id' => $id]);

			if ($latest) {
				$attributes['revision_id'] = $latest->id;
			}

			$attributes['revision_type'] = $type;

			$this->create($attributes);
		}
	}

	/**
	 * @param array $attributes
	 *
	 * @return mixed
	 */
	private function obtainEditorId(array $attributes)
	{
		return Auth::user() ? Auth::user()->getAuthIdentifier() : $attributes['user_id'];
	}
}
