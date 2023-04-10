<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PaymentReminderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //afiichage same residences
        //$user=DB::table('users')->where('residence_id',auth()->user()->id)->get();
        $user = User::orderBy('created_at', 'desc')->where('residence_id', auth()->user()->residence_id)->get();
        return view('admin.users.index', compact('user'));

    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();

        return back()->with('message', 'User deleted.');
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }
    // banne user
    public function updateBan($user_id, $ban_code)
    {
        try {
            $ban_user = User::whereId($user_id)->update([

                'ban' => $ban_code
            ]);
            if ($ban_user) {
                return redirect()->back()->with('success', 'user banned
                successfuly.');
            }
            return redirect()->back()->with('error', 'failed bann');
        } catch (\Throwable $th) {
            throw $th;
        }
    } //end user bann

    // approved user

    public function approved($user_id)
    {
        try {
            $approved_user = User::whereId($user_id)->update([

                'approved' => 1
            ]);
            $notification = array(

                'message' => ' user Approved Successfuly',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            throw $th;
        }
    } //end user approved

    public function setPaymentSyndic($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->paymentSyndic = 1;
        $user->save();
        
        $notification = array(

            'message' => ' payment set correctly',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
