<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorPackage extends Model
{
    use SoftDeletes;
    protected $table = 'vendor_package';

    public function vendor() {
        return $this->belongsTo('App\Vendor', 'vendor_id')->withTrashed();
    }

    public function promo() {
        return $this->belongsToMany(VendorPromo::class, "map_promo_package_vendor", "package_id", "promo_id");
    }
}
