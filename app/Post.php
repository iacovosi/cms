<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{

    protected $fillable = [
        'title','content','category_id','image','status','user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }    

    //
}
