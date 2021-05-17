<?php

namespace App\DataTables\Dashboard;

use App\LtpTransfer;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;

/**
 * LtpTransfer datatable.
 *
 * @package App\DataTables\Dashboard
 */
class LtpTransferDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'requested_delivery_date' => [
                'data' => 'requested_delivery_date',
                'searchable' => true,
            ],
            'customerShipment.number' => [
                'data' => 'customerShipment.number',
                'searchable' => true,
            ],
            'document_number' => [
                'data' => 'document_number',
                'template' => 'dashboard::resources.ltp_transfer.columns.document_number',
                'searchable' => true,
            ],
            'name' => [
                'data' => 'name',
                'searchable' => true,
            ],
            'order_numbers' => [
                'data' => 'order_numbers',
                'searchable' => true,
            ],
            'document_date',
            'sent_at',
            'picking_date',
            'picked',
            'warehouse',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'customerShipment.number',
            'requested_delivery_date',
            'document_number',
            'customer',
            'order_numbers',
            'document_date',
            'sent_at',
            'picking_date',
            'picked',
            'warehouse',
            'updated_at',
            'action'
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [

        ];
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return array
     */
    protected function getActions($ltpTransfer)
    {
        return array_merge([
            'xml' => [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.xml', $this->prefix, $this->resource), $ltpTransfer->getKey()),
                'method' => 'post',
                'icon' => 'code',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.send.title', $this->resource)),
            ],
        ], parent::getActions($ltpTransfer));
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return array_merge(parent::getButtons(), [
            [
                'extend' => 'action',
                'className' => 'btn-icon-text btn-primary',
                'text' => $this->renderIconView(trans(sprintf('models/%s.ltpUpdate.title', $this->resource)), 'refresh-sync', 'c-white'),
                'attr' => [
                    'data-role' => 'action',
                    'data-action' => 'ltpUpdate',
                    'data-resource' => $this->resource,
                    'data-url' => route("{$this->prefix}.{$this->resource}.ltpUpdate"),
                    'data-method' => 'GET',
                    'data-token' => csrf_token(),
                    'data-progress-icon-class' => 'zmdi-spinner zmdi-hc-spin',
                ]
            ]
        ]);
    }

    protected function getRowAttributes()
    {
        return array_merge(parent::getRowAttributes(), [
            'style' => function (LtpTransfer $model) {
                $picked = $model->picked;
                $sentAt = $model->sent_at;

                if ($picked == 100) {
                    $color = 'rgb(76, 175, 80, 0.5)'; // зеленый
                } elseif ($picked >= 1 && $picked <= 99) {
                    $color = 'rgb(255, 235, 59, 0.5)'; // желтый
                } elseif ($sentAt && $sentAt->diffInDays(now()) > 2 || $model->picking_date) {
                    $color = 'rgb(244, 67, 54, 0.5)'; // красный
                } else {
                    $color = 'none';
                }

                return "background-color: {$color}";
            }
        ]);
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return string
     */
    public function renderCustomerShipment__NumberColumn($ltpTransfer)
    {
        $shipment = $ltpTransfer->customerShipment;

        if ($this->isDataTableRequest()) {
            return $shipment ? $shipment->getContentAttribute() : $this->renderDefaultView();
        }

        return $shipment ? $shipment->number : null;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderRequestedDeliveryDateColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {

            return $ltpTransfer->requested_delivery_date->format('Y-m-d');
        }

        return $ltpTransfer->requested_delivery_date;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderDocumentDateColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->document_date
                ? format_date($ltpTransfer->document_date)
                : null;
        }

        return $ltpTransfer->document_date;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderSentAtColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            $actionView = $this->getSendToLtpAction($ltpTransfer);

            return $ltpTransfer->sent_at
                ? format_date($ltpTransfer->sent_at)
                : $actionView;
        }

        return $ltpTransfer->sent_at;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderPickedColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return sprintf('%s&nbsp;%%', $ltpTransfer->picked);
        }

        return $ltpTransfer->picked;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderPickingDateColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->picking_date ? format_date($ltpTransfer->picking_date) : $this->renderDefaultView();
        }

        return $ltpTransfer->picking_date;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderWarehouseColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->warehouse ?: 'KT Katriinantie';
        }

        return $ltpTransfer->warehouse ?: 'KT Katriinantie';
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderNameColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->name;
        }

        return $ltpTransfer->name;
    }

    /**
     * @param LtpTransfer $ltpTransfer
     * @return mixed|string
     */
    public function renderOrderNumbersColumn($ltpTransfer)
    {
        if ($this->isDataTableRequest()) {
            return $ltpTransfer->order_numbers ?: $this->renderDefaultView();
        }

        return $ltpTransfer->order_numbers;
    }

    protected function getSendToLtpAction(LtpTransfer $ltpTransfer)
    {
        return $this->renderActionView([
            'sendToLtp' => [
                'target' => '_blank',
                'url' => route(sprintf('%s.%s.sendToLtp', $this->prefix, $this->resource), $ltpTransfer->getKey()),
                'method' => 'get',
                'icon' => 'cloud-upload',
                'color' => 'blue',
                'title' => trans(sprintf('models/%s.send.title', $this->resource)),
            ]
        ], $ltpTransfer);
    }
}
