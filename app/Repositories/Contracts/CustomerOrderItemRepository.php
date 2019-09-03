<?php

namespace App\Repositories\Contracts;

interface CustomerOrderItemRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * Find all order items (including trashed) by order id.
     *
     * @param int $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findAllByOrderId($id);

    /**
     * Find all active order items by order id.
     *
     * @param $id
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findActiveByOrderId($id);
}
