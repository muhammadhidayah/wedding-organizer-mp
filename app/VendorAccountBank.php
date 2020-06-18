<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Banks;

class VendorAccountBank extends Model
{
    protected $table = 'vendor_bank_account';

    public function bank() {
        return $this->hasOne(Banks::class, 'id', 'bank_id');
    }
}
