<?php

namespace App\DataTables\Dashboard;

use DB;
use Crmplease\MaterialAdmin\DataTables\DataTables;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerOrderItem;
use Illuminate\Support\Arr;

/**
 * CustomerOrderItem datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerOrderItemDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * Get engine {@see DataTable::ajax()}.
     *
     * @param \Crmplease\MaterialAdmin\DataTables\DataTables $dataTables
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return \Crmplease\MaterialAdmin\DataTables\EloquentDataTable
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        return parent::dataTable($dataTables, $query)
            ->orderColumn('customerOrder.number', 'SOUNDEX(customer_orders.number) $1, LENGTH(customer_orders.number) $1, customer_orders.number $1')
            ->orderColumn('customerOrder.batch_number', 'SOUNDEX(customer_orders.batch_number) $1, LENGTH(customer_orders.batch_number) $1, customer_orders.batch_number $1');
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'customerOrder.number' => [
                'data' => 'customerOrder.number',
                'name' => 'customerOrder.number',
                'searchable' => true,
                'footer' => 'Total:',
            ],
            'customerOrder.batch_number' => [
                'data' => 'customerOrder.batch_number',
                'name' => 'customerOrder.batch_number',
                'searchable' => true,
            ],
            'customer.name' => [
                'data' => 'customer.name',
                'name' => 'customer.name',
                'searchable' => true,
            ],
            'product.productGroup.name' => [
                'data' => 'product.productGroup.name',
                'name' => 'product.productGroup.name',
                'searchable' => true,
            ],
            'product.name' => [
                'data' => 'product.name',
                'name' => 'product.name',
                'searchable' => true,
            ],
            'status' => [
                'template' => 'dashboard::resources.customer_order_item.columns.status',
            ],
            'bypass' => [
                'template' => 'dashboard::resources.customer_order_item.columns.bypass',
            ],
            'back_order' => [
                'template' => 'dashboard::resources.customer_order_item.columns.back_order',
            ],
            'cancelled' => [
                'template' => 'dashboard::resources.customer_order_item.columns.cancelled',
            ],
            'sales_unit_quantity' => [
                'className' => 'column column-sales_unit_quantity text-center',
            ],
            'packages_quantity' => [
                'className' => 'column column-packages_quantity text-center',
            ],
            'products_quantity' => [
                'className' => 'column column-products_quantity text-center',
            ],

            'product_price' => [
                'className' => 'column column-product_price text-center',
            ],
            'product_vat_price' => [
                'className' => 'column column-product_vat_price text-center',
            ],
            'total_price' => [
                'className' => 'column column-total_price text-center',
            ],
            'total_vat_price' => [
                'className' => 'column column-total_vat_price text-center',
            ],
            'deposit_price' => [
                'className' => 'column column-deposit_price text-center',
            ],
            'deposit_vat_price' => [
                'className' => 'column column-deposit_vat_price text-center',
            ],
            'deposit_total_price' => [
                'className' => 'column column-deposit_total_price text-center',
            ],
            'deposit_total_vat_price' => [
                'className' => 'column column-deposit_total_vat_price text-center',
            ],

            'customerOrder.customer.payment_conditions' => [
                'data' => 'customerOrder.customer.payment_conditions',
                'name' => 'customerOrder.customer.payment_conditions',
            ],
            'customerOrder.customer.user.name' => [
                'data' => 'customerOrder.customer.user.name',
                'name' => 'customerOrder.customer.user.name',
            ],
            'customerShipment.number' => [
                'data' => 'customerShipment.number',
                'name' => 'customerShipment.number',
            ],
            'customerShipment.assembly_number' => [
                'data' => 'customerShipment.assembly_number',
                'name' => 'customerShipment.assembly_number',
                'template' => 'dashboard::resources.customer_order_item.columns.assembly_number',
            ],
            'customerShipment.delivery_month' => [
                'data' => 'customerShipment.delivery_month',
                'name' => 'customerShipment.delivery_month',
            ],
            'customerShipment.delivery_date' => [
                'data' => 'customerShipment.delivery_date',
                'name' => 'customerShipment.delivery_date',
            ],
            'customerShipment.invoice_number' => [
                'data' => 'customerShipment.invoice_number',
                'name' => 'customerShipment.invoice_number',
                'searchable' => true,
            ],
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    public function getRawColumns()
    {
        return [
            'customerOrder.number',
            'customerOrder.batch_number',
            'customer.name',
            'product.productGroup.name',
            'product.name',
            'status',
            'bypass',
            'back_order',
            'cancelled',
            'sales_unit_quantity',
            'packages_quantity',
            'products_quantity',
            'product_price',
            'product_vat_price',
            'total_price',
            'total_vat_price',
            'deposit_price',
            'deposit_vat_price',
            'deposit_total_price',
            'deposit_total_vat_price',
            'customerOrder.customer.payment_conditions',
            'customerOrder.customer.user.name',
            'customerShipment.number',
            'customerShipment.assembly_number',
            'customerShipment.delivery_month',
            'customerShipment.delivery_date',
            'customerShipment.invoice_number',
            'action',
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'sales_unit_quantity' => [
                'function' => 'sum',
                'format' => '%.01f',
            ],
            'packages_quantity' => [
                'function' => 'sum',
                'format' => '%d',
            ],
            'products_quantity' => [
                'function' => 'sum',
                'format' => '%d',
            ],
            'product_price' => [
                'function' => 'avg',
                'format' => '~%.02f',
            ],
            'product_vat_price' => [
                'function' => 'avg',
                'format' => '~%.02f',
            ],
            'deposit_price' => [
                'function' => 'avg',
                'format' => '~%.02f',
            ],
            'deposit_vat_price' => [
                'function' => 'avg',
                'format' => '~%.02f',
            ],
            'deposit_total_price',
            'deposit_total_vat_price',
            'total_price',
            'total_vat_price',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
            'customer.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'customer.id',
                'lists' => 'customer.name',
                'query' => function ($query, $filterColumn, $value) {
                    return is_array($value)
                        ? $query->whereIn($filterColumn, $value)
                        : $query->where($filterColumn, $value);
                }
            ],
            'customer.user.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'customer.user.id',
                'lists' => 'customer.user.name',
            ],
            'product.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'product.id',
                'lists' => 'product.name',
            ],
            'product.productGroup.name' => [
                'type' => 'select',
                'multiple' => true,
                'data' => 'product.productGroup.id',
                'lists' => 'product.productGroup.name',
            ],
            'customerOrder.number' => [
                'type' => 'daterangepicker',
                'name' => 'customerOrder.number',
                'items' => [],
                'query' => function ($query, $filterColumn, $value) {

                    /** @var \Illuminate\Support\Collection $dates */
                    $dates = collect(explode(' - ', $value));

                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereRaw(
                        DB::raw(sprintf("%s REGEXP 'SODA-[0-9]{8}.*'", $filterColumn))
                    )->whereRaw(
                        DB::raw(
                            sprintf(
                                "STR_TO_DATE(SUBSTRING(%s, 6, 8), '%s') BETWEEN STR_TO_DATE('%s', '%s') AND STR_TO_DATE('%s', '%s')",
                                $filterColumn,
                                '%Y%m%d',
                                $dates->first(),
                                '%d/%m/%Y',
                                $dates->last(),
                                '%d/%m/%Y'
                            )
                        )
                    );
                },
            ],
            'back_order' => [
                'type' => 'select',
                'multiple' => false,
                'name' => 'back_order',
                'items' => [
                    [
                        'key' => '',
                        'value' => 'Both',
                    ],
                    [
                        'key' => '1',
                        'value' => 'Backorders only',
                    ],
                    [
                        'key' => '0',
                        'value' => 'Non-Backorders only',
                    ],
                ],
            ],
            'customerShipmentAdvanced' => [
                'template' => 'dashboard::resources.customer_order_item.filters.shipment',
                'data' => 'customerShipment.number',
                'types' => [
                    [
                        'key' => 'trs',
                        'value' => 'TRS',
                    ],
                    [
                        'key' => 'svh',
                        'value' => 'SVH',
                    ],
                    [
                        'key' => 'post',
                        'value' => 'POSTI',
                    ],
                    [
                        'key' => 'post-pkt',
                        'value' => 'POSTI PKT',
                    ],
                ],
                'months' => [
                    [
                        'key' => '01',
                        'value' => 'January',
                    ],
                    [
                        'key' => '02',
                        'value' => 'February',
                    ],
                    [
                        'key' => '03',
                        'value' => 'March',
                    ],
                    [
                        'key' => '04',
                        'value' => 'April',
                    ],
                    [
                        'key' => '05',
                        'value' => 'May',
                    ],
                    [
                        'key' => '06',
                        'value' => 'June',
                    ],
                    [
                        'key' => '07',
                        'value' => 'July',
                    ],
                    [
                        'key' => '08',
                        'value' => 'August',
                    ],
                    [
                        'key' => '09',
                        'value' => 'September',
                    ],
                    [
                        'key' => '10',
                        'value' => 'October',
                    ],
                    [
                        'key' => '11',
                        'value' => 'November',
                    ],
                    [
                        'key' => '12',
                        'value' => 'December',
                    ],
                ],
                'query' => function ($query, $filterColumn, $value) {

                    $value = Arr::wrap($value);

                    $typePatterns = [
                        'trs' => '[0-9]{4}-TRS-[0-9]{4}',
                        'svh' => '[0-9]{4}-TRS-SVH-[0-9]{4}',
                        'post' => '[0-9]{4}-TRS-POSTI-[0-9]{4}',
                        'post-pkt' => '[0-9]{4}-TRS-POSTI-PKT-[0-9]{4}',
                    ];

                    $monthPattern = '%02d[0-9]{2}';

                    $types = (array)Arr::get($value, 'types');
                    $months = (array)Arr::get($value, 'months');

                    $typeRegExp = collect($types)->map(
                        function ($type) use ($typePatterns) {
                            return Arr::get($typePatterns, $type);
                        }
                    )->filter()->implode('|');

                    $monthRegExp = collect($months)->map(
                        function ($month) use ($monthPattern) {
                            return (int)$month ? sprintf($monthPattern, (int)$month) : null;
                        }
                    )->filter()->implode('|');

                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    $query->whereRaw(
                        DB::raw(sprintf("%s REGEXP '^(%s)$'", $filterColumn, $typeRegExp))
                    );

                    if ($monthRegExp) {
                        $query->whereRaw(
                            DB::raw(sprintf("%s REGEXP '%s$'", $filterColumn, $monthRegExp))
                        );
                    }
                },
            ],
            'bypass' => [
                'type' => 'select',
                'multiple' => false,
                'items' => [
                    [
                        'key' => '',
                        'value' => 'Both',
                    ],
                    [
                        'key' => '1',
                        'value' => 'Bypass only',
                    ],
                    [
                        'key' => '0',
                        'value' => 'Non-bypass only',
                    ],
                ],
            ],
            'status' => [
                'type' => 'select',
                'multiple' => false,
                'items' => [
                    [
                        'key' => '',
                        'value' => 'Any',
                    ],
                    [
                        'key' => 'open',
                        'value' => 'Open',
                    ],
                    [
                        'key' => 'assembly',
                        'value' => 'Assembly',
                    ],
                    [
                        'key' => 'shipment',
                        'value' => 'Shipment',
                    ],
                    [
                        'key' => 'invoice',
                        'value' => 'Invoice',
                    ],
                ],
            ],
            'cancelled' => [
                'type' => 'select',
                'multiple' => false,
                'items' => [
                    [
                        'key' => '',
                        'value' => 'Both',
                    ],
                    [
                        'key' => '1',
                        'value' => 'Cancelled only',
                    ],
                    [
                        'key' => '0',
                        'value' => 'Non-cancelled only',
                    ],
                ],
            ],
            'customerShipment.assembly_number' => [
                'type' => 'text',
                'name' => 'customerShipment.assembly_number',
                'lists' => 'customerShipment.assembly_number',
                'items' => [],
            ],
            'customerShipment.invoice_number' => [
                'type' => 'text',
                'name' => 'customerShipment.invoice_number',
                'lists' => 'customerShipment.invoice_number',
                'items' => [],
            ],
            'customerShipment.number' => [
                'type' => 'text',
                'name' => 'customerShipment.number',
                'data' => 'customerShipment.number',
                'items' => [],
            ],

        ];
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return array
     */
    protected function getActions($customerOrderItem)
    {
        return parent::getActions($customerOrderItem);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerShipment__DeliveryMonthColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerShipment->delivery_month ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerShipment->delivery_month ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerShipment__NumberColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerShipment->number ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerShipment->number ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerShipment__DeliveryDateColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerShipment->delivery_date ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerShipment->delivery_date ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerShipment__InvoiceNumberColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerShipment->invoice_number ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerShipment->invoice_number ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerOrder__NumberColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerOrder->number ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerOrder->number ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerOrder__BatchNumberColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerOrder->batch_number ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerOrder->batch_number ?? null;
    }


    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomer__NameColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customer->name ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customer->name ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderProduct__ProductGroup__NameColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->product->productGroup->name ?? $this->renderDefaultView();
        }

        return $customerOrderItem->product->productGroup->name ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderProduct__NameColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->product->name ?? $this->renderDefaultView();
        }

        return $customerOrderItem->product->name ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerOrder__Customer__PaymentConditionsColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerOrder->customer->payment_conditions ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerOrder->customer->payment_conditions ?? null;
    }

    /**
     * @param CustomerOrderItem $customerOrderItem
     * @return string
     */
    protected function renderCustomerOrder__Customer__User__NameColumn($customerOrderItem)
    {
        if ($this->isDataTableRequest()) {
            return $customerOrderItem->customerOrder->customer->user->name ?? $this->renderDefaultView();
        }

        return $customerOrderItem->customerOrder->customer->user->name ?? null;
    }
}
