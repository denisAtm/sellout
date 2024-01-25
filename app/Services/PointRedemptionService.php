<?php

namespace App\Services;

use App\Models\User;
use App\Models\ChargeHistory;

class PointRedemptionService
{
    public function redeemPoints(User $user, int $amount, string $itemNumber, int $cost)
    {
        if ($user->balance < $amount * $cost) {
            throw new \InvalidArgumentException('Недостаточно баллов у пользователя');
        }

        $chargeHistory = new ChargeHistory();
        $chargeHistory->user_id = $user->id;
        $chargeHistory->amount = -$amount * $cost;
        $chargeHistory->comment = 'Списание за товар с номером ' . $itemNumber;
        $chargeHistory->save();

        $user->balance -= $amount * $cost;
        $user->save();
    }
}
