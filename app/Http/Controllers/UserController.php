<?php

namespace App\Http\Controllers;

use App\Models\ChargeHistory;
use App\Services\PointAccrualService;
use App\Services\PointRedemptionService;
use App\Models\User;
use App\Requests\AccruePointsRequest;
use App\Requests\RedeemPointsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected PointAccrualService $pointAccrualService;
    protected PointRedemptionService $pointRedemptionService;

    public function __construct(PointAccrualService $pointAccrualService, PointRedemptionService $pointRedemptionService)
    {
        $this->pointAccrualService = $pointAccrualService;
        $this->pointRedemptionService = $pointRedemptionService;
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function showChargeForm($userId)
    {
        $user = User::findOrFail($userId);
        return view('users.charge_form', compact('user'));
    }

    public function charge(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $points = $request->input('amount');
        $comment = $request->input('comment');
        $date = $request->input('date');

        $chargeHistory = new ChargeHistory();
        $chargeHistory->user_id = $user->id;
        $chargeHistory->amount = $points;
        $chargeHistory->date = $date;
        $chargeHistory->comment = $comment;
        $chargeHistory->save();

        $user->balance += $points;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Баллы успешно начислены пользователю!');
    }

    public function accruePoints(AccruePointsRequest $request, $userId): JsonResponse
    {
        $user = User::findOrFail($userId);

        $validated = $request->validated();

        $this->pointAccrualService->accruePoints(
            $user,
            $validated['amount'],
            $validated['date'],
            $validated['comment'] ?? ''
        );

        return response()->json(['message' => 'Баллы успешно начислены пользователю']);
    }

    public function redeemPoints(RedeemPointsRequest $request, $userId): JsonResponse
    {
        $user = User::findOrFail($userId);

        $validated = $request->validated();

        $this->pointRedemptionService->redeemPoints(
            $user,
            $validated['amount'],
            $validated['itemNumber'],
            10 // Пример стоимости товара в баллах
        );

        return response()->json(['message' => 'Баллы успешно списаны у пользователя']);
    }

    public function getUserChargeHistory($userId)
    {
        $user = User::findOrFail($userId);

        $chargeHistory = $user->chargeHistories()->get();

        return response()->json(['charge_history' => $chargeHistory]);
    }
}
