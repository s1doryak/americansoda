<?php


namespace Crmplease\MaterialAdmin\Contracts\Routing;

/**
 * Interface CanBootTraits
 * @package Crmplease\MaterialAdmin\Contracts\Routing
 */
interface CanBootTraits
{
    /**
     * Check if the controller needs to be booted and if so, do it.
     *
     * @return void
     */
    public function bootIfNotBooted();

    /**
     * Initialize any initializable traits on the controller.
     *
     * @return void
     */
    public function initializeTraits();
}
