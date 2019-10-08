<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tage'];

    public function products(){
        return $this->belongsToMany(product::class);
    }
}
