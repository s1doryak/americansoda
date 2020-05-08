<?php

namespace Crmplease\MaterialAdmin\Events\Traits;


trait ValidatesNamespace
{
    /**
     * @param string $namespace
     *
     * @return boolean
     */
    protected function isValidNamespace($namespace)
    {
        return in_array($namespace, $this->getValidNamespaces()) || 0 === count($this->getValidNamespaces());
    }

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [];
    }
}
