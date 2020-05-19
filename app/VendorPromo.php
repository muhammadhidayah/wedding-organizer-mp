<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPromo extends Model
{
    protected $table = "vendor_promo";

    public function packages() {
        return $this->belongsToMany(VendorPackage::class, "map_promo_package_vendor", "promo_id","package_id");
    }
}
