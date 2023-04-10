<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Residence;
use App\Models\User;
use App\Notifications\TableUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residnece = DB::table('residences')->latest('id')->first();
        return view('admin.residences.creation', compact('residnece'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.residences.creation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
        ]);

        $residnece = new Residence();

        $residnece->name = $request->name;

        $residnece->save();

        $notification = array(

            'message' => 'Residnece Created Successfuly',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function residenceEvent()

    {
        $id = Auth::user()->residence_id;
        //dd($id);
        $residence = Residence::find($id);
        // dd($residence);
        return view('admin.home_slide.flutter_slide', compact('residence'));
    }

    public function showevents() //balek nest79ha show events
    {
        $name = Auth::user()->residence_id;
        $residence = DB::table('residences')
            ->where('name', $name)
            ->first();
        $event_path = asset('upload/events/' . $residence->event1);
        $residence->event1 = $event_path;
        $event_path2 = asset('upload/events/' . $residence->event2);
        $residence->event2 = $event_path2;
        $event_path3 = asset('upload/events/' . $residence->event3);
        $residence->event3 = $event_path3;
        return response()->json([
            'residence' => $residence,

        ]);
    }
    /*  $validation = $request->validate([
            "event$eventNumber" => 'required',
        ]);
        $residenceId = Auth::user()->residence_id;
        $residence = Residence::find($residenceId);
        $eventTitle = $request->{"event_title$eventNumber"};
        $filename = null;

        if ($request->file("event$eventNumber")) {
            $file = $request->file("event$eventNumber");
            $filename = date('Ymdhi') . $file->getClientOriginalName();
            $file->move(public_path('upload/events'), $filename);
        }

        $updateData = [
            "event_title$eventNumber" => $eventTitle,
            "event$eventNumber" => $filename,
        ];
        //dd($request->all());
        $rowsAffected = DB::table('residences')
            ->where('id', $residenceId)
            ->update($updateData);
        
        $residenceupdating = Residence::find($residenceId);
        
            // Get all users in the same residence
            $users = User::where('residence_id', $residenceId)->get();
            // Notify each user
            foreach ($users as $user) {
                $user->notify(new TableUpdatedNotification($residenceupdating));
            }
 */
    public function updateEvent(Request $request)
    {
        $validatedData = $request->validate([
            'event_title1' => 'required',
            'event_title2' => 'required',
            'event_title3' => 'required',
            'event1' => 'required',
            'event2' => 'required',
            'event3' => 'required',
        ]);

        $residence = Auth::user()->residence;
        $updateData = [];

        for ($i = 1; $i <= 3; $i++) {
            $eventTitle = $validatedData["event_title$i"];
            $filename = $residence["event$i"];

            if ($request->file("event$i")) {
                $file = $request->file("event$i");
                $filename = date('Ymdhi') . $file->getClientOriginalName();
                $file->move(public_path('upload/events'), $filename);
            }

            $updateData["event_title$i"] = $eventTitle;
            $updateData["event$i"] = $filename;
        }

        DB::table('residences')
            ->where('id', $residence->id)
            ->update($updateData);

        // Get all users in the same residence
        $users = User::where('residence_id', $residence->id)->get();

        // Notify each user
        foreach ($users as $user) {
            $user->notify(new TableUpdatedNotification());
        }

        return redirect()->route('residence.events')->with([
            'message' => 'Events updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function showevent()
    {
        $residenceId = Auth::user()->residence_id;
        $residence = Residence::find($residenceId);
        $event_paths = [];
        for ($i = 1; $i <= 3; $i++) {
            $event_path = $residence["event$i"];
            if (!is_null($event_path)) {
                $event_paths["event_path$i"] = url('/') . '/upload/events/' . $event_path;
            }
        }
        return response()->json($event_paths);
    }
    
    
}
