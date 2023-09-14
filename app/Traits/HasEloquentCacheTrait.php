<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasEloquentCacheTrait
{
    public function __call($method, $parameters)
    {
        $m = $method;
        $chunks = explode('_', \Str::snake($m));
        if ($chunks[0] == 'cached' && count($chunks) >= 2) {
            $instance = $this;
            unset($chunks[0]);
            if (isset($parameters[0]) && is_int($parameters[0]) && $parameters[0] > 0) {
                $expires = $parameters[0];
            } else {
                $expires = config("constants.default_cache_time");
            }
            $methodName = lcfirst(str_replace(['cached'], '', $m));
            $key = $this->getTable() . "_" . $methodName . "_" . $this->id;
            return getCacheOrCreate($key, $instance, function ($instance) use ($methodName) {
                return $instance->$methodName();
            }, $expires);
        }
        return is_callable(['parent', '__call']) ? parent::__call($method, $parameters) : null;
    }

    public static function allWithCache($lifetimInMinutes = 60)
    {

        $cacheKey = self::getTableName() . '_all';
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        } else {
            $expiresAt = now()->addMinutes($lifetimInMinutes);
            $rows = self::orderBy("id", "desc")->get();
            Cache::put($cacheKey, $rows, $expiresAt);

            return $rows;
        }
    }

    public static function getTableName()
    {
        return (new self())->table;
    }
}
