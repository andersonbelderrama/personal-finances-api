<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecurrentTransactionRequest;
use App\Http\Requests\UpdateRecurrentTransactionRequest;
use App\Http\Resources\RecurrentTransacionResource;
use App\Models\RecurrentTransaction;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RecurrentTransactionController extends Controller
{

    public function index(Request $request)
    {
        $recurrentTransactions = QueryBuilder::for(RecurrentTransaction::class)
            ->allowedFilters([
                'name',
                'value',
                'is_paid',
                'is_active',
                'recurrent_date',
            ])
            ->allowedIncludes([
                'category',
                'transactions'
            ])
            ->paginate($request->get('per_page', 10));

        return RecurrentTransacionResource::collection($recurrentTransactions);
    }


    public function store(StoreRecurrentTransactionRequest $request)
    {
        $validate = $request->validated();

        $recurrentTransaction = RecurrentTransaction::create($validate);

        if ($request->has('relationship')) {
            $recurrentTransaction->load(
                'category',
                'transactions'
            );
        }

        return new RecurrentTransacionResource($recurrentTransaction);
    }


    public function show(RecurrentTransaction $recurrentTransaction)
    {
        //
    }


    public function update(UpdateRecurrentTransactionRequest $request, RecurrentTransaction $recurrentTransaction)
    {
        //
    }


    public function destroy(RecurrentTransaction $recurrentTransaction)
    {
        //
    }
}
