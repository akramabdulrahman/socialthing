<?php
/**
 * Created by PhpStorm.
 * User: akram
 * Date: 9/10/2016
 * Time: 4:43 PM
 */

namespace app\Models\Traits;


use App\User;

trait CreatedByUser
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}