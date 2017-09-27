<?php

return [

    /*
     * Google key for authentication
     */
    'api_key' => env('GOOGLE_TRANSLATE_API_KEY'),

    /*
     * Url to translation REST service
     */
    'translate_url' => 'https://www.googleapis.com/language/translate/v2',

    /*
     * Url to language detection REST service
     */
    'detect_url' => 'https://www.googleapis.com/language/translate/v2/detect',
];
