<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class NotifyService
{
    public function send($message)
    {
        Log::info("Notificación: " . $message);
    }
}
