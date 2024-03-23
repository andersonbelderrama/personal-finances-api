<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BudgetController extends Controller
{

    public function index(Request $request)
    {
        $budgets = QueryBuilder::for(Budget::class)
            ->allowedFilters([
                'name',
                'type',
            ])
            ->allowedIncludes('category')
            ->paginate($request->get('per_page', 10));

        return BudgetResource::collection($budgets);
    }


    public function store(StoreBudgetRequest $request)
    {
        $validate = $request->validated();

        $budget = Budget::create($validate);

        if ($request->has('relationship')) {
            $budget->load('category');
        }

        return new BudgetResource($budget);
    }


    public function show(Budget $budget, Request $request)
    {

        if ($request->has('relationship')) {
            $budget->load('category');
        }

        return new BudgetResource($budget);
    }


    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $validate = $request->validated();

        $budget->update($validate);

        if ($request->has('relationship')) {
            $budget->load('category');
        }

        return new BudgetResource($budget);
    }


    public function destroy(Budget $budget)
    {
        $budget->delete();

        return response()->noContent();
    }
}
