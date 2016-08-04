<?php

return [
    'presets' => [
        'avatar_sm' => ['w' => 80, 'h' => 80, 'fit' => 'fill'],
        'avatar_md' => ['w' => 100, 'h' => 100, 'fit' => 'fill'],
        'avatar_lg' => ['w' => 300, 'h' => 300, 'fit' => 'fill'],
    ],

    'upload' => [
        'avatar' => ['w' => 300, 'h' => 300, 'fit' => 'max'],
    ],

    'paths' => [
        'cache' => storage_path('app/glide'),
        'local' => storage_path('app/images'),
    ]
];