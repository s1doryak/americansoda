<?php

namespace App\Http\Controllers\App\Traits;

trait AppSidebar
{
    /**
     * @var array
     */
    protected $sidebar = [
        [
            'title' => 'sidebar.administration',
            'resources' => [
                // ...
            ],
        ],
        // ...
    ];

    /**
     * @return void
     */
    public function shareSidebar()
    {
        view()->share('sidebar', $this->sidebar);
    }
}
