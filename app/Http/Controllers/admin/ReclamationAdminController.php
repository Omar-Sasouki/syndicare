<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ReclamationAdmin;
use App\Models\User;
use App\Notifications\ReclamtionCommun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReclamationAdminController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a=ReclamationAdmin::all();
        return view('admin.reclamtionAdmin.index',compact('a')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $user = auth()->user();
        $validation = $request->validate([
            'object' => 'required',
            'payload' => 'required',
            'type_id' => 'required',
        ]);
    
        $reclamation = new ReclamationAdmin();
        $reclamation->object = $request->object;
        $reclamation->payload = $request->payload;
        $reclamation->type_id = $request->type_id;
        $reclamation->user_id = $user->id;
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhi') . $file->getClientOriginalName();
            $file->move(public_path('upload/reclamtion_images'), $filename);
            $reclamation->image = $filename;
        }
        
        $residence_id = $user->residence_id;
        
        // Find the admins who belong to the same residence as the user
        $admins = User::role('admin')
            ->where('residence_id', $residence_id)
            ->get();
        
        $create_reclamation = $user->name;
        
        // Send a notification to each admin found
        foreach ($admins as $admin) {
            $admin->notify(new ReclamtionCommun());
        }
             
        $reclamation->save();        
        return response()->json([
            'message' => 'Réclamtion envoyer avec succee',          
           
        ],200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.reclamtionAdmin.show', [
            'RSA' => ReclamationAdmin::findOrFail($id)
        ]);

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
    public function destroy($id)
    {

        ReclamationAdmin::where('id', $id)->delete();
        return back()->with('message','Reclamation Deleted Successfuly ' );
    }

}
