<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends Controller
{

      public function index(Request $request)
      {
            // Pagina as transações com base nos filtros e inclui os relacionamentos
            $transactions = QueryBuilder::for(Transaction::class)
                  ->allowedFilters([
                        'name',
                        'type',
                        AllowedFilter::exact('is_paid'),
                        AllowedFilter::scope('minValue'),
                        AllowedFilter::scope('maxValue')
                  ])
                  ->allowedIncludes('category', 'account')
                  ->orderByRaw("COALESCE(payment_date, created_at) DESC") // Ordena por payment_date (ou created_at se payment_date for null)
                  ->paginate($request->get('per_page', 10));

            // Agrupa e ordena as transações pela data `payment_date` e id
            $groupedTransactions = $transactions->getCollection()
                  ->groupBy(fn ($transaction) => Carbon::parse($transaction->payment_date ?? $transaction->created_at)->format('Y-m-d'))
                  ->map(fn ($transactions) => $transactions->sortByDesc('id'));

            // Transforma a coleção agrupada em uma estrutura adequada para o recurso
            $groupedTransactionsResource = $groupedTransactions->map(function ($transactions, $date) {
                  return [
                        'date' => $date,
                        'transactions' => TransactionResource::collection($transactions),
                  ];
            });

            // Retorna os dados agrupados com paginação
            return response()->json([
                  'data' => $groupedTransactionsResource->values(),
                  'meta' => [
                        'current_page' => $transactions->currentPage(),
                        'per_page' => $transactions->perPage(),
                        'total' => $transactions->total(),
                  ],
                  'links' => [
                        'first' => $transactions->url(1),
                        'last' => $transactions->url($transactions->lastPage()),
                        'prev' => $transactions->previousPageUrl(),
                        'next' => $transactions->nextPageUrl(),
                  ],
            ]);
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
