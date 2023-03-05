<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $transactions = Transaction::with('stock.product', 'stock.warehouse')->paginate(10);
        $warehouses = Warehouse::all(['id', 'name']);
        $products = Product::all(['id', 'name']);

        return Inertia::render('Transaction/Index', [
            'transactions' => $transactions,
            'warehouses' => $warehouses,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTransactionRequest $transactionRequest)
    {
        /*Create Transaction*/
        $product = Product::find($transactionRequest->validated('product_id'));
        $warehouse = Warehouse::find($transactionRequest->validated('warehouse_id'));
        $stockCard = Stock::where(['product_id' => $product->id, 'warehouse_id' => $warehouse->id])->first();

        if (!$stockCard) {
            $stockCard = Stock::create([
                'product_id' => $product->id,
                'warehouse_id' => $warehouse->id
            ]);
        }

        $transaction = Transaction::create([
            'stock_id' => $stockCard->id,
            'user_id' => auth()->id(),
            'quantity' => $transactionRequest->validated('quantity'),
            'type' => $transactionRequest->validated('type'),
        ]);

        /*Check Stock Card*/
        /*Update Stock*/
        if ($transactionRequest->validated('type') == 'incoming') {
            /*Add*/
            $stockCard->update([
                'quantity' => $stockCard->quantity + $transactionRequest->validated('quantity')
            ]);
        } else {
            /*Extraction*/
            if ($stockCard->quantity > $transactionRequest->validated('quantity')) {
                $stockCard->update([
                    'quantity' => $stockCard->quantity - $transactionRequest->validated('quantity')
                ]);
            } else {
                return 'Yetersiz stok';
            }

        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
