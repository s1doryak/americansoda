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
    protected $name = 'resource:create:payment_type';



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
	    $this->resource = $paymentType;
		$this->repository = $paymentTypeRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'payment_type';
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
