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

    // Google Gemini — used for AI-powered resume parsing (free tier).
    // Get a key at https://aistudio.google.com/app/apikey
    'gemini' => [
        'key' => env('GEMINI_API_KEY'),
        'model' => env('GEMINI_MODEL', 'gemini-2.0-flash'),
    ],

    // Jobg8 feed — hourly job-import sync from a Jobg8 zip endpoint.
    // The command app:sync-jobg8 downloads, unzips and imports the spreadsheet.
    'jobg8' => [
        'username' => env('JOBG8_USERNAME'),
        'password' => env('JOBG8_PASSWORD'),
        'account_number' => env('JOBG8_ACCOUNT_NUMBER'),
        'filename' => env('JOBG8_FILENAME', 'Jobs.zip'),
        'endpoint' => env('JOBG8_ENDPOINT', 'https://www.jobg8.com/fileserver/jobs.aspx'),
    ],

];
