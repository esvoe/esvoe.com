<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 02.10.2017
 * Time: 14:05
 */

namespace App\Models;


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


}
