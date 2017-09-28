<?php

namespace App\Repositories;

use App\Wallet;
use InfyOm\Generator\Common\BaseRepository;

class WalletRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Wallet::class;
    }
}