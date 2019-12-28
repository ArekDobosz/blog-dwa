<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Helpers\DateHelper;
use Carbon\Carbon;

class Article extends Model
{
    use SoftDeletes;
    
    const LATEST_COUNT = 2;
    const PAGINATION = 4;

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
            ->orderBy('id', 'desc')
            // ->whereNotIn('id', self::getLatestArticles()->pluck('id'))
            ->paginate(self::PAGINATION);
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

    public static function getByCategory($id)
    {
        return self::where('is_published', true)
            ->where('category_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(self::PAGINATION);
    }

    public static function getAllGroupByMonth() 
    {
        return $result = self::where('is_published', true)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('Y-m');
            });
    }

    public static function getArticlesFromPeriodTime($date)
    {
        $startDate = Carbon::createFromDate(...$date)->startOfMonth();
        $endDate = Carbon::createFromDate(...$date)->endOfMonth();

        return self::whereBetween('created_at', [$startDate, $endDate])->where('is_published', true)->get();
    }

    public function getShortContent($limit)
    {
        $fullArticleArr = explode(' ', $this->content);
        return implode(' ', array_slice($fullArticleArr, 0, 40)).'...';
    }

    public function getPublishedDate()
    {
    	return Helper::formatDate($this->published_at);
    }

    public function getCreatedDate()
    {
        return Helper::formatDate($this->created_at);
    }

    public function getAuthorName()
    {
    	return $this->author()->first()->firstName();
    }

    public function getCategoryName()
    {
        return $this->category()->first() ? $this->category()->first()->name : '';
    }

    public function getCategorySlug()
    {
        return $this->category()->first() ? $this->category()->first()->slug : '';
    }

    public function getCommentsCount()
    {
        return $this->comments()->where('visible', true)->get()->count();
    }

    public function isPublished()
    {
        return $this->is_published ? 'Tak' : 'Nie';
    }
}
