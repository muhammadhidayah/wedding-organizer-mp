<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPackage extends Model
{
    protected $table = 'vendor_package';

    public function vendor() {
        return $this->belongsTo('App\Vendor', 'vendor_id');
    }
}
