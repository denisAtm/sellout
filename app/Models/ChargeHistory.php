<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargeHistory extends Model
{
    public mixed $user_id;
    public mixed $amount;
    public mixed $date;
    public mixed $comment;
    protected $fillable = [
        'user_id',
        'amount',
        'date',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
