<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Auth;

class BlogController extends Controller
{
    public function index()
    {
    	return view('blog.index')
    		->with('articles', Article::getAllPublished())
    		;
    }

    public function showArticle($slug)
    {
    	$article = Article::find($slug);

    	if (!$article) {
    		return back();
    	}

    	return view('article.show')
    		->with('article', $article)
    		->with('hideTopContent', true)
    		;
    }
}
