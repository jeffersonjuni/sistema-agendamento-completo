<?php

if (!function_exists('formatDateTime')) {
    function formatDateTime($date)
    {
        return \Carbon\Carbon::parse($date)->format('d/m/Y H:i');
    }
}
