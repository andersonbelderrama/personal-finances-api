<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = QueryBuilder::for(Account::class)
            ->allowedFilters([
                'name',
                'type',
                AllowedFilter::scope('minBalance'),
                AllowedFilter::scope('maxBalance')
            ])
            ->allowedIncludes('user')
            ->paginate($request->get('per_page', 10));

        return AccountResource::collection($accounts);
    }


    public function store(StoreAccountRequest $request)
    {

        $validate = $request->validated();

        $validate['user_id'] = Auth::id();

        $account = Account::create($validate);

        if ($request->has('relationship')) {
            $account->load('user');
        }

        return new AccountResource( $account);
    }


    public function show(Account $account, Request $request)
    {
        if($request->has('relationship')) {
            $account->load('user');
        }

        return new AccountResource($account);
    }


    public function update(UpdateAccountRequest $request, Account $account)
    {
        $validate = $request->validated();

        $account->update($validate);

        if ($request->has('relationship')) {
            $account->load('user');
        }

        return new AccountResource($account);
    }


    public function destroy(Account $account)
    {
        $account->delete();

        return response()->noContent();
    }
}
