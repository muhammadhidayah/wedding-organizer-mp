<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPackage extends Model
{
    protected $table = 'vendor_package';

    public function vendor() {
        return $this->belongsTo('App\Vendor', 'vendor_id');
    }

    public function promo() {
        return $this->belongsToMany(VendorPromo::class, "map_promo_package_vendor", "package_id", "promo_id");
    }
}
