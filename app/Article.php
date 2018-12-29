<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Article extends Model
{
    const LATEST_COUNT = 2;

    protected $fillable = [
    	'author',
    	'title',
    	'content',
    	'is_published',
        'slug',
        'thumbnail',
        'category_id',
    	'published_at'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User', 'author', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public static function getAllPublished()
    {
    	return self::where('is_published', true)
            ->where('promoted', false)
            ->get()
            ->diff(self::getLatestArticles());
    }

    public static function getPromoted()
    {
        return self::where('promoted', true)->first();
    }

    public static function getLatestArticles()
    {
        return self::where('is_published', true)
            ->orderBy('published_at', 'DESC')
            ->limit(self::LATEST_COUNT)
            ->get();
    }

    public static function getBySlug($slug)
    {
        return self::with(['comments', 'comments.user'])
            ->where('is_published', true)
            ->where('slug', $slug)
            ->first();
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

    public function getCategoryName()
    {
        return $this->category()->first() ? $this->category()->first()->name : '';
    }

    public function getCommentsCount()
    {
        return $this->comments()->get()->count();
    }
}
