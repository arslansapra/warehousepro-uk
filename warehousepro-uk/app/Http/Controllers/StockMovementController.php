<?php

namespace App\Http\Controllers;



use App\Models\StockMovement;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\StoreStockMovementRequest;
use App\Events\LowStockDetected;

use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])->latest()->paginate(10);
        return view('stock-movements.index', compact('movements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock-movements.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockMovementRequest $request)
    {
        $product = Product::findOrFail(
            $request->product_id
        );
//If User want to Stock In
        if ($request->type === 'stock_in') {

            $product->increment(
                'quantity',
                $request->quantity
            );

        } 
//If User want to Stock Out        
        elseif ($request->type === 'stock_out') {

            if (
                $product->quantity < $request->quantity
            ) {

                return back()
                    ->withErrors([
                        'quantity' => 'Not enough stock available.'
                    ])
                    ->withInput();
            }

            $product->decrement(
                'quantity',
                $request->quantity
            );

        } 
        // If Not Stock In ot Stock Out, Do Adjustment
        else { 

            $product->update([
                'quantity' => $request->quantity
            ]);
        }

        StockMovement::create([

            'product_id' => $product->id,

            'user_id' => auth()->id(),

            'type' => $request->type,

            'quantity' => $request->quantity,

            'reason' => $request->reason,

        ]);

        if ($product->quantity < 10) {
           // dd('EVENT TRIGGERED');
            event(new LowStockDetected($product));
        }

        return redirect()
            ->route('stock-movements.index')
            ->with(
                'success',
                'Stock movement created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(StockMovement $stockMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockMovement $stockMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockMovement $stockMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockMovement $stockMovement)
    {
        //
    }
}
