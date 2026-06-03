<?php

use Carbon\Carbon;

if (! function_exists('formatDateTime')) {
    function formatDateTime($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i');
    }
}
