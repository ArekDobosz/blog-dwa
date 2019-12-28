<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        $articles = Article::orderBy('created_at', $request ? $request->createdAt : 'desc');

        if ($request) {
            if ($request->published && !$request->unpublished) {
                $articles->where('is_published', true);
            }
            
            if (!$request->published && $request->unpublished) {
                $articles->where('is_published', false);
            }
        }

        return view('admin.article.index')
            ->with('articles', $articles->withTrashed()->get())
            ->with('request', $request)
        ;
    }

    /**
     * Display a listing of the resource by provided filters.
     *
     * @return \Illuminate\Http\Response
     */
    public function getArticlesByFilter(Request $request)
    {
        return $this->index($request);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        return view('admin.article.create')

            ->with('categories', Category::all())
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Article::create([
            'author' => Auth::guard('user')->id(),
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'thumbnail' => $request->thumbnail,
            'is_published' => (bool)$request->is_published,
            'published_at' => $request->is_published ? date('Y-m-d H:i:s') : null
        ]);

        return redirect(route('article.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {
        $articleToShow = Article::with(['comments', 'comments.user'])
            ->where('id', $article)
            ->first();

        return view('admin.article.edit')
            ->with('article', $articleToShow)
            ->with('categories', Category::all())
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_published' => (bool)$request->is_published,
            'category_id' => $request->category_id,
            'slug' => $request->slug,
            'thumbnail' => $request->thumbnail,
            'published_at' => $request->is_published ? date('Y-m-d H:i:s') : null
        ]);

        if ($request->promoted) {
            $oldPromotedArticle = Article::where('promoted', true)->first();
            if ($oldPromotedArticle) {
                $oldPromotedArticle->promoted = false;
                $oldPromotedArticle->save();
            }
            $article->promoted = true;
            $article->save();
        }

        return back();
    }

    public function restore($articleId)
    {
        $article = Article::withTrashed()->find($articleId)->restore();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ($article) {
            // if ($article->comments) {
            //     foreach ($article->comments as $comment) {
            //        $comment->delete();
            //    }   
            // }
            $article->is_published = false;
            $article->save();
            $article->delete();
        }
        return back();
    }

    public function switchPublishedStatus($articleId)
    {
        $article = Article::find($articleId);
        if (!$article->is_published) {
            $article->published_at = date('Y-m-d H:i:s');
        }
        $article->is_published = !$article->is_published;

        $article->save();
    }
}
