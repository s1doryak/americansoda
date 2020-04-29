<?php


namespace Crmplease\MaterialAdmin\Routing\Traits;

use Crmplease\MaterialAdmin\Sidebar;

/**
 * Trait RenderSidebar
 * @package Crmplease\MaterialAdmin\Routing\Traits
 */
trait RenderSidebar
{
    /**
     * @var Sidebar
     */
    protected static $sidebar;

    /**
     * @var string
     */
    protected static $contextGetter = 'getPrefix';

    /**
     * @var string
     */
    protected static $contextProperty = 'prefix';

    /**
     * @var string
     */
    protected static $defaultContext = 'default';

    /**
     * @return void
     */
    public static function bootRenderSidebar()
    {
        if (is_null(self::$sidebar)) {
            self::$sidebar = app('sidebar');
        }
    }

    /**
     * @return void
     */
    public function initializeRenderSidebar()
    {
        $this->renderSidebar();
    }

    /**
     * @return string
     */
    protected function getSidebarContext()
    {
        if (method_exists($this, self::$contextGetter)) {
            return call_user_func([$this, self::$contextGetter]) ?: self::$defaultContext;
        }

        if (property_exists($this, self::$contextProperty)) {
            return $this->{self::$contextProperty} ?: self::$defaultContext;
        }

        return self::$defaultContext;
    }

    /**
     * @return array
     */
    protected function getSidebarData()
    {
        return with(self::$sidebar)->getData(
            $this->getSidebarContext()
        );
    }

    /**
     * @return void
     */
    public function renderSidebar()
    {
        view()->share('sidebar', $this->getSidebarData());
    }
}
