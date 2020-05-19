<?php

namespace Modules\Members\Entities;

use Illuminate\Database\Eloquent\Model;

class AlbumWedding extends Model
{
    protected $fillable = [];
    protected $table = "vendor_photos";

    public function photos() {
        return $this->hasMany(CollectionPhotoAlbum::class, "vendor_photo_id");
    }
}
