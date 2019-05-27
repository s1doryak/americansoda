<?php

namespace App\Listeners\Dashboard;

use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\CustomerOrderRepository;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class FixCustomerOrderNumber
{
	use ValidatesResource;

	/**
	 * @var CustomerOrderRepository
	 */
	protected $customerOrders;

	/**
	 * FixCustomerOrderNumber constructor.
	 * @param CustomerOrderRepository $customerOrderRepository
	 */
	public function __construct(
		CustomerOrderRepository $customerOrderRepository
	)
	{
		$this->customerOrders = $customerOrderRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param ResourceEventInterface $event
	 *
	 * @return void
	 */
	public function handle(ResourceEventInterface $event)
	{

		if (!$this->isValidResource($event->getResource())) {
			return;
		}

		$attributes = $event->getAttributes();

		$order = $this->customerOrders->scopeQuery(
			function ($query) {
				/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\SoftDeletes $query */
				return $query->withTrashed();
			}
		)->find($attributes['id']);

		if ($order->trashed()) {
			return;
		}

		$this->customerOrders->update([
			'number' => $this->customerOrders->getFirstAvailableNumber($order->number, [$order->id])
		], $attributes['id']);
	}

	/**
	 * @return array
	 */
	protected function getParentResourceNames()
	{
		return [
			'customer.order',
			'customer_order',
		];
	}
}
