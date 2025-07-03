<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Houses extends Model
{
    //
    protected $table = 'houses';
    protected $fillable = [
        'image',
        'name',
        'city',
        'price',
        'location',
        'bedrooms',
        'description',
        'status',

    ];
    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';
    public function User()
    {
        return $this->belongsTo(User::class, 'House_id');
    }
    public function images()
{
    return $this->hasMany(HouseImage::class, 'house_id');
}


}
