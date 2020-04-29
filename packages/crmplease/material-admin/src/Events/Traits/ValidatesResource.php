<?php

namespace Crmplease\MaterialAdmin\Events\Traits;


trait ValidatesResource
{
    /**
     * @param string $resource
     *
     * @return boolean
     */
    protected function isValidResource($resource)
    {
        return in_array($resource, $this->getValidResources()) || 0 === count($this->getValidResources());
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [];
    }
}
