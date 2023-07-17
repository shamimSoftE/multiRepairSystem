<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('inventory.pages.dashboard');
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        return view('inventory.pages.account_settings', compact('user'));
    }

    public function update(Request $request)
    {
        $input = $request->all();

        if(strlen($request->old_password) >= 8 && strlen($request->new_password) >= 8)
            {
                $validator = Validator::make($request->all(), [
                    'old_password' => [
                        'min:8', function ($attribute, $value, $fail) {
                            if (!Hash::check($value, Auth::user()->password)) {
                                $fail('Old Password didn\'t match');
                            }
                        },
                    ],
                ]);
                if($validator->fails()) {
                    return back()->with('error', $validator->errors()->first());
                }
                $input['password'] = Hash::make($request->new_password);
            }else{
                unset($input['new_password']);
            }

            if($request->file('avatar')){
                $imgName = date('YmdHis').'.'.$request->avatar->extension();
                $request->avatar->move(public_path('inventory/profile'), $imgName);
                $input['avatar'] = $imgName;
            }else{
                unset($input['avatar']);
            }
            // dd($input);

        if($request->user()->type == 1){
            $user = User::find($request->user()->id);
            $user->update($input);
            return back()->with('success', 'Profile Information Updated');
        }else{
            dd('Technician');
        }

    }
}
