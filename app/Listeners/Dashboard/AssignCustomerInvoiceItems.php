<?php

namespace App\Listeners\Dashboard;

use App\CustomerInvoice;
use App\CustomerInvoiceItem;
use App\CustomerOrderItem;
use App\Events\Dashboard\CustomerInvoiceItemsAssigned;
use App\Product;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\ResourceDestroyed;
use Crmplease\MaterialAdmin\Events\ResourceRestored;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * AssignCustomerInvoiceItems listener.
 *
 * @package App\Listeners\Dashboard
 */
class AssignCustomerInvoiceItems
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerInvoiceRepository
     */
    protected $customerInvoices;

    /**
     * @var CustomerInvoiceItemRepository
     */
    protected $customerInvoiceItems;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $customerOrderItems;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * AssignCustomerInvoiceItems constructor.
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     * @param CustomerInvoiceItemRepository $customerInvoiceItemRepository
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        CustomerInvoiceRepository $customerInvoiceRepository,
        CustomerInvoiceItemRepository $customerInvoiceItemRepository,
        CustomerOrderItemRepository $customerOrderItemRepository,
        ProductRepository $productRepository
    )
    {
        $this->customerInvoices = $customerInvoiceRepository;
        $this->customerInvoiceItems = $customerInvoiceItemRepository;
        $this->customerOrderItems = $customerOrderItemRepository;
        $this->products = $productRepository;
    }

    /**
     * @param ResourceEventInterface $e
     * @return void
     */
    public function handle(ResourceEventInterface $e)
    {
        if (!$this->isValidNamespace($e->getNamespace())) {
            return;
        }

        if (!$this->isValidResource($e->getResource())) {
            return;
        }

        $attributes = $e->getAttributes();
        $params = $e->getParams();

        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $this->customerInvoices->scopeQuery(
            function ($query) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                return $query->withTrashed();
            }
        )->find($attributes['id']);

        if ($e instanceof ResourceTrashed) {

            // ...
        }

        if ($e instanceof ResourceDestroyed) {

            // ...
        }

        if ($e instanceof ResourceRestored) {

            // ...
        }

        if ($e instanceof ResourceStored) {

            // ...
        }

        $items = Arr::get($params, 'customerInvoiceItems', []);

        $customerInvoiceItems = new Collection();
        $idx = 0;

        foreach ($items as $item) {
            $idx++;
            $id = numerize($item['id'] ?? false);
            $removing = booleanize($item['_remove'] ?? false);

            if ($removing) {

                if ($id) {
                    $this->customerInvoiceItems->destroy($item['id']);
                }

                continue;
            }

            $customerOrderItemId = $item['customerOrderItem'] ?? false;
            $productId = $item['product'] ?? false;

            /** @var CustomerOrderItem|null $customerOrderItem */
            $customerOrderItem = $customerOrderItemId ? $this->customerOrderItems->with(['product'])->find($customerOrderItemId) : null;

            /** @var Product|null $customerOrderItem */
            $product = $productId
                ? $this->products->scopeQuery(
                    function ($query) {
                        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                        return $query->withTrashed();
                    }
                )->find($productId)
                : null;

            if ($customerOrderItem) {
                $item_code = $customerOrderItem->product->product_barcode_plaintext;
                $subject = $customerOrderItem->product->name;
                $definition = $customerOrderItem->product->description;
                $price = $customerOrderItem->product_price;
                $unit_type = $customerOrderItem->product->unit_type;
                $amount = $customerOrderItem->products_quantity;
                $sum = $customerOrderItem->total_price;
                $tax = $customerOrderItem->vat;
                $sum_tax = $customerOrderItem->total_vat_price;

                $productId = $customerOrderItem->product->getKey();
                $customerOrderItemId = $customerOrderItem->getKey();
            } else {
                $item_code = '';
                $subject = $item['subject'];
                $definition = $item['definition'];
                $price = floatize($item['price']);
                $unit_type = $item['unit_type'];
                $amount = numerize($item['amount']);
                $sum = $amount * $price;
                $tax = numerize($item['tax']);
                $sum_tax = $sum * (1 + ($tax / 100));

                $productId = $product ? $product->getKey() : null;
                $customerOrderItemId = null;
            }

            $data = [
                'position' => $idx,
                'item_code' => $item_code,
                'subject' => $subject,
                'definition' => trim(strip_tags($definition)),
                'price' => round($price, 2),
                'unit_type' => $unit_type,
                'amount' => $amount,
                'sum' => round($sum, 2),
                'tax' => $tax,
                'sum_tax' => round($sum_tax, 2),
                'discount' => 0,
                'customer_invoice_id' => $customerInvoice->getKey(),
                'customer_order_item_id' => $customerOrderItemId,
                'product_id' => $productId,
            ];

            if ($id) {
                /** @var CustomerInvoiceItem $customerInvoiceItem */
                $customerInvoiceItem = $this->customerInvoiceItems->update($data, $item['id']);
            } else {
                /** @var CustomerInvoiceItem $customerInvoiceItem */
                $customerInvoiceItem = $this->customerInvoiceItems->create($data);
            }

            $customerInvoiceItems->push($customerInvoiceItem);
        }

        $customerInvoice->update([
            'sum' => round($customerInvoiceItems->sum('sum'), 2),
            'sum_tax' => round($customerInvoiceItems->sum('sum_tax'), 2),
        ]);

        event(new CustomerInvoiceItemsAssigned($customerInvoice, $customerInvoiceItems, $attributes, $params));

        return;
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

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'customer_invoice',
        ];
    }
}
