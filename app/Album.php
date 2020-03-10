<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'album_name',
        'artist',
        'year',
        'image_filename',
    ];


    public function music(){
        return $this->hasmany(Music::class);
    }
}
