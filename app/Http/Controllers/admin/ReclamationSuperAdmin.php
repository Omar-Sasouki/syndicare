<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DateReclamationConfirmation;
use App\Models\ReclamationSuperAdmin as RSA ;
use App\Models\User;
use App\Notifications\ReclamtionPersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class ReclamationSuperAdmin extends Controller
{
  

    public function calendar()
    {
        
        return view('admin.reclamationSuperAdmin.calendar') ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a=RSA::all();
        return view('admin.reclamationSuperAdmin.index',compact('a')) ;
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
        $idUser=auth()->user()->id;
        $validation = $request->validate([
            'object'=>'required',
            'payload'=>'required',
            'type_id'=>'required',
            'image'=>'required',
           
            ]);

        $RSA= new RSA();
        $RSA->object=$request->object;
        $RSA->payload=$request->payload;
        $RSA->type_id=$request->type_id;
        $RSA->user_id=$idUser;

        if ($request->file('image')){
            $file = $request->file('image');

            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/reclamtion_images'),$filename);
            $RSA['image'] = $filename;
        }

        $RSA->save();
        $idREC=$RSA->id;
        $idUser=auth()->user()->id;
        $users = User::role('superadmin')->get();
        $create_reclamation=auth()->user()->name;
        Notification::send($users, new ReclamtionPersonnel($RSA->object,$create_reclamation,$RSA->id));

        return response()->json([
            'message' => 'Réclamtion envoyer avec succee',
            'user_id'=> $idUser,
            'reclamtion_id'=>$idREC
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
        return view('admin.reclamationSuperAdmin.show', [
            'RSA' => RSA::findOrFail($id),
            $getid = DB::table('notifications')->where('data->id_user',$id)
            ->pluck('id'),
            DB::table('notifications')
            ->where('id',$getid)->update(['read_at'=>now()])
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

        RSA::where('id', $id)->delete();
        return back()->with('message','Reclamation Deleted Successfuly ' );
    }


}
