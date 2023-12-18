<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthContoller extends Controller
{
    //login view
    public function login(){

        if(!Auth::check()){
            return view('backend.auth.login');
        }
        return back();
    }

    //login submit
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $credential = $request->only('email','password');
                Auth::attempt($credential);
                return redirect()->route('dashboard');
            }else{
                return back()->with(['credentialError'=>'Your credential do not match']);
            }
        }
        return back()->with(['credentialError'=>"Your credential does not exists"]);
    }

    //edit profile
    public function editProfile(){
        $data = auth()->user();
        return view('backend.auth.edit-profile')->with(['data' => $data]);
    }

    //update editProfile
    public function updateProfile(UpdateAdminRequest $request){
        User::where('id',auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect()->route('dashboard')->with(['updated'=>'Profile Changed Successfully']);
    }

    //edit password
    public function editPassword(){
        return view('backend.auth.edit-password');
    }

    //update password
    public function updatePassword(Request $request){
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);
        if($request->newPassword != $request->confirmPassword){
            return back()->with(['passwordError' => 'Password confirmation do not match!']);
        }
        User::where('id',auth()->user()->id)->update([
                'password' => Hash::make($request->newPassword),
        ]);
        return redirect()->route('dashboard')->with(['updated'=>'Password Changed Successfully']);
    }

    //logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}