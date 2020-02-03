<?php

namespace App\Console\Commands\Resources;

use App\PaymentType;
use App\Repositories\Contracts\PaymentTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * PaymentType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class PaymentTypeCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:payment_type';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'payment_type';

    /**
     * @var string
     */
    protected $action = 'store';

    /**
     * @var array
     */
    protected $findOrCreateData = [

    ];

    public function __construct(
        PaymentType $paymentType,
        PaymentTypeRepository $paymentTypeRepository
    )
    {
        $this->model = $paymentType;
        $this->repository = $paymentTypeRepository;

        parent::__construct();
    }

    /**
     * @param PaymentType $payment_type
     * @return array
     */
    public function getEventAttributes($payment_type)
    {
        return $payment_type->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
