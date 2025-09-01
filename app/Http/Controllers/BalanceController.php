<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceStoreRequest;
use App\Http\Requests\BalanceUpdateRequest;
use App\Http\Resources\BalanceCollection;
use App\Http\Resources\BalanceResource;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BalanceController extends Controller
{
    public function index(Request $request): BalanceCollection
    {
        $balances = Balance::all();

        return new BalanceCollection($balances);
    }

    public function store(BalanceStoreRequest $request): BalanceResource
    {
        $balance = Balance::create($request->validated());

        return new BalanceResource($balance);
    }

    public function show(Request $request, Balance $balance): BalanceResource
    {
        return new BalanceResource($balance);
    }

    public function update(BalanceUpdateRequest $request, Balance $balance): BalanceResource
    {
        $balance->update($request->validated());

        return new BalanceResource($balance);
    }

    public function destroy(Request $request, Balance $balance): Response
    {
        $balance->delete();

        return response()->noContent();
    }
}
