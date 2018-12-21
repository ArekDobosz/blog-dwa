<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'author',
    	'title',
    	'content',
    	'is_published',
    	'published_at'
    ];

    public static function getAllPublished() {
    	return self::where('is_published', true)->get();
    }
}
