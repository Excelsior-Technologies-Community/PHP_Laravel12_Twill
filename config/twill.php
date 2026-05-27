<?php

return [
    'block_editor' => [
    'use_twill_blocks' => [
        'hero',
        'text',
        'image',
        'gallery',
        'faq',
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