<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
