<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Helpers\DateHelper;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class Message extends Model
{
    protected $fillable = [
    	'content',
    	'user_cookie',
    	'user_id'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function canUserAddMessage($cookie)
    {
    	$timePerMessage = 60;
    	$message = self::where('user_cookie', $cookie)->orderBy('created_at', 'DESC')->first();
        if (!$message) {
            return true;
        }
    	$now = date('Y-m-d H:i:s');
    	$diffTime = strtotime($now) - strtotime($message->created_at);
    	
    	return $diffTime > $timePerMessage;
    }

    public function getAuthor()
    {
    	$username = 'Niezalogowany';
    	if ($this->user_id) {
    		$user = User::find($this->user_id);
    		if ($user) {
    			$username = $user->name;
    		}
    	}
    	return $username;
    }

    public function getDate()
    {
        return date('d.m.Y H:i:s', strtotime($this->created_at->timezone('Europe/Warsaw')));
    }

    public static function getMessages() {
    	$messages = self::orderBy('created_at', 'DESC')
    		->limit(50)
    		->get();

		return $messages->reverse();
    }
}
