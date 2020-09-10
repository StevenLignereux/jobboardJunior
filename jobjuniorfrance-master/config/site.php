<?php


return
    [
        'address' => env('SITE_ADDRESS'),
        'name' => env('SITE_NAME'),
        'admin_token' => env('ADMIN_TOKEN'),
        'prices' => [
            'price' => env('PRICE'),
            'highlight' => env('PRICE_HIGHLIGHT'),
            'week' => env('PRICE_WEEK'),
            'month' => env('PRICE_MONTH')
        ],
        'contact' => env('SITE_CONTACT'),
        'create_admin' => env('CREATE_ADMIN'),
        'admin_email' => env('ADMIN_EMAIL'),
        'admin_password' => env('ADMIN_PASSWORD'),
    ];
