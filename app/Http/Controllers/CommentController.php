<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use App\Services\FlashMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request, $articleId)
    {
        $this->validate($request, [
            'text' => 'required|min:3|max:1000'
        ], [
            'text.required' => 'Treść komentarza jest wymagana.',
            'text.min' => 'Treść komentarza powinna zawierać przynajmniej :min znaki.',
            'text.max' => 'Treść komentarza nie może przekraczać :max znaków.'
        ]);

        $article = Article::find($articleId);
        
        if (!$article || !$article->is_published) {
            FlashMessageService::setMessage('red', 'Wystąpił błąd podczas dodawania komentarza. Jeżeli problem będzie się powtarzał skontaktuj się z administratorem.');
            return back();
        }

        $user = Auth::guard('user')->user();

        Comment::create([
            'user_id' => $user ? $user->id : null,
            'article_id' => $article->id,
            'text' => $request->text,
            'visible' => (bool)$user 
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->text = $request->text;
        $comment->visible = (bool)$request->visible;
        $comment->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
