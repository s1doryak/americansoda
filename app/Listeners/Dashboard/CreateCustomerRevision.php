<?php

namespace App\Listeners\Dashboard;

use App\CustomerRevision;
use Crmplease\MaterialAdmin\Events\ResourceDestroyed;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\ResourceUpdated;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerRevisionRepository;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Contracts\Auth\Guard;

class CreateCustomerRevision
{
	use ValidatesResource;

	/**
	 * Customers.
	 *
	 * @var CustomerRepository
	 */
	private $customers;

	/**
	 * Customer revisions.
	 *
	 * @var CustomerRevisionRepository
	 */
	private $revisions;

	/**
	 * Create the event listener.
	 *
	 * @param Guard $auth
	 * @param CustomerRepository $customers
	 * @param CustomerRevisionRepository $revisions
	 */
	public function __construct(
		Guard $auth,
		CustomerRepository $customers,
		CustomerRevisionRepository $revisions
	)
	{
		$this->auth = $auth;
		$this->customers = $customers;
		$this->revisions = $revisions;
	}

	/**
	 * Handle the event.
	 *
	 * @param  ResourceEventInterface $event
	 * @return void
	 */
	public function handle(ResourceEventInterface $event)
	{
		if (!$this->isValidResource($event->getResource())) {
			return;
		}

		$attributes = $event->getAttributes();

		if (!isset($attributes['user_id'])) {
			$attributes['user_id'] = $this->auth->id();
		}

		$this->revisions->addRevision($this->getRevisionType($event, $attributes), $attributes);
	}

	/**
	 * Determine revision type based on event type.
	 *
	 * @param ResourceEventInterface $event
	 * @param array $attributes
	 *
	 * @return string
	 */
	private function getRevisionType(ResourceEventInterface $event, array $attributes)
	{
		if ($event instanceof ResourceStored) {
			return CustomerRevision::REV_CREATED;
		}

		if ($event instanceof ResourceUpdated) {
			$revision = $this->revisions->orderBy('id', 'desc')->first();

			if ($revision && $revision->comment !== $attributes['comment']) {
				return CustomerRevision::REV_COMMENTED;
			}

			return CustomerRevision::REV_EDITED;
		}

		if ($event instanceof ResourceDestroyed) {
			return CustomerRevision::REV_DESTROYED;
		}

		if ($event instanceof ResourceTrashed) {
			return CustomerRevision::REV_TRASHED;
		}

		return '';
	}

	/**
	 * @return array
	 */
	protected function getParentResourceNames()
	{
		return [
			'customer'
		];
	}
}