<?php

namespace Crmplease\MaterialAdmin\Events\Traits;


trait ValidatesAction
{
    /**
     * @param string $action
     *
     * @return boolean
     */
    protected function isValidAction($action)
    {
        return in_array($action, $this->getValidActions()) || 0 === count($this->getValidActions());
    }

    /**
     * @return array
     */
    protected function getValidActions()
    {
        return [];
    }
}
