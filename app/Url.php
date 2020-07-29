<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public $timestamps = false;
    protected $fillable = ['url','shortened','user_id','is_custom','count'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
