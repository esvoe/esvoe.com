<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    /*
    |
    | Maximum allowed upload user image dimensions
    |
    */

    'max_user_image_dimensions' => [
        'width' => env('MAX_IMG_WIDTH', 5000),
        'height' => env('MAX_IMG_HEIGHT', 3000)
    ],
];
