<?php
/**
 * Created by PhpStorm.
 * User: lis
 * Date: 18/9/17
 * Time: 14:26
 */


return [

    /*
    |--------------------------------------------------------------------------
    | List of type friend
    |--------------------------------------------------------------------------
    |
    |
    */
    'type' => [
        'default' => 0,    //state isn't friend eat
        'invite' => 1, //send invite
        'reject' => 2, //invite was canceled
        'approve' => 3,   // was approve
    ],
    /*
    |--------------------------------------------------------------------------
    | List of available Status
    |--------------------------------------------------------------------------
    |
    |
    */
    'status' => [
        'best', 'colleagues', 'employees', 'studied'
    ],

    /*
    |--------------------------------------------------------------------------
    | List of available Relatives
    |--------------------------------------------------------------------------
    |
    |
    */
    'relative' => [
        "dad" => 1,
        "mam" => 2,
        "son" => 3,
        "daughter" => 4,
        "brother" => 5,
        "sister" => 6,
        "husband" => 7,
        "wife" => 8,
        "nephew" => 9,
        "niece" => 10,
        "uncle" => 11,
        "aunt" => 12,
        "fatherInLaw" => 13,
        "matherInLaw" => 14,
        "kum" => 15,
        "kuma" => 16,
        "matchmaker" => 17,
        "matchmaker_she" => 18,
    ],

    'relative_is_male' => [
        "dad" => true,
        "mam" => false,
        "son" => true,
        "daughter" => false,
        "brother" => true,
        "sister" => false,
        "husband" => true,
        "wife" => false,
        "nephew" => true,
        "niece" => false,
        "uncle" => true,
        "aunt" => false,
        "fatherInLaw" => true,
        "matherInLaw" => false,
        "kum" => true,
        "kuma" => false,
        "matchmaker" => true,
        "matchmaker_she" => false,
    ],
];
