<?php

namespace Modules\Members\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlbumWedding extends Model
{
    use SoftDeletes;
    protected $fillable = [];
    protected $table = "vendor_photos";

    public function photos() {
        return $this->hasMany(CollectionPhotoAlbum::class, "vendor_photo_id");
    }
}
