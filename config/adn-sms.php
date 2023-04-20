<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ADN SMS Service Enabled
    |--------------------------------------------------------------------------
    |
    | You can totally turn the service On or Off from here. Useful if the APIs
    | are down or ongoing maintenance.
    |
    */
    "enabled" => env('ADN_SMS_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | ADN SMS API Key and Secret
    |--------------------------------------------------------------------------
    |
    | Don't forget to set the API key and secret got from ADN SMS gateway
    |
    */
    "api_key" => env('ADN_SMS_KEY', ''),
    "api_secret" => env('ADN_SMS_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Message Format
    |--------------------------------------------------------------------------
    |
    | Set default message format supported by ADN SMS gateway.
    |
    | Supported Types: "TEXT", "UNICODE"
    |
    */
    "message_format" => "TEXT",

    /*
    |--------------------------------------------------------------------------
    | ADN SMS API Domain
    |--------------------------------------------------------------------------
    |
    | Set API domain from ADN SMS if default stops working
    |
    */
    "domain" => "https://portal.adnsms.com",

    /*
    |--------------------------------------------------------------------------
    | ADN SMS API URL Config
    |--------------------------------------------------------------------------
    |
    | Set API URLs from ADN SMS if defaults stop working
    |
    */
    "api_urls" => [
        "send_sms" => "/api/v1/secure/send-sms",
        "check_balance" => "/api/v1/secure/check-balance",
        "check_sms_status" => "/api/v1/secure/sms-status",
        "check_campaign_status" => "/api/v1/secure/campaign-status",
    ],
];
