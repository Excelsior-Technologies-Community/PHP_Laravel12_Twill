<?php

return [
    'block_editor' => [
        'blocks' => [
            'hero_banner' => [
                'title'     => 'Hero Banner',
                'icon'      => 'image',
                'component' => 'a-block-hero-banner', 
            ],
        ],
    ],

    'crops' => [
        'image' => [
            'default' => [
                [
                    'name'  => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
            'hero' => [
                [
                    'name'  => 'desktop',
                    'ratio' => 16 / 9,
                ],
                [
                    'name'  => 'mobile',
                    'ratio' => 1 / 1,
                ],
            ],
        ],
    ],
];