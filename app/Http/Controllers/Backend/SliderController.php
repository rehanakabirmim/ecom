<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class SliderController extends Controller
{
   public function AllSlider(){
    $sliders = Slider::latest()->get();
    return view('backend.slider.slider_all',compact('sliders'));


   }//end Method

   public function AddSlider(){
    return view ('backend.slider.slider_add');
}//end method


public function StoreSlider(Request $request){
    if($request->file('slider_image')){
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$request->file('slider_image')->getClientOriginalExtension();
        $img = $manager->read($request->file('slider_image'));
        $img = $img->resize(2376,807);

        $img->toJpeg(80)->save(base_path('public/upload/slider/'.$name_gen));
        $save_url = 'public/upload/slider/'.$name_gen;
         Slider::insert([
                    'slider_title' => $request->slider_title,
                    'short_title' => $request->short_title,

                    'slider_image' => $save_url,
                ]);

               $notification = array(
                    'message' => 'Slider Inserted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.slider')->with($notification);

            }//end if
            // else{
            //     Slider::insert([
            //         'slider_title' => $request->slider_title,
            //         'short_title' => $request->short_title,

            //     ]);

            //    $notification = array(
            //         'message' => 'Slider Inserted Without Image Successfully',
            //         'alert-type' => 'success'
            //     );

            //     return redirect()->route('all.slider')->with($notification);


            // }//end else



        } //end method

        public function EditSlider($id){
            $slider = Slider::findOrFail($id);
            return view('backend.slider.slider_edit',compact('slider'));


        }//end method



        Public function UpdateSlider(Request $request){
            $slider_id = $request->id;
            $old_image = $request->old_image;

            if($request->file('slider_image')){
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()).'.'.$request->file('slider_image')->getClientOriginalExtension();
                $img = $manager->read($request->file('slider_image'));
                $img = $img->resize(2376,807);

                $img->toJpeg(80)->save(base_path('public/upload/slider/'.$name_gen));
                $save_url = 'public/upload/slider/'.$name_gen;



                Slider::findOrFail($slider_id)->update([
                    'slider_title' => $request->slider_title,
                    'short_title' => $request->short_title,
                    'slider_image' => $save_url,
                ]);

               $notification = array(
                    'message' => 'Slider Updated with image Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.slider')->with($notification);

                } else {

                     Slider::findOrFail($slider_id)->update([
                    'slider_title' => $request->slider_title,
                    'short_title' => $request->short_title,
                ]);

               $notification = array(
                    'message' => 'Slider Updated without image Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.slider')->with($notification);

                } // end else

    }//end method


        public function DeleteSlider($id){
            $slider = Slider::findOrFail($id);
            $img = $slider->slider_image;
            $slider->delete();
            $notification = array(
                        'message' => 'Slider Deleted Successfully',
                        'alert-type' => 'success'
                    );

            return redirect()->route('all.slider')->with($notification);

        }//end method

}
