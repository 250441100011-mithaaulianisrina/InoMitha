<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | File ini digunakan untuk menyimpan konfigurasi layanan pihak ketiga
    | yang digunakan oleh aplikasi InoMitha.
    |
    | Informasi sensitif seperti API Key tetap disimpan di file .env
    | dan tidak ditulis langsung di source code.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],


    'resend' => [
        'key' => env('RESEND_KEY'),
    ],


    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),

        'secret' => env('AWS_SECRET_ACCESS_KEY'),

        'region' => env(
            'AWS_DEFAULT_REGION',
            'us-east-1'
        ),
    ],


    /*
    |--------------------------------------------------------------------------
    | Gemini AI
    |--------------------------------------------------------------------------
    |
    | Konfigurasi Gemini API yang digunakan oleh fitur
    | AI Business Assistant pada aplikasi InoMitha.
    |
    | API Key dibaca dari GEMINI_API_KEY di file .env.
    | Model Gemini dibaca dari GEMINI_MODEL di file .env.
    |
    */

    'gemini' => [

        'api_key' => env(
            'GEMINI_API_KEY'
        ),

        'model' => env(
            'GEMINI_MODEL',
            'gemini-3.5-flash-lite'
        ),

    ],

];