<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{


		$conversations = Conversation::where('user_id',auth()->user()->id)->orWhere('seconde_user_id',auth()->user()->id)->orderBy('updated_at', 'desc')->get();
		$count = count($conversations);
		// $array = [];
		for ($i = 0; $i < $count; $i++) {
			for ($j = $i + 1; $j < $count; $j++) {
				if (isset($conversations[$i]->messages->last()->id) && isset($conversations[$j]->messages->last()->id) && $conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
					$temp = $conversations[$i];
					$conversations[$i] = $conversations[$j];
					$conversations[$j] = $temp;
				}
			}
		}

		
		
		return ConversationResource::collection($conversations);
		
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
		$request->validate([
			'user_id'=>'required',
			'message'=>'required'
		]);
		$conversation = Conversation::create([

			'user_id'=>auth()->user()->id,
			'seconde_user_id'=>$request['user_id']
		]);
		Message::create([

			'body'=>$request['message'],
			'user_id'=>auth()->user()->id,
			'conversation_id'=>$conversation->id,
			'read'=>false,
		]);
		return new ConversationResource($conversation);
	}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       // $user=DB::table('users')->where('residence_id',auth()->user()->id)->get();
          $user=User::orderBy('created_at', 'desc')->where('residence_id',auth()->user()->residence_id)->get();  
            return response()->json($user);
    }

    public function singleUser($user)
{
    $user = User::findOrFail($user);
    $image_path = null;
    if ($user->profile_image) {
        $image_path = asset('uploads/profiles/'.$user->profile_image);
    }
    return response()->json([
        'user'=>$user,
        'profile_image' => $image_path,
    ]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
