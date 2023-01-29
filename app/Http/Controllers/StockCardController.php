<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StockCardController extends Controller
{
    public function index(){
        $stockCards = Stock::with('product', 'warehouse')->paginate(10);
        return Inertia::render('StockCard/Index', [
            'stockCards' => $stockCards
        ]);
    }
}
