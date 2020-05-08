<?php

namespace Crmplease\MaterialAdmin\Services;

use BadMethodCallException;
use Crmplease\MaterialAdmin\Repositories\RepositoryInterface;

/**
 * Class ResourceService
 * @package Crmplease\MaterialAdmin\Services
 */
class ResourceService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->repository, $name)) {
            return call_user_func_array([$this->repository, $name], $arguments);
        }

        throw new BadMethodCallException();
    }

    /**
     * @param string $repository
     * @return $this
     */
    public function setRepository($repository)
    {
        $this->repository = app($repository);

        return $this;
    }
}
