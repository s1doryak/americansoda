<?php

namespace App\Listeners\Dashboard;

use App\CustomerOrderItem;
use App\CustomerShipment;
use App\Events\Dashboard\CustomerOrderItemsAssigned;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\AssemblyRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Collection;

class ManageShipmentsAndAssemblies
{
	use ValidatesResource;

	/** @var  AssemblyRepository */
	protected $assemblies;

	/**
	 * @var CustomerShipmentRepository
	 */
	protected $customerShipments;

	/**
	 * @var CustomerOrderRepository
	 */
	protected $customerOrders;

	/**
	 * @var CustomerOrderItem
	 */
	protected $customerOrderItems;

	public function __construct(
		AssemblyRepository $assemblyRepository,
		CustomerOrderRepository $customerOrderRepository,
		CustomerOrderItemRepository $customerOrderItemRepository,
		CustomerShipmentRepository $customerShipmentRepository
	)
	{
		$this->assemblies = $assemblyRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->customerOrderItems = $customerOrderItemRepository;
		$this->customerShipments = $customerShipmentRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param ResourceEventInterface $event
	 */
	public function handle(ResourceEventInterface $event)
	{
		if (!$this->isValidResource($event->getResource())) {
			return;
		}

		$attributes = $event->getAttributes();
		$params = $event->getParams();

		/** @var CustomerShipment $shipment */
		$shipment = $this->customerShipments->scopeQuery(
			function ($query) {
				return $query->withTrashed();
			}
		)->find($attributes['id']);

		/**
		 * Если отгрузка была удалена, то освобождаем все её позиции заказа
		 */
		if ($shipment->trashed()) {

			if ($shipment->customerOrderItems->count()) {

				$this->customerOrderItems->updateWhere(
					[
						['id', 'in', $shipment->customerOrderItems->pluck('id')],
					],
					[
						'customer_shipment_id' => null,
						'status' => config('stock.status.open'),
					]
				);

			}

			/**
			 * Если отгрузка не удалена, а была изменена
			 */
		} else {

			/**
			 * Если на странице отгрузки были удалены позиции заказа,
			 * то обнулим статус этих позиций.
			 */
			$items = collect(array_get($params, 'customerOrderItems', []));

			$_remove = $items->filter(
				function ($item) {
					return booleanize($item['_remove'] ?? false);
				}
			);

			if ($_remove->count()) {

				$this->customerOrderItems->updateWhere(
					[
						['id', 'in', $_remove->pluck('id')],
					],
					[
						'customer_shipment_id' => null,
						'status' => config('stock.status.open'),
					]
				);

			}

			/**
			 * Получим актуальные позиции заказа в отгрузке.
			 */
			$shipment->load('customerOrderItems');

			if (!$shipment->customerOrderItems->count()) {

				/**
				 * Если в отгрузке нет позиций, то удалим пустую отгрузку.
				 */
				$this->customerShipments->scopeQuery(
					function ($query) {
						return $query->withTrashed();
					}
				)->trash($attributes['id']);
			}

		}

		/**
		 * Найдем все отгрузки с таким же номером сборки.
		 * Если в них есть позиции заказов, то создадим для них сборку.
		 * Иначе удалим пустую сборку.
		 */
		if ($attributes['assembly_number'] != CustomerShipment::getDefaultAssemblyNumber()) {

			/** @var Collection|CustomerShipment[] $shipmentsByAssemblyNumber */
			$shipmentsByAssemblyNumber = $this->customerShipments->findWhere(
				[
					['assembly_number', '=', $attributes['assembly_number']],
				]
			);

			if ($shipmentsByAssemblyNumber->count()) {

				/** @var Collection|CustomerOrderItem[] $items */
				$items = $shipmentsByAssemblyNumber->pluck('customerOrderItems')->flatten();

				if ($items->count()) {
					$this->assemblies->firstOrCreate(
						[
							'number' => $attributes['assembly_number'],
						]
					);
				} else {
					$this->assemblies->destroyWhere(
						[
							['number', '=', $attributes['assembly_number']],
						]
					);
				}
			} else {
				$this->assemblies->destroyWhere(
					[
						['number', '=', $attributes['assembly_number']],
					]
				);
			}
		}

		/**
		 * Управление статусами
		 */
		if ($shipment->packageType && $shipment->packages_quantity && $shipment->hasValidAssemblyNumber()) {

			/**
			 * Установим статус позиций заказа к сборке, если указаны все данные (номер сборки, вид упаковки и кол-во тары)
			 */
			$this->customerOrderItems->updateWhere(
				[
					['id', 'in', $shipment->customerOrderItems->pluck('id')],
				],
				[
					'status' => config('stock.status.assembly'),
				]
			);

			/**
			 * Установим статус сборки
			 */
			$this->customerShipments->updateWhere(
				[
					['id', '=', $shipment->getKey()],
				],
				[
					'status' => config('stock.status.assembly'),
				]
			);

			/**
			 * Если установлен номер отгрузки (TRS), то установим соответствующий статус.
			 */
			if ($shipment->number) {

				/**
				 * Для позиций заказа
				 */
				$this->customerOrderItems->updateWhere(
					[
						['id', 'in', $shipment->customerOrderItems->pluck('id')],
					],
					[
						'status' => config('stock.status.shipment'),
					]
				);

				/**
				 * Для сборки
				 */
				$this->customerShipments->updateWhere(
					[
						['id', '=', $shipment->getKey()],
					],
					[
						'status' => config('stock.status.shipment'),
					]
				);

				/**
				 * Если установлен номер счета, то установим соответствующий статус.
				 */
				if ($shipment->invoice_number) {


					/**
					 * Для позиций заказа
					 */
					$this->customerOrderItems->updateWhere(
						[
							['id', 'in', $shipment->customerOrderItems->pluck('id')],
						],
						[
							'status' => config('stock.status.invoice'),
						]
					);

					/**
					 * Для сборки
					 */
					$this->customerShipments->updateWhere(
						[
							['id', '=', $shipment->getKey()],
						],
						[
							'status' => config('stock.status.invoice'),
						]
					);

				}

			}
		}

		/**
		 * Для каждого заказа обновим остатки на складе.
		 */
		$orderIds = $shipment->customerOrderItems->pluck('customerOrder.id')->unique();

		foreach ($orderIds as $orderId) {

			/** @var \App\CustomerOrder $order */
			$order = $this->customerOrders->scopeQuery(
				function ($query) {
					return $query->withTrashed();
				}
			)->find($orderId);

			$customerOrderItems = $this->customerOrderItems->with(
				['product', 'product.productGroup', 'customer', 'customerOrder']
			)->findAllByOrderId($orderId);

			$attributes = $order->getAttributes();

			$params = [];

			event(new CustomerOrderItemsAssigned($order, $customerOrderItems, $attributes, $params));
		}

	}

	/**
	 * @return array
	 */
	protected function getValidResources()
	{
		return [
			'customer.shipment',
			'customer_shipment',
		];
	}

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }
}
