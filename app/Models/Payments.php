<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use SoftDeletes;
    //
    protected $table = 'payments';
    protected $fillable = [
        'amount',
        'payment_method',
        'date_of_payment',
        'status',
        'transaction_id',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function Client()
    {
        return $this->belongsTo('App\Models\Clients', 'Client_id');
    }
}
