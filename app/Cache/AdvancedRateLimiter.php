<?php

namespace App\Cache;

use Illuminate\Cache\RateLimiter;

class AdvancedRateLimiter extends RateLimiter
{
    /**
     * Increment the counter for a given key for a given decay time.
     *
     * @param  string  $key
     * @param  float|int|array  $decayMinutes
     * @return int
     */
    public function hit($key, $decayMinutes = 1)
    {
        if (is_array($decayMinutes)) {
            if (! $this->cache->has($key.':timer')) {
                if (! $this->cache->has($key.':step')) {
                    $this->cache->add($key.':step', 0, 1440);
                } else {
                    $this->cache->increment($key.':step');
                }
            }
            $step = $this->cache->get($key.':step', 0);
            $step = $step < count($decayMinutes) ? $step : count($decayMinutes) - 1;
            $decayMinutes = $decayMinutes[$step];
        }

        return parent::hit($key, now()->addMinutes($decayMinutes));
    }

    /**
     * Clear the hits and lockout timer for the given key.
     *
     * @param  string  $key
     * @return void
     */
    public function clear($key)
    {
        $this->cache->forget($key.':step');

        parent::clear($key);
    }
}