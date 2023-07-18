<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends Controller
{
    public function index(Request $request)
    {
        $technicians = User::where('deleted_at', null)->where('type', 0)->latest();

        $perPage = 10; // Number of records to get supplier per page
        try {
         $page = $request->page;
        } catch (\Throwable $th) {
         $page = 1;
        }

         $technicians = $technicians->paginate($perPage, ['*'], 'page', $page);

         if ($request->ajax()) {
            return view('inventory.pages.technician.table', compact('technicians'))->render(); // Return the view for AJAX requests
         }

        return view('inventory.pages.technician.list', compact('technicians'));// Return the initial page view
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:73',
            'father_name' => 'required|max:73',
            'mother_name' => 'required|max:73',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'dob' => 'required',
            'contact_number' => 'required|numeric|min:10',
            'national_id' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }

        if(!empty($request->dob)){
            $input['dob'] = date('Y-m-d', strtotime($request->dob));
        }else{
            unset($input['dob']);
        }

        $input['type'] = 0; //technician contact number his first demo password. He/She can change his password anytime in profile section.
        $input['password'] = Hash::make($request->contact_number);

        User::create($input);
        return redirect()->back()->with('success', 'Technician Created Successfully');
    }

    public function edit(Request $request)
    {
        try {
            $technician = User::find($request->id);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Technician Not Found Or Invalid ID');
        }
        return $technician;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:73',
            'father_name' => 'required|max:73',
            'mother_name' => 'required|max:73',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'dob' => 'required',
            'contact_number' => 'required|numeric|min:10',
            'national_id' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        if ($validator->fails()) { //show validation message
            return back()->with('error', $validator->errors()->first());
        }

        $input = $request->all();

        try {
            $technician = User::find($input['id']);
            // dd($input);
            $technician->update($input);
        } catch (\Throwable $th) {
           return redirect()->back()->with("error", 'Technician Not Found Or Invalid ID');
        }
        return back()->with("success", 'Technician Updated Successfully');
    }

    public function destroy(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return back()->with('success', 'Technician Deleted Successfully');
    }
}
