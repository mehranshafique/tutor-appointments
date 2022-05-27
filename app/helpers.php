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

if (! function_exists('twelve_hours_format')) {
  function twelve_hours_format($date){
    return date('Y-m-d h:i A', strtotime($date));
  }
}

if (! function_exists('date_in_hours_format')) {
  function date_in_hours_format($date){
    return date('h:i A', strtotime($date));
  }
}

?>
