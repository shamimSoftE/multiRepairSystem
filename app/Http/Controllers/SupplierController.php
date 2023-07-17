<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::where('deleted_at', null)->latest();

        $perPage = 10; // Number of records to get supplier per page
        try {
         $page = $request->page;
        } catch (\Throwable $th) {
         $page = 1;
        }

         $suppliers = $suppliers->paginate($perPage, ['*'], 'page', $page);

         if ($request->ajax()) {
            return view('inventory.pages.supplier.table', compact('suppliers'))->render(); // Return the view for AJAX requests
         }

        return view('inventory.pages.supplier.list', compact('suppliers'));// Return the initial page view
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:73',
            'address' => 'required',
            'mobile' => 'required|numeric|min:10',
            'opening_balance' => 'required|numeric'
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }

        Supplier::create($input);

        return redirect()->back()->with('success', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $supplier = Supplier::find($request->id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Supplier Not Found Or Invalid ID');
        }
        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:73',
            'address' => 'required',
            'mobile' => 'required|numeric|min:10',
            'opening_balance' => 'required|numeric'
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }

        $supplier =  Supplier::find($input['id']);

        $supplier->update($input);
        return redirect()->back()->with('success', 'Supplier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Supplier::findOrFail($request->id)->delete();
        return back()->with('success', 'Supplier Deleted Successfully');
    }
}
