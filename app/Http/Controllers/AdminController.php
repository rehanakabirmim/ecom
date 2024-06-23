<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
     }//end method


     public function AdminUpdatePassword(Request $request){
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed', 
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");
        }//end method

        public function VendorInactive(){
            $inActiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
            return view('backend.vendor.inactive_vendor',compact('inActiveVendor'));
        }//end method


        public function VendorActive(){
            $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
            return view('backend.vendor.active_vendor',compact('activeVendor'));
        }//end method

}