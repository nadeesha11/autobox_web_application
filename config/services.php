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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'facebook' => [
    'client_id' => '931193384873186',
    'client_secret' => 'ddb53331d45a48ef5cec768e1e89c621',
    'redirect' => 'https://autobox.gatewaylankatravels.com/facebook/callback',
   ],
    
    
    'google' => [
    'client_id' => '313953703203-7salubip0o139ipfrvsulvvv9uuam4l8.apps.googleusercontent.com',
    'client_secret' => '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',
    'redirect' => 'https://autobox.gatewaylankatravels.com/google/callback',
   ],
    



];
