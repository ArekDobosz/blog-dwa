<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use Auth;
use App\Events\ChatEvent;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('author')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.shoutbox.index')
            ->with('messages', $messages)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|max:280'
        ], [
            'message.required' => 'Treść wiadomości jest wymagana.',
            'message.min' => 'Treść wiadomości powinna zawierać przynajmniej :min znaki.',
            'message.max' => 'Treść wiadomości nie może przekraczać :max znaków.'
        ]);
        $user = Auth::guard('user')->user();
        $cookie = Cookie::get('2miliony_cookie');
        $status = 'error';
        $message = [];
        if ($user || Message::canUserAddMessage($cookie)) {
            $message = Message::create([
                'user_id' => $user ? $user->id : null,
                'user_cookie' => $cookie,
                'content' => $request->message
            ]);
            $status = 'success';
        }

        $username = $user ? $user->name : 'Niezalogowany';

        broadcast(new ChatEvent($username, $message))->toOthers();

        return response()->json([
            'status' => $status,
            'message' => isset($message) ? $message : null,
            'username' => $username,
            'blocked' => $user === null,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $result = $message->delete();

        return back();
    }
}
