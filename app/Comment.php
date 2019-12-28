<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Comment extends Model
{
    protected $fillable = [
    	'user_id',
    	'article_id',
    	'text',
    	'visible',
    	'comment_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getPublishedDate()
    {
    	return Helper::formatDate($this->created_at);
    }
}
