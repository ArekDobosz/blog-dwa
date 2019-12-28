<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name',
    	'slug'
    ];

    public static function getBySlug($slug)
    {
    	if ($slug == '') {
    		return null;
    	}
    	return self::where('slug', $slug)->first();
    }
}
