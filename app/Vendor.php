<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Members\Entities\AlbumWedding;

class Vendor extends Model
{
    //
    protected $table = 'vendor';

    public function albums() {
        return $this->hasMany(AlbumWedding::class, 'vendor_id');
    }

    public function packages() {
        return $this->hasMany(VendorPackage::class, 'vendor_id');
    }

    public function promos() {
        return $this->hasMany(VendorPromo::class, 'vendor_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'vendor_id');
    }

    public function bank() {
        return $this->hasOne(VendorAccountBank::class, 'vendor_id');
    }
}
