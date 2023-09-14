<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FungamessGames extends Model
{
    use HasFactory;

    public $table = 'fungamess_games';
    public $timestamps = true;

    protected $guarded = [];
}
