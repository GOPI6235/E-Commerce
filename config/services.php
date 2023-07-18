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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' =>'513627535020-2a247q88p6b972s6ufkfa32vdtbjd7hg.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

    // 'facebook' => [
    //     'client_id' => env('FACEBOOK_CLIENT_ID'),
    //     'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    //     'redirect' => 'https://localhost:8000/login/facebook/callback',
    // ],

    'github' => [
        'client_id' => 'bf30bd401eacce49c176',
        'client_secret' =>'5591c8f1a4ccf7f829dd7a78b9cbaf8b6e39f57e',
        'redirect' => 'http://localhost:8000/login/github/callback',
    ],


];
