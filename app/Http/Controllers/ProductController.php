<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::where('deleted_at',null)->latest();

        $perPage = 10; // Number of records to get supplier per page
        try {
         $page = $request->page;
        } catch (\Throwable $th) {
         $page = 1;
        }

        $products = $products->paginate($perPage, ['*'], 'page', $page);

        if ($request->ajax()) {
        return view('inventory.pages.product.table', compact('products'))->render(); // Return the view for AJAX requests
        }

        return view('inventory.pages.product.list',compact('products'));
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
            'name' => 'required|max:251',
            'model' => 'required|max:211',
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }
        Product::create($input);
        return redirect()->back()->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $pro = Product::find($request->id);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Product Not Found Or Invalid ID');
        }
        return $pro;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:251',
            'model' => 'required|max:211',
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }

        try {
            $pro = Product::find($input['id']);
            $pro->update($input);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Product Not Found Or Invalid ID');
        }
        return back()->with('success', "Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $pro = Product::findOrFail($request->id);
            $pro->delete();
        } catch (\Throwable $th) {
            return back()->with('error', 'Product Not Deleted');
        }
        return back()->with('success', 'Product Deleted Successfully');
    }
}
