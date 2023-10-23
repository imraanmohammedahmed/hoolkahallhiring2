<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Hall;
use App\Models\MultiImage;
use App\Models\Facility;

class FrontendHallController extends Controller
{
    public function AllFrontendHalllist()
    {
        $halls=Hall::latest()->get();
        return view('frontend.hall.all_halls',compact('halls'));
    }

    public function HallDetailsPage($id)
    {
        $halldetails=Hall::find($id);
        $multiImage = MultiImage::where('halls_id',$id)->get();
        $facility = Facility::where('halls_id',$id)->get();


        $otherHalls = Hall::where('id', '!=',$id)->orderBy('id','DESC')->limit(2)->get();

        return view('frontend.hall.hall_details',compact('halldetails','multiImage','facility','otherHalls'));
    }
}
