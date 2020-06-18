<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    public function user() {
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function package() {
        return $this->belongsTo('App\VendorPackage', 'package_id');
    }

    public function confirmation() {
        return $this->hasMany('App\PaymentConfirmation', 'order_id');
    }

    public function progress() {
        return $this->hasMany('App\ProgressOrder', 'order_id');
    }
}
