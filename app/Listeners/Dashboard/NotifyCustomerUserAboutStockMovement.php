<?php

namespace App\Listeners\Dashboard;

use App\Notifications\Dashboard\SendEmailToCustomersAboutProductArrivals;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerUserSubscribeRepository;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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
        /** @var Collection $customerUserSubscribes */
        $customerUserSubscribes = $this->customerUserSubscribeRepository
            ->with(['product'])
            ->findWhereIn('product_id', $products);
        $groupedSubscribes = $customerUserSubscribes->groupBy('customerUser.id');

        /**
         * @var integer $customerUserId
         * @var  Collection $subscribes
         */
        foreach ($groupedSubscribes as $customerUserId => $subscribes) {
            $customerUser = $this->customerUserRepository->find($customerUserId);
            $products = $subscribes->pluck('product');
            $subscribeIds = $subscribes->pluck('id')->toArray();
            $customerUser->notify(
                new SendEmailToCustomersAboutProductArrivals($products, $customerUser->token)
            );
            $this->customerUserSubscribeRepository->trashWhereIn('id', $subscribeIds);
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
