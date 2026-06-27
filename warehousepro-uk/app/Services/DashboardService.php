<?php

namespace App\Services;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\StockMovement;

class DashboardService
{
    public function getStats()
    {
        return cache()->remember('dashboard_stats', 60, function () {
            return [
                'total_products' => Product::count(),

                'low_stock' => Product::where('quantity', '<', 10)->count(),

                'out_of_stock' => Product::where('quantity', 0)->count(),

                'total_suppliers' => Supplier::count(),

                'pending_po' => PurchaseOrder::where('status', 'pending')->count(),

                'approved_po' => PurchaseOrder::where('status', 'approved')->count(),

                'received_po' => PurchaseOrder::where('status', 'received')->count(),

                'today_stock_in' => StockMovement::where('type', 'stock_in')
                    ->whereDate('created_at', today())
                    ->sum('quantity'),

                'today_stock_out' => StockMovement::where('type', 'stock_out')
                    ->whereDate('created_at', today())
                    ->sum('quantity'),

                'recent_movements' => StockMovement::with('product')
                    ->latest()
                    ->limit(5)
                    ->get(),
            ];
        });
    }
}

?>