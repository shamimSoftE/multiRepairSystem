<?php

namespace App\Http\Controllers;

use App\Models\ProblemSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProblemSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $problems = ProblemSetup::where('deleted_at',null)->latest();

        $perPage = 10; // Number of records to get supplier per page
        try {
         $page = $request->page;
        } catch (\Throwable $th) {
         $page = 1;
        }

        $problems = $problems->paginate($perPage, ['*'], 'page', $page);

        if ($request->ajax()) {
        return view('inventory.pages.problemSetup.table', compact('problems'))->render(); // Return the view for AJAX requests
        }

        return view('inventory.pages.problemSetup.list',compact('problems'));
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
        $validator = Validator::make($request->all(), [
            'problem_name' => 'required|max:210',
        ]);
        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }
        $input = $request->all();
        ProblemSetup::create($input);
        return back()->with('success', "Problem Setup Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(ProblemSetup $problemSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $problem = ProblemSetup::find($request->id);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Problem Setup Not Found Or Invalid ID');
        }
        return $problem;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'problem_name' => 'required|max:210',
        ]);
        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }
        $input = $request->all();

        try {
            $problemSetup = ProblemSetup::find($input['id']);
            $problemSetup->update($input);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Problem Setup Not Found Or Invalid ID');
        }
        return back()->with('success', "Problem Setup Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        ProblemSetup::findOrFail($request->id)->delete();
        return back()->with('success', 'Problem Setup Deleted Successfully');
    }
}
