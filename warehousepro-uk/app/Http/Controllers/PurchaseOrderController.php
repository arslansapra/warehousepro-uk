<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Models\Product;
use App\Models\Supplier;
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
        $data = $request->validated();

        DB::transaction(function () use ($data) {

            $purchaseOrder = PurchaseOrder::create([
                'po_number' => 'PO-' . strtoupper(uniqid()),
                'supplier_id' => $data['supplier_id'],
                'status' => 'pending',
                'ordered_by' => auth()->id(),
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $item) {

                $purchaseOrder->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        });

        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order created successfully.'
            );
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
}
