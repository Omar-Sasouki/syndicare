<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ChampPub;
use App\Models\DashFlutter;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Illuminate\Support\Facades\Storage;
use Image;


class HomeSliderController extends Controller
{
    public function homeSlider()
    {
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeslide'));
    }

    public function storehomeSlider(Request $request)
    {
        $slide_id=$request->id;
        if ($request->file('home_slide')) {
            $image=$request->file('home_slide');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();//par exp  32545687.jpg

            Image::make($image)->resize(1200,1200)->save('upload/home_slider/'.$name_generate);
            $save_url= 'upload/home_slider/'.$name_generate ;

            HomeSlide::findOrfail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url ,
            ]);
            $notification =array(
                'message' =>'Home Page with Image Updated Successfuly',
                'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);
        }else{

            HomeSlide::findOrfail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,

            ]);
            $notification =array(
                'message' =>'Home Page Updated Successfuly',
                'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);

        }//end else

    }// End methode

    // mobiiiile slide
    public function mobilslide()
    {
        $mobilslide = DashFlutter::find(1);
        return view('admin.home_slide.flutter_slide',compact('mobilslide'));
    }
    
    public function mobilslide2()
    {
        $mobilslide = DashFlutter::find(2);
        return view('admin.home_slide.flutter_slide2',compact('mobilslide'));
    }

    public function mobilslide3()
    {
        $mobilslide = DashFlutter::find(3);
        return view('admin.home_slide.flutter_slide3',compact('mobilslide'));
    }



    //champ Pub 

    public function indxpub()
    {
        $champub = ChampPub::find(1);
        return view('admin.home_slide.champpub',compact('champub'));
    }

    public function storechamp(Request $request)
    {
        $slide_id=$request->id;
        if ($request->file('pub_photo')) {
            $image=$request->file('pub_photo');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();//par exp  32545687.jpg

            Image::make($image)->save('upload/home_slider/'.$name_generate);
            $save_url= 'upload/home_slider/'.$name_generate ;

            ChampPub::findOrfail($slide_id)->update([
                'pub_photo' => $save_url ,
            ]);
            $notification =array(
                'message' =>'Champ Pub  Updated Successfuly',
                'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);
        }else{

            $notification =array(
                'message' =>'Champ Pub Updated Successfuly',
                'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);

        }//end else
    }

    public function showchamppub()
    {
        
        $champub = ChampPub::find(1);
        $image_path = null;
        if ( $champub->pub_photo) {
            $image_path = asset(''. $champub->pub_photo);
        }
        return response()->json([
            'user'=>$champub,
            'profile_image' => $image_path,
        ]);
    }

}
