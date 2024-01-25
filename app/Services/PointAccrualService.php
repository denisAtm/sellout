<?php

namespace App\Services;

use App\Models\User;
use App\Models\ChargeHistory;

class PointAccrualService
{
    public function accruePoints(User $user, int $amount, string $date, string $comment)
    {
        $chargeHistory = new ChargeHistory();
        $chargeHistory->user_id = $user->id;
        $chargeHistory->amount = $amount;
        $chargeHistory->date = $date;
        $chargeHistory->comment = $comment;
        $chargeHistory->save();

        $user->balance += $amount;
        $user->save();
    }
}
