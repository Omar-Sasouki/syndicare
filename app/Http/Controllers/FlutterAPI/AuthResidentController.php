<?php

namespace App\Http\Controllers\FlutterAPI;

use App\Http\Controllers\Controller;
use App\Models\Appartement;
use App\Models\Residence;
use App\Models\TypeReclamation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthResidentController extends Controller
{

    public function fetchresidences()
    {
        $data['residences'] = Residence::get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchAppartment(Request $request)
    {
        $data['appartements'] = Appartement::where("residence_id", $request->residence_id)
                                ->get(["number", "id"]);
               
       return response()->json($data);
    }
      public function fetchtype()
    {
        $data['type_reclamations'] = TypeReclamation::get(["name"]);
        return response()->json($data);
        
        
    }


    public function register(Request $request) {

        $selectedResidenceName = $request->input('residence_name');
        $residence = Residence::where('name', $selectedResidenceName)->first();
        $residenceId = $residence->id;


        $fields = $request->validate([
            'name' => 'required|string',
          //  'residence_id' => 'required',
            'appartement_id' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);


        $user = User::create([
            'name' => $fields['name'],
            'residence_id' => $residenceId,
            'appartement_id' => $fields['appartement_id'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        if (!$user->approved) {
            return response([
                'message' => 'Your account is not approved yet.'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $image_path = null;
        if ($user->profile_image) {
            $image_path = asset('uploads/profiles/'.$user->profile_image);
        }
        $response = [
            'user' => $user,
            'token' => $token,
            'profile_image'=>$image_path
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function profile()
    {
        $id=Auth::user()->id;
        $adminData=User::find($id);
        $image_path = null;
        if ($adminData->profile_image) {
            $image_path = asset('upload/admin_images/'.$adminData->profile_image);
        }
        return response()->json([
            'user'=>$adminData,
            'profile_image' => $image_path,
        ]);
        
    }//END METHOD

    public function storeprofile(Request $request)
    {
        $id=Auth::user()->id;
        $data=User::find($id);
        $data->name = $request->name ;
        $data->email = $request->email ;

    if ($request->file('profile_image')){
        $file = $request->file('profile_image');

        $filename = date('Ymdhi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'),$filename);
        $data['profile_image'] = $filename;
    }

    $data->save();
     return response()->json($data);
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

               
                return response()->json($users); 
            }else{
                return response()->json(['message'=>'Old Password is not mtuch!'], 404);

            }



    }//END METHOD
}
