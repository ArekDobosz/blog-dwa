<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
    	$this->validate($request, [
		    'name' => 'required|min:3|max:50',
		    'email' => 'required|email',
		    'contact_message' => 'required'
		], [
            'name.required' => 'Imię jest wymagane.',
            'name.min' => 'Imię nie powinno być krótsze niż :min znaki.',
            'name.max' => 'Imię nie powinno być dłuższe niż :max znaków.',
            'email.required' => 'E-mail jest wymagany.',
            'email.email' => 'E-mail jest niepoprawny.',
            'contact_message.required' => 'Treść wiadomości jest wymagana.'
        ]);

    	Mail::to('botblackd988@gmail.com')->send(new ContactMessage($request->email, $request->contact_message));

        dd($request->all());
    }
}
