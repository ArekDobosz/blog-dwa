<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Article extends Model
{
    protected $fillable = [
    	'author',
    	'title',
    	'content',
    	'is_published',
    	'published_at'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User', 'author', 'id');
    }

    public static function getAllPublished()
    {
    	return self::where('is_published', true)->get();
    }

    public function getShortContent($limit)
    {
    	return str_limit($this->content, $limit);
    }

    public function getPublishedDate()
    {
    	return Helper::formatDate($this->published_at);
    }

    public function getAuthorName()
    {
    	return $this->author()->first()->firstName();
    }
}
