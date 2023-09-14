<?php

namespace App\Services;

use App\Exceptions\SoftException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class RateLimitService
{
    private string $index;
    private int $perMinute;

    public function __construct(string $index, int $perMinute)
    {
        $this->index = $index;
        $this->perMinute = $perMinute;
    }

    public function run(): bool
    {

        if (RateLimiter::tooManyAttempts($this->index, $this->perMinute)) {
            $seconds = RateLimiter::availableIn($this->index);
            throw new SoftException(__('validation.rate_limit_msg', ['seconds' => $seconds]));
        } else {
            RateLimiter::attempt(
                $this->index,
                $this->perMinute,
                function () {
                    // Send message...
                }
            );
        }

        return true;
    }

}
