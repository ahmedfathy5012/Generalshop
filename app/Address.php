<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street_name','street_number','city',
        'state','country','post_code'
    ];

    public function customer(){
        return $this.belongsTo(User::class);
    }
}
