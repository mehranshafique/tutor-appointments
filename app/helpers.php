<?php

use Carbon\Carbon;

if (! function_exists('get_time_difference')) {
    function get_time_difference($start, $end)
    {
      $startTime = Carbon::parse($start);
      $endTime = Carbon::parse($end);
      $totalDuration =  $startTime->diffInMinutes($endTime);
      return $totalDuration;
    }
}


?>
