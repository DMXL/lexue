<?php

return [
    'presets' => [
        'avatar' => [
            'sm' => ['w' => 48, 'h' => 48, 'fit' => 'fill'],
            'md' => ['w' => 100, 'h' => 100, 'fit' => 'fill'],
            'lg' => ['w' => 300, 'h' => 300, 'fit' => 'fill'],
        ]
    ],

    'upload' => [
        'avatar' => ['w' => 300, 'h' => 300, 'fit' => 'max'],
    ],

    'paths' => [
        'cache' => base_path('storage/app/glide'),
        'local' => public_path('images'),
    ]
];