<?php

namespace Crmplease\MaterialAdmin\Events;

use Crmplease\MaterialAdmin\Events\Base\Event;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Illuminate\Queue\SerializesModels;

class ResourceUpdated extends Event implements ResourceEventInterface
{
    use SerializesModels;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $resource;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var array
     */
    private $oldAttributes;

    /**
     * @var array
     */
    private $params;

    /**
     * @param $namespace
     * @param $resource
     * @param array $attributes
     * @param array $params
     * @param array $oldAttributes
     */
    public function __construct($namespace, $resource, $action, array $attributes, array $params, array $oldAttributes = [])
    {
        $this->namespace = $namespace;
        $this->resource = $resource;
        $this->action = $action;
        $this->attributes = $attributes;
        $this->params = $params;
        $this->oldAttributes = $oldAttributes;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getOldAttributes()
    {
        return $this->oldAttributes;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
