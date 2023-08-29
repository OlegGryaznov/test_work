<?php


namespace App\Traits;


use Illuminate\Support\Facades\Log;

trait Logger
{
    public function log(\Exception $exception)
    {
        Log::error($exception->getMessage(), [
            'file'   => $exception->getFile(),
            'line' => $exception->getLine(),
            'code' => $exception->getCode(),
        ]);
    }
}
