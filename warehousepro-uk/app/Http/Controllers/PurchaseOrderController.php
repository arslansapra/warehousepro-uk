<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockMovement;

use App\Events\PurchaseOrderCreated;
use App\Events\PurchaseOrderApproved;
use App\Events\PurchaseOrderReceived;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with([
                'supplier',
                'orderedBy'
            ])
            ->latest()
            ->get();

        return view(
            'purchase-orders.index',
            compact('purchaseOrders')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where(
                'is_active',
                true
            )
            ->orderBy('company_name')
            ->get();

        $products = Product::orderBy('name')
            ->get();

        return view(
            'purchase-orders.create',
            compact(
                'suppliers',
                'products'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request)
    {
        $poNumber = 'PO-' . strtoupper(uniqid());

        // 1. CREATE FIRST (THIS FIXES YOUR ERROR)
        $purchaseOrder = PurchaseOrder::create([
            'po_number' => $poNumber,
            'supplier_id' => $request->supplier_id,
            'status' => 'pending',
            'ordered_by' => auth()->id(),
            'notes' => $request->notes,
        ]);

        // 2. ADD ITEMS
        foreach ($request->items as $item) {
            $purchaseOrder->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // 3. FIRE EVENT (NOW VARIABLE EXISTS)
        if ($purchaseOrder){
            //dd('CONTROLLER HIT');
        event(new PurchaseOrderCreated($purchaseOrder));
       // dd('EVENT CALLED');
        }

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Purchase Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load([
            'supplier',
            'orderedBy',
            'items.product'
        ]);

        return view(
            'purchase-orders.show',
            compact('purchaseOrder')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
    //Approve PO
    public function approve(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('approve', $purchaseOrder);
        
        if ($purchaseOrder->status !== 'pending') {
            return back()->with('error', 'Only pending POs can be approved.');
        }


        $purchaseOrder->update([
            'status' => 'approved'
        ]);

        event(new PurchaseOrderApproved($purchaseOrder));

        return back()->with('success', 'Purchase Order approved.');
    }
    //Receive PO
    public function receive(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('approve', $purchaseOrder);

        if ($purchaseOrder->status !== 'approved') {
            return back()->with('error', 'Only approved POs can be received.');
        }

        foreach ($purchaseOrder->items as $item) {

            $product = $item->product;

            // 1. Increase stock
            $product->increment('quantity', $item->quantity);

            // 2. Create stock movement
            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'stock_in',
                'quantity' => $item->quantity,
                'reason' => 'PO Received: ' . $purchaseOrder->po_number,
            ]);
        }

        $purchaseOrder->update([
            'status' => 'received',
            'received_at' => now()
        ]);

        event(new PurchaseOrderReceived($purchaseOrder));

        return back()->with('success', 'Goods received and stock updated.');
    }
    //Cancel PO
    public function cancel(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('approve', $purchaseOrder);

        if ($purchaseOrder->status === 'received') {
            return back()->with('error', 'Received POs cannot be cancelled.');
        }


        $purchaseOrder->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Purchase Order cancelled.');
    }

}
