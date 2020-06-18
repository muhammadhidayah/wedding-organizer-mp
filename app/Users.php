<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;
    
    protected $table = 'users';
    protected $fillable = ['email', 'name', 'password', 'usertype', 'status_user', 'mobile_phone'];

    public function orders() {
        return $this->hasMany('App\Order', 'foreign_key');
    }

    public function vendor() {
        return $this->hasOne(Vendor::class, 'user_id');
    }
}
