<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $transactions = QueryBuilder::for(Transaction::class)
            ->allowedFilters([
                'name',
                'type',
                'is_paid',
                AllowedFilter::scope('minValue'),
                AllowedFilter::scope('maxValue')
            ])
            ->allowedIncludes('category', 'account')
            ->paginate($request->get('per_page', 10));

        return TransactionResource::collection($transactions);
    }

    public function store(StoreTransactionRequest $request)
    {
        $validate = $request->validated();

        $transaction = Transaction::create($validate);

        if ($request->has('relationship')) {
            $transaction->load('category', 'account');
        }

        return new TransactionResource($transaction);
    }

    public function show(Transaction $transaction, Request $request)
    {
        if ($request->has('relationship')) {
            $transaction->load('category', 'account');
        }

        return new TransactionResource($transaction);
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $validate = $request->validated();

        $transaction->update($validate);

        if ($request->has('relationship')) {
            $transaction->load('category', 'account');
        }

        return new TransactionResource($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->noContent();
    }
}
