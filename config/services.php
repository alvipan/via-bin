<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'viaaccount' => [
        'base_url' => env('VIA_URL'),

        'client_id' => env('VIA_CLIENT_ID'),
        'client_secret' => env('VIA_CLIENT_SECRET'),
        'redirect' => env('VIA_REDIRECT_URI'),

        'authorization_endpoint' => env('VIA_URL').'/oauth/authorize',
        'token_endpoint' => env('VIA_URL').'/oauth/token',
        'revoke_endpoint' => env('VIA_URL').'/oauth/revoke',

        'user_endpoint' => env('VIA_URL').'/api/user',
        'userinfo_endpoint' => env('VIA_URL').'/api/userinfo',

        'users_endpoint' => env('VIA_URL').'/api/users',
    ],

];
