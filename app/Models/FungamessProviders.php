<?php

namespace App\Models;

use App\Models\FungamessGames;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FungamessProviders extends Model
{
    use HasFactory;

    public $table = 'fungamess_providers';
    public $timestamps = true;

    protected $guarded = [];

    public function games()
    {
        return $this->hasMany(FungamessGames::class, 'provider_id');
    }

    public static function getHomeData()
    {
        $cacheKey = 'fungames-providers-cache';
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $rows = self::whereNotNull('logo')->get();
        foreach ($rows as $k => $row) {
            $where = ['provider_id' => $row->id];
            $games = FungamessGames::where($where)->limit(12)->get();
            $qtyGames = FungamessGames::where($where)->count();
            if ($qtyGames > 0) {
                $rows[$k]['games'] = $games;
                $rows[$k]['qty_games'] = $qtyGames;
            } else {
                unset($rows[$k]);
            }
        }
        Cache::put($cacheKey, $rows);
        return $rows;
    }
}
