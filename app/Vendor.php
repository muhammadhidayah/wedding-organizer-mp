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
}
