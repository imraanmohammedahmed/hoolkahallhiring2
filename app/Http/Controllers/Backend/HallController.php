<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Facility;
use Intervention\Image\Facades\Image;
use App\Models\HallNumber;
use Carbon\Carbon;
use App\Models\HallType;
use App\Models\MultiImage;
use Illuminate\Support\Facades\File;

class HallController extends Controller

{
    public function EditHall($id)
    {
        $basic_facility = Facility::where('halls_id', $id)->get();
        $multiimgs = Facility::where('halls_id', $id)->get();
        $editData = Hall::find($id);
        $allhallNo = HallNumber::where('halls_id',$id)->get();
        return view('backend.allhall.halls.edit_halls', compact('editData', 'basic_facility','multiimgs','allhallNo'));
    }

    public function UpdateHall(Request $request, $id)
    {
        $hall = Hall::find($id);
        $hall->halltype_id = $hall->halltype_id;
        $hall->total_guest = $request->total_guest;
        $hall->hall_capacity = $request->hall_capacity;
        $hall->price = $request->price;
        $hall->size = $request->size;
        $hall->discount = $request->discount;
        $hall->short_desc = $request->short_desc;
        $hall->description = $request->description;

        // Update single image
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 850)->save('upload/hallimg/' . $name_gen);
            $save_url = 'upload/hallimg/' . $name_gen;
            $hall->image = $name_gen;
        }
        $hall->save();

        // Insert multiple images in the database
        if ($request->facility_name == null) {
            $notification = array(
                'message' => 'Sorry, no basic item selected',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            Facility::where('halls_id', $id)->delete();
            $facilities = count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $facility = new Facility();
                $facility->halls_id = $hall->id;
                $facility->facility_name = $request->facility_name[$i];
                $facility->save();
            }
        }

        // Multi-Image
        if ($hall->save()) {
            $files = $request->multi_img;
            if (!empty($files)) {
                $subimages = MultiImage::where('halls_id', $id)->get()->toArray();
                MultiImage::where('halls_id', $id)->delete();
            }
            if (!empty($files)) {
                foreach ($files as $file) {
                    $imgName = date('YmdH') . $file->getClientOriginalName();
                    $file->move('upload/hallimg/multi_img/', $imgName);

                    $subImage = new MultiImage();
                    $subImage->halls_id = $hall->id;
                    $subImage->multi_img = $imgName;
                    $subImage->save();
                }
            }
        }

        $notification = array(
            'message' => 'Hall Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function MultiImageDelete($id)
    {
        $deletedata = MultiImage::where('id', $id)->first();
        if($deletedata){
        
            $imagePath = $deletedata->multi_img;
            //check if the file exst 
            if (File::exists($imagePath)){
                unlink($imagePath);
                echo"Image does not exist";
                }
//delete 
        MultiImage::where('id',$id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        }
      

    }

public function StoreHallNumber(Request $request,$id)
{


    $data = new HallNumber();
    $data->halls_id=$id;
    $data->hall_type_id=$request->hall_type_id;
    $data->hall_no=$request->hall_no;
    $data->status=$request->status;
    $data->save();

    $notification = array(
        'message' => 'Hall Number Added Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

}

public function EditHallNumber($id)

{
    $edithallno =HallNumber::find($id);
    return view('backend.allhall.halls.edit_hall_no',compact('edithallno'));
}

public function UpdateHallNumber(Request $request, $id)
{
    $data = HallNumber::find($id);
    $data->hall_no=$request->hall_no;
    $data->status =$request->status;
    $data->update();

    $notification = array(
        'message' => 'Hall Number Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('hall.type.list')->with($notification);
}

public function DeleteHallNumber($id)

{
    HallNumber::find($id)->delete();

    $notification = array(
        'message' => 'Hall Number Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('hall.type.list')->with($notification);

}

public function DeleteHall(Request $request, $id)
{
    $hall = Hall::find($id);
    if(file_exists('upload/hallimg/'.$hall->image) AND ! empty($hall->image))
    {
        @unlink('upload/hallimg'.$hall->image);

    }
    $subimage =MultiImage::where('halls_id',$hall->id)->get()->toArray();
    if(!empty($subimage))
    {
        foreach ($subimage as $value)
        {
            if(!empty($value))
            {
                @unlink('upload/hallimg/multi_img/'.$value['multi_img']);
                }
        }
    }

    Halltype::where('id',$hall->halltype_id)->delete();
    MultiImage::where('halls_id',$hall->id)->delete();
    Facility::where('halls_id',$hall->id)->delete();
    HallNumber::where('halls_id',$hall->id)->delete();
    $hall->delete();
    

    $notification = array(
        'message' => 'Hall Deleted Successfully!',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}



}