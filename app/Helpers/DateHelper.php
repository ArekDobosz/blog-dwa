<?php

namespace App\Helpers;

class DateHelper
{
	const FULL_MONTH_NAME = [
		'January' => 'Stycznia',
		'February' => 'Lutego',
		'March' => 'Marca',
		'April' => 'Kwietnia',
		'May' => 'Maja',
		'Jun' => 'Czerwca',
		'July' => 'Lipca',
		'August' => 'Sierpnia',
		'September' => 'Września',
		'October' => 'Października',
		'November' => 'Listopada',
		'December' => 'Grudnia'
	];

	const FULL_MONTH_NAME_FROM_NUM = [
		1 => 'Styczeń',
		2 => 'Luty',
		3 => 'Marzec',
		4 => 'Kwiecień',
		5 => 'Maj',
		6 => 'Czerwiec',
		7 => 'Lipiec',
		8 => 'Sierpień',
		9 => 'Wrzesień',
		10 => 'Październik',
		11 => 'Listopad',
		12 => 'Grudzień'
	];

	public static function dateConvToArchive($date) {
		$date = explode('-', $date);
		return sprintf('%s %d', self::FULL_MONTH_NAME_FROM_NUM[intval($date[1])], $date[0]);
	}
}