<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDebtRequest;
use App\Http\Requests\UpdateDebtRequest;
use App\Http\Resources\DebtResource;
use App\Models\Debt;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class DebtController extends Controller
{

    public function index(Request $request)
    {
        $debts = QueryBuilder::for(Debt::class)
            ->defaultSort('-priority')
            ->allowedFilters(['name', 'status' , 'priority'])
            ->allowedIncludes('transactions', 'notes')
            ->paginate($request->get('per_page', 10));

        return DebtResource::collection($debts);
    }


    public function store(StoreDebtRequest $request)
    {
        $validate = $request->validated();

        $debt = Debt::create($validate);

        if($request->has('notes')) {
            foreach ($request->notes as $note) {
                $debt->addNote($note['note']);
            }
        }

        return new DebtResource($debt);
    }


    public function show(Debt $debt)
    {
        return new DebtResource($debt);
    }


    public function update(UpdateDebtRequest $request, Debt $debt)
    {
        $validate = $request->validated();

        $debt->update($validate);

        if($request->has('notes')) {
            foreach ($request->notes as $note) {
                $debt->addNote($note['note']);
            }
        }

        return new DebtResource($debt);
    }


    public function destroy(Debt $debt)
    {
        $debt->delete();

        return response()->noContent();
    }
}
