<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Settings extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public static function getByName($name, $default = null)
    {
        $setting = self::where('name',$name)->first();

        if (isset($setting)){
            return $setting->value;
        }
        else{
            return $default;
        }
    }
}
