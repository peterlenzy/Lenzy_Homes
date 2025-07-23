<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
        protected $fillable = [
            'user_id', // the user who started the conversation
         ];
    public function user() {
    return $this->belongsTo(User::class);
}

public function messages() {
    return $this->hasMany(Message::class);
}
public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
}
