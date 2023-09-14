<?php

namespace App\Models;

use \Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'value'
    ];
    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function isValid($name)
    {
        return MetaData::where('name', $name)->exists();
    }

    static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }



    public static function getValue($name, $default = '', $space = '', $ignoreCache = false)
    {
        if (!$ignoreCache) {
            $cacheKey = "meta-data-" . $name;

            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }

        if (!self::isValid($name)) {
            MetaData::create(['name' => $name, 'value' => $default]);
        }
        $value = null;
        $row = MetaData::where('name', $name)->first();
        if (is_array($row)) {
            $value = $row['value'];
        }
        if (is_object($row)) {
            $value = $row->value;
        }
        $expiresAt = now()->addMinutes(5);
        if (self::isJson($value)) {
            $arr = json_decode($value, true);
            if (!$ignoreCache) {
                Cache::put($cacheKey, $arr, $expiresAt);
            }
            return $arr;
        }
        $val = $value . $space;
        if (!$ignoreCache) {
            Cache::put($cacheKey, $val, $expiresAt);
        }
        return $val;
    }

    public static function setValue($name, $val)
    {
        if (MetaData::where('name', $name)->count() == 0) {
            MetaData::create(['name' => $name, 'value' => '']);
        }
        if (is_array($val)) {
            $val = json_encode($val);
        }

        return MetaData::where('name', $name)->update(['value' => $val]);
    }


}
