<?php

return [


    'defaults' => [
        'guard' =>  env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'khach_hang' => [
            'driver' => 'session',
            'provider' => 'khach_hang',
        ],
        'nhan_vien' => [
            'driver' => 'session',
            'provider' => 'nhan_vien',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'khach_hang' => [
            'driver' => 'eloquent',
            'model' =>  env('AUTH_MODEL', App\Models\KhachHang::class),
        ],
        'nhan_vien' => [
            'driver' => 'eloquent',
            'model' =>  env('AUTH_MODEL', App\Models\NhanVien::class),
        ],
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],



    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
