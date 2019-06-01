<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
