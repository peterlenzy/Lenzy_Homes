<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'role_name',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function Users()
    {
        return $this->belongsToMany(User::class, 'role_user_roles');
    }
}
