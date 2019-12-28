<?php

namespace App\Helpers;

use App\Helpers\DateHelper;

class Helper 
{
	public static function formatDate($date) {
		$unixTimestamp = strtotime($date);
		$day = date('j', $unixTimestamp);
		$month = DateHelper::FULL_MONTH_NAME[date('F', $unixTimestamp)];
		$year = date('Y', $unixTimestamp);
		
		return sprintf("%02d %s, %d",
			$day,
			$month,
			$year
		);
	}
}