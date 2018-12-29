<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use Auth;

class BlogController extends Controller
{
    public function index($slug = '')
    {
    	return view('blog.index')
    		->with('articles', Article::getAllPublished($slug))
            ->with('promoted', Article::getPromoted())
            ->with('latestArticles', Article::getLatestArticles())
            ->with('category', Category::getBySlug($slug))
    		;
    }

    public function showArticle($slug)
    {
    	$article = Article::getBySlug($slug);
    	if (!$article) {
    		return back();
    	}

    	return view('article.show')
    		->with('article', $article)
    		->with('hideTopContent', true)
    		;
    }
}
