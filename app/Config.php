<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Banks;

class Config extends Model
{
    protected $table = 'config_apps';

    public function bank() {
        return $this->hasOne(Banks::class, 'id', 'bank_id');
    }
}
