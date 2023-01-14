<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestWarehouse;
use App\Http\Requests\UpdateRequestWarehouse;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(5);

        return Inertia::render('Warehouse/Index',[
            'tableData' => $warehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequestWarehouse $request)
    {
        $warehouse = new Warehouse;
        $warehouse->name = $request->validated('name');
        $warehouse->save();

        session()->flash('message', ['type'=>'success', 'content'=>'Depo eklendi']);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequestWarehouse $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->name = $request->validated('name');
        $warehouse->update();

        session()->flash('message', ['type'=>'info', 'content'=>'Depo güncellendi']);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        session()->flash('message', ['type'=>'info', 'content'=>'Depo silindi.']);

        return redirect()->back();
    }
}
