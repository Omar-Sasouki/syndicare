<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification =array(

        'message' =>'Logout Successfuly',
        'alert-type' =>'success'
        );

        return redirect('/login')->with($notification);
    }//END METHOD

    public function profile()
    {
        $id=Auth::user()->id;
        $adminData=User::find($id);
        return view ('admin.profile.admin_profile_view', compact('adminData'));
    }//END METHOD


    public function editprofile()
    {
        $id=Auth::user()->id;
        $editData=User::find($id);
        return view ('admin.profile.admin_profile_edit', compact('editData'));
    }//END METHOD

    public function storeprofile(Request $request)
    {
        $id=Auth::user()->id;
        $data=User::find($id);
        $data->name = $request->name ;
       /*  $data->username = $request->username ; */
        $data->email = $request->email ;

    if ($request->file('profile_image')){
        $file = $request->file('profile_image');

        $filename = date('Ymdhi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'),$filename);
        $data['profile_image'] = $filename;
    }
    $data->save();

    $notification =array(

        'message' =>'Admin Profile Updated Successfuly',
        'alert-type' =>'success'
    );

    return redirect()->route('admin.profile')->with($notification);

    }//END METHOD


    public function editpassword()
    {
        return view ('admin.profile.admin_change_password');
    }//END METHOD

    public function storePassword(Request $request)
    {
        $validation = $request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required',
            'passwordc'=>'required|same:newpassword',
            ]);

            $hashedPassword= Auth::user()->password;
            if(Hash::check($request->oldpassword,$hashedPassword)){
                $users=User::find(Auth::id());
                $users->password = bcrypt($request->newpassword);
                $users->save();

                session()->flash('message','Password Updated Successfully');
                return redirect()->back();
            }else{
                session()->flash('message','Old Password is not mtuch');
                return redirect()->back();


            }

    }//END METHOD

}
