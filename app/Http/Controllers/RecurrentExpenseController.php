<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecurrentExpenseRequest;
use App\Http\Requests\UpdateRecurrentExpenseRequest;
use App\Http\Resources\RecurrentExpenseResource;
use App\Models\RecurrentExpense;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RecurrentExpenseController extends Controller
{

    public function index(Request $request)
    {
        $RecurrentExpenses = QueryBuilder::for(RecurrentExpense::class)
            ->allowedFilters([
                'name',
                'value',
                'is_paid',
                'is_active',
                'recurrent_date',
            ])
            ->allowedIncludes([
                'category',
                'account',
                'transactions'
            ])
            ->paginate($request->get('per_page', 10));

        return RecurrentExpenseResource::collection($RecurrentExpenses);
    }


    public function store(StoreRecurrentExpenseRequest $request)
    {
        $validate = $request->validated();

        $recurrentExpense = RecurrentExpense::create($validate);

        if ($request->has('relationship')) {
            $recurrentExpense->load(
                'category',
                'transactions'
            );
        }

        return new RecurrentExpenseResource($recurrentExpense);
    }


    public function show(RecurrentExpense $recurrentExpense, Request $request)
    {
        if ($request->has('relationship')) {
            $recurrentExpense->load(
                'category',
                'transactions'
            );
        }

        return new RecurrentExpenseResource($recurrentExpense);
    }


    public function update(UpdateRecurrentExpenseRequest $request, RecurrentExpense $recurrentExpense)
    {
        $validate = $request->validated();

        $recurrentExpense->update($validate);

        if ($request->has('relationship')) {
            $recurrentExpense->load(
                'category',
                'transactions'
            );
        }

        return new RecurrentExpenseResource($recurrentExpense);
    }


    public function destroy(RecurrentExpense $RecurrentExpense)
    {
        $RecurrentExpense->delete();

        return response()->noContent();
    }
}
