<?php

namespace App;
use Illuminate\Support\Carbon;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email',
        'email_verified','mobile','mobile_verified',
        'password','shpping_address','billing_address',
        'remember_token','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       // 'email_verified_at' => 'datetime',
        // 'mobile_verified_at' => 'datetime,'
    ];



    public function orders(){
      return $this->hasMany(order::class);
    }


    public function payments(){
        return $this->hasMany(payment::class);
      }


    public function shipments(){
        return $this->hasMany(Shipment::class);
      }


      public function shippingAddress(){
        return $this->hasOne(Address::class , 'id' ,  'shipping_address');
      }

      public function billingAddress(){
        return $this->hasOne(Address::class ,'id' , 'billing_address');
      }


      public function widhlist(){
        return $this->hasOne(WishList::class);
      }


      public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function roles(){
      return $this->belongsToMany(Role::class);
  }

  public function tickets(){
    return $this->hasMany(Ticket::class);
}

public function formatedName(){
  return $this ->first_name . ' ' . $this->last_name ;
}

}
