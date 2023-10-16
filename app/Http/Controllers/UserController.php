<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    }

    public function UserProfile(){
        $id=Auth::user()->id;
        $profileData=user::find($id);
        return view ('frontend.dashboard.edit_profile',compact('profileData'));
    }

    public function UserStore(Request $request)
    {
        $id=Auth::user()->id;
        $data =User::find($id);
        $data->name =$request->name;
        $data->email =$request->email;
        $data->phone =$request->phone;
        $data->address =$request->address;
        if ($request->file('photo')) {
            $file=$request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user
            _images'),$filename);
            $data['photo']=$filename;

    }
    $data->save();

    $notification = array(
        'message' => 'Admin Profile Updated Successfully!',
        'alert-type'=>'success' 

    );

    return redirect()->back()->with($notification);

    }
}
