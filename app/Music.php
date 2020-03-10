<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [
        'title',
        'uuid',
        'artist',
        'album',
        'year',
        'genre',
        'file_name',
        'album_id',
        'image_filename',
    ];

    public function album (){
        return $this->belongsTo(Album::class);
    }

}
