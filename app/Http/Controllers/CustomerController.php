<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::where('deleted_at',null)->latest();

        $perPage = 10; // Number of records to get supplier per page
        try {
         $page = $request->page;
        } catch (\Throwable $th) {
         $page = 1;
        }

        // dd($customers->get());
        $customers = $customers->paginate($perPage, ['*'], 'page', $page);


        if ($request->ajax()) {
            return view('inventory.pages.customer.table', compact('customers'))->render(); // Return the view for AJAX requests
        }
        return view('inventory.pages.customer.list',compact('customers'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $customer = Customer::find($request->id);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Customer Not Found Or Invalid ID');
        }
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:73',
            'address' => 'required',
            'dob' => 'required',
            'mobile' => 'required|numeric|min:10',
            'email' => ['string', 'email', 'max:255']
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }

        $input = $request->all();

        try {
            $customer = Customer::find($input['id']);
            // dd($input);
            $customer->update($input);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Customer Not Found Or Invalid ID');
        }
        return back()->with("success", 'Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Customer::findOrFail($request->id)->delete();
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Customer Not Found Or Invalid ID');
        }
        return back()->with("success", 'Customer Deleted Successfully');
    }
}
