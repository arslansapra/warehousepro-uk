<?php

namespace App\Http\Controllers;

use App\Models\WarehouseLocation;
use App\Http\Requests\StoreWarehouseLocationRequest;
use App\Http\Requests\UpdateWarehouseLocationRequest;
use Illuminate\Http\Request;

class WarehouseLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = WarehouseLocation::latest()->paginate(10);
        return view('warehouse-locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouse-locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseLocationRequest $request)
    {
        $code = strtoupper(
            $request->zone . '-' . $request->rack . '-' . $request->shelf
        );
        
        WarehouseLocation::create([
            'zone' => $request->zone,
            'rack' => $request->rack,
            'shelf' => $request->shelf,
            'code' => $code,
        ]);

        return redirect()
            ->route('warehouse-locations.index')
            ->with('success', 'Location created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(WarehouseLocation $warehouseLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WarehouseLocation $warehouseLocation)
    {
        return view('warehouse-locations.edit', compact('warehouseLocation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseLocationRequest $request, WarehouseLocation $warehouseLocation)
    {
        $code = strtoupper(
            $request->zone . '-' . $request->rack . '-' . $request->shelf
        );

        $warehouseLocation->update([
            'zone' => $request->zone,
            'rack' => $request->rack,
            'shelf' => $request->shelf,
            'code' => $code,
        ]);

        return redirect()
            ->route('warehouse-locations.index')
            ->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WarehouseLocation $warehouseLocation)
    {
        $warehouseLocation->delete();
        
        return redirect()
            ->route('warehouse-locations.index')
            ->with('success', 'Location deleted successfully.');
    }
}
