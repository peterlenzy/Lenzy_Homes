<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Houses extends Model
{
    use SoftDeletes;
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
