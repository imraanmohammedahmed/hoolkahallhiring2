<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HallType;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Hall;

class HallTypeController extends Controller
{
    public function HallTypeList()
    {
        $allData =HallType::orderBy('id','desc')->get();
        return view ('backend.allhall.halltype.view_halltype',compact('allData'));

    }

    public function AddHallType()
    {
        return view('backend.allhall.halltype.add_halltype');

    }

    public function HallTypeStore(Request $request)
    {
        $halltype_id = HallType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);
    
        Hall::insert([
            'halltype_id' => $halltype_id,
        ]);
    
        $notification = [
            'message' => 'HallType Inserted Successfully!',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('hall.type.list')->with($notification);
    }
}
