<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuisine extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];

    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public static function withTheName($slug){
        return static::where("slug", $slug)->firstOrFail();
    }
}
