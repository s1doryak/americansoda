<?php

namespace Crmplease\MaterialAdmin\Routing;

use Crmplease\MaterialAdmin\Contracts\Routing\CanBootTraits;
use Crmplease\MaterialAdmin\Routing\Traits\BootTraits;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends \Illuminate\Routing\Controller implements CanBootTraits
{
    use BootTraits, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $defaultMiddleware;

    /**
     * @var array
     */
    protected $defaultMiddlewareOptions = [];

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $translationPrefix;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->defaultMiddleware, $this->defaultMiddlewareOptions);
        $this->bootIfNotBooted();
        $this->initializeTraits();
    }

    /**
     * Return current prefix name.
     *
     * @return string
     */
    protected function getPrefix()
    {
        if (empty($this->prefix)) {
            $this->prefix = prefix_name();
        }

        return $this->prefix;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard($this->getPrefix());
    }
}
