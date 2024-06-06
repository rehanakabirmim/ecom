<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }
    //end method

    public function AdminLogin(){
        return view('admin.admin_login');
    }
    //end method

    public function AdminProfile(){
        $id= Auth::user()->id;
        $adminData=User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));

    }
      //end method

    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
        //end method

     public function AdminProfileStore(Request $request){
       $id = Auth::user()->id;
       $data = User::find($id);
       $data->name = $request->name;
       $data->email = $request->email;
       $data->phone = $request->phone;
       $data->address = $request->address;

       if($request->file('photo')){
        $file = $request->file('photo');
        @unlink(public_path('upload/admin_images/'.$data->photo));
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'), $filename);
        $data['photo'] = $filename;
       }
       $data->save();
       $notification = array(
        'message' => 'Admin Profile Updated Successfully',
        'alert-type' => 'success'
       );

       
       return redirect()->back()->with($notification); 
     }//end method  
     
     
     public function AdminChangePassword(){
        return view('admin.admin_change_password');
     }
}
