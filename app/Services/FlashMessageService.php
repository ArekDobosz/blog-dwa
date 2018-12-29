<?php

namespace App\Services;

class FlashMessageService {

	public static function setMessage($color, $message)
	{
		\Session::flash('flash_message', [
			'color' => $color,
			'message' => $message
		]);

		return true;
	}
}