<?php

namespace App\Http\Controllers;

use App\Models\DateReclamationConfirmation;
use App\Models\Datereclamtion;
use App\Models\User;
use App\Notifications\SetConfimationDateNotification;
use App\Notifications\SetDateNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatereclamtionController extends Controller
{
    public function storedate(Request $request)
    {
        $validation = $request->validate([
            'date' => 'required',
        ]);

        $date = new Datereclamtion();
        $date->date = $request->date;
        $date->user_id = $request->user_id;
        $date->reclamtion_id = $request->reclamtion_id;

        $date->save();

        $user = User::find($date->user_id);
        $user->notify(new SetDateNotification($date));

        return back()->with('message', ' Successfuly ');
    }

    public function show()
    {
        $data['datereclamtions'] = Datereclamtion::get(["id", "date", "user_id", "reclamtion_id"])->where('user_id', auth()->user()->id);
        if (request()->wantsJson()) {
            return response()->json($data);
        }
    }



    public function storedateconfirmation(Request $request)
    {
        $validation = $request->validate([
            'date' => 'required',
        ]);

        $date = new DateReclamationConfirmation();
        $date->date = $request->date;
        $date->date_id = $request->date_id;

        $date->reclamtion_id = $request->reclamtion_id;
        $date->save();

        $admins = \Spatie\Permission\Models\Role::where('name', 'superadmin')
            ->first()
            ->users;
        foreach ($admins as $admin) {
            $admin->notify(new SetConfimationDateNotification($date, $request->reclamtion_id ));
        }

        return response()->json([
            'message' => 'Date envoyer avec succee',
            'date' => $date,
        ], 200);
    }
}
