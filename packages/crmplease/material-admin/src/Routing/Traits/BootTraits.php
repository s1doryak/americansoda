<?php


namespace Crmplease\MaterialAdmin\Routing\Traits;

/**
 * Trait BootTraits
 * @package Crmplease\MaterialAdmin\Routing\Traits
 */
trait BootTraits
{
    /**
     * The array of booted controllers.
     *
     * @var array
     */
    protected static $booted = [];

    /**
     * The array of trait initializers that will be called on each new instance.
     *
     * @var array
     */
    protected static $traitInitializers = [];

    /**
     * Check if the controller needs to be booted and if so, do it.
     *
     * @return void
     */
    public function bootIfNotBooted()
    {
        if (!isset(static::$booted[static::class])) {
            static::$booted[static::class] = true;

            static::boot();
        }
    }

    /**
     * Initialize any initializable traits on the controller.
     *
     * @return void
     */
    public function initializeTraits()
    {
        foreach (static::$traitInitializers[static::class] as $method) {
            $this->{$method}();
        }
    }

    /**
     * The "booting" method of the controller.
     *
     * @return void
     */
    protected static function boot()
    {
        static::bootTraits();
    }

    /**
     * Boot all of the bootable traits on the controller.
     *
     * @return void
     */
    protected static function bootTraits()
    {
        $class = static::class;

        $booted = [];

        static::$traitInitializers[$class] = [];

        foreach (class_uses_recursive($class) as $trait) {
            $method = 'boot' . class_basename($trait);

            if (method_exists($class, $method) && !in_array($method, $booted)) {
                forward_static_call([$class, $method]);

                $booted[] = $method;
            }

            if (method_exists($class, $method = 'initialize' . class_basename($trait))) {
                static::$traitInitializers[$class][] = $method;

                static::$traitInitializers[$class] = array_unique(
                    static::$traitInitializers[$class]
                );
            }
        }
    }
}
