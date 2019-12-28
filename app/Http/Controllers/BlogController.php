<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Message;
use App\Helpers\DateHelper;
use Auth;
use Cookie;

class BlogController extends Controller
{
    public function index($slug = '')
    {
        $cookie = Cookie::get('2miliony_cookie');
        $category = Category::getBySlug($slug);
        $articles = $category 
            ? Article::getByCategory($category->id)
            : Article::getAllPublished();
        $messages = Message::getMessages();

        $archive = Article::getAllGroupByMonth();

    	return response(view('blog.index')
        		->with('articles', $articles)
                ->with('promoted', Article::getPromoted())
                ->with('latestArticles', Article::getLatestArticles())
                ->with('category', $category)
                ->with('archive', $archive)
                ->with('slug', $slug)
                ->with('show_cookie_message', strlen($cookie) === 0)
                ->with('messages', $messages))
            ->withCookie('2miliony_cookie', $cookie ?? sha1(uniqid()), 100 * 24 * 60 * 60)
    		;
    }

    public function showArticle($slug)
    {
    	$article = Article::getBySlug($slug);
    	if (!$article) {
    		return back();
    	}

        $messages = Message::getMessages();
        $archive = Article::getAllGroupByMonth();

    	return view('article.show')
    		->with('article', $article)
            ->with('messages', $messages)
            ->with('archive', $archive)
            ->with('slug', '')
            ->with('show_cookie_message', false)
    		;
    }

    public function showArchiveArticles($date) {

        $messages = Message::getMessages();
        $archive = Article::getAllGroupByMonth();
        $explodedDate = explode('-', $date);
        $articles = [];
        $title = 'Nie znaleziono wpisów z wybranego zakresu';
        if (count($explodedDate) > 1) {
            $title = sprintf('Wpisy z %s %d', DateHelper::FULL_MONTH_NAME_FROM_NUM[intval($explodedDate[1])], $explodedDate[0]);
            $articles = Article::getArticlesFromPeriodTime($explodedDate);
        }


        return view('archive.index')
            ->with('title', $title)
            ->with('messages', $messages)
            ->with('archive', $archive)
            ->with('show_cookie_message', false)
            ->with('slug', '')
            ->with('articles', $articles);

    }

    public function showRegulations($arg) {

        return view('regulations.'.$arg)
            ->with('slug', '')
            ->with('hideSidebar', true)
            ->with('show_cookie_message', false)
            ;
    }
}
