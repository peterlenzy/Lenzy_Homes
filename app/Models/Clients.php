<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    protected $table = 'Clients';
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'status',
        'role',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';
    public function Payments()
    {
        return $this->hasMany('App\Models\Payments', 'Client_id');
    }
}
