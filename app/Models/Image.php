<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Allow mass assignment for 'path'
    protected $fillable =
     ['img_path'];

    /**
     * Get all houses that use this image.
     */
    public function houses()
    {
        return $this->belongsToMany(Houses::class)
                    ->withPivot('type') // Access the image type (e.g., front, interior)
                    ->withTimestamps();  // Keep pivot timestamps if you want
    }
}
