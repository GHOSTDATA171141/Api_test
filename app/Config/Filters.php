<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    // Makes reading things below nicer,
    // and simpler to change out script that's used.
    public $aliases = [
        'csrf' => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'verifyRefreshToken' => \App\Filters\VerifyRefreshToken::class,
        'userAuth' => \App\Filters\UserAuth::class,
        'verifyAuthorization' => \App\Filters\VerifyAuthorization::class,
    ];

    // Always applied before every request
    public $globals = [
        'before' => [
            //'honeypot'
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            //'honeypot'
        ],
    ];

    // Works on all of a particular HTTP method
    // (GET, POST, etc) as BEFORE filters only
    //     like: 'post' => ['CSRF', 'throttle'],
    public $methods = [];

    // List filter aliases and any before/after uri patterns
    // that they should run on, like:
    //    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
    public $filters = [
        'verifyRefreshToken' => [
            'before' => [
                API_PATH . '/auth/refresh',
            ],
        ],
        'verifyAuthorization' => [
            'before' => [
                API_PATH . '/user/change-pw',
                API_PATH . '/user/profile',
                API_PATH . '/user/update-profile',
                API_PATH . '/user/userList',
                API_PATH . '/order',
                API_PATH . '/order/*',
                API_PATH . '/payment/chillpay',
                'dashboard/*',
            ],
        ],
        'userAuth' => [
            'before' => [
                'user/*',
                'dashboard',
                'dashboard/*',
                'adminmanagement',
                'adminmanagement/*',
                ]
        ],
    ];
}
