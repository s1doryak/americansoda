<?php return [
    'path' => 'uploads/images/{model}/{attribute}',
    'library' => 'gd',
    'dimensions' => [
        \App\User::class => [
            'avatar' => [
                'width' => 512,
                'height' => 512,
                'crop' => true,
                'quality' => 90,
            ],
        ],
        \App\Brand::class => [
            'logo' => [
                'width' => 512,
                'height' => 512,
                'crop' => true,
                'quality' => 90,
            ],
        ],
        \App\Product::class => [
            'product_image' => [
                'width' => 512,
                'height' => 512,
                'crop' => true,
                'quality' => 90,
            ],
            'package_image' => [
                'width' => 512,
                'height' => 512,
                'crop' => true,
                'quality' => 90,
            ],
        ],
        \App\Banner::class => [
            'image' => [
                'width' => 397,
                'height' => 240,
                'crop' => true,
                'quality' => 90,
            ],
        ],
        \App\ProductGroup::class => [
            'image' => [
                'width' => 512,
                'height' => 512,
                'crop' => true,
                'quality' => 90,
            ],
            'banner' => [
                'width' => 512,
                'height' => 512,
                'crop' => false,
                'quality' => 90,
            ],
        ],
        \App\ProductType::class => [
            'image' => [
                'width' => 512,
                'height' => 512,
                'crop' => true,
                'quality' => 90,
            ],
        ]
        // ...dimensions
    ]
];
