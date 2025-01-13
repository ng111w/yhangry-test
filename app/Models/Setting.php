<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['api_imported'];

    public function apiIsNotImportedYet(): bool
    {
        $firstSetting = $this->where("api_imported", "1")->first();
        return ($firstSetting) ? false : true;
    }
}
