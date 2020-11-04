<?php

namespace App\Listeners\Dashboard;

use App\CustomerUserSubscribe;
use App\Notifications\Dashboard\SendEmailToCustomersAboutProductArrivals;
use App\Policies\CustomerUserSubscribePolicy;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerUserSubscribeRepository;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;

class NotifyCustomerUserAboutStockMovement
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerUserSubscribeRepository
     */
    protected $customerUserSubscribeRepository;

    /**
     * @var CustomerUserRepository
     */
    protected $customerUserRepository;

    public function __construct(
        CustomerUserSubscribeRepository $customerUserSubscribeRepository,
        CustomerUserRepository $customerUserRepository
    )
    {
        $this->customerUserSubscribeRepository = $customerUserSubscribeRepository;
        $this->customerUserRepository = $customerUserRepository;
    }

    /**
     * @param ResourceEventInterface $e
     * @return void
     */
    public function handle(ResourceEventInterface $e)
    {
        if (!$this->isValidResource($e->getResource())) {
            return;
        }

        if (!$this->isValidNamespace($e->getNamespace())) {
            return;
        }

        $params = $e->getParams();

        if (Arr::get($params, 'shouldNotify', false)) {
            $this->notifyCustomers($params);
        }
    }

    protected function notifyCustomers(array $params)
    {
        $stockMovementProducts = Arr::get($params, 'stockMovementProducts', []);
        $products = Arr::pluck($stockMovementProducts, 'product');
        $customerUserSubscribes = $this->customerUserSubscribeRepository
            ->with(['product'])
            ->findWhereIn('product_id', $products)
            ->groupBy('customerUser.id');

        /**
         * @var integer $customerUser
         * @var  CustomerUserSubscribe $customerUserSubscribe
         */
        foreach ($customerUserSubscribes as $customerUser => $customerUserSubscribe) {
            $customerUser = $this->customerUserRepository->find($customerUser);
            $products = $customerUserSubscribe->pluck('product');
            $customerUser->notify(
                new SendEmailToCustomersAboutProductArrivals($products, $customerUser->token)
            );
        }
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
            'stock_movement',
        ];
    }
}
