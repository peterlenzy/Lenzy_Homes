<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    protected $table = 'house_image'; //  This is the fix

    protected $fillable = ['house_id', 'type', 'img_path'];

    public function house()
    {
        return $this->belongsTo(Houses::class);
    }

}


