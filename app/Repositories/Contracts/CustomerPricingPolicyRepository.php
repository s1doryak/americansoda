<?php

namespace App\Repositories\Contracts;

interface CustomerPricingPolicyRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @param $customerId
     * @param array $policies
     * @return array
     */
    public function setPoliciesForCustomer($customerId, array $policies);

    /**
     * @param $quantity
     * @param $customerId
     * @param $productGroupId
     * @return mixed
     */
    public function getPriceBySalesUnitQuantity($quantity, $customerId, $productGroupId);
}
