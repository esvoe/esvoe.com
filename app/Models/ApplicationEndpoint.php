<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 23.09.2017
 * Time: 23:53
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ApplicationEndpoint extends Model
{

    public $timestamps = false;
    protected $table = 'app_endpoints';

}