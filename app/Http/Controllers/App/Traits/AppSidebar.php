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
                'job',
                'failed_job',
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
