<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BannerController extends Controller
{
    public function AllBanner(){
        $banners = Banner::latest()->get();
        return view ('backend.banner.banner_all',compact('banners'));
    }//end method

    public function AddBanner(){
        return view ('backend.banner.banner_add');
    }//end method

    public function StoreBanner(Request $request){
        if($request->file('banner_image')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('banner_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('banner_image'));
            $img = $img->resize(768,450);

            $img->toJpeg(80)->save(base_path('public/upload/banner/'.$name_gen));
            $save_url = 'public/upload/banner/'.$name_gen;
            Banner::insert([
                        'banner_title' => $request->banner_title,
                        'banner_url' => $request->banner_url,
                        'banner_image' => $save_url,
                    ]);

                   $notification = array(
                        'message' => 'Banner Inserted Successfully',
                        'alert-type' => 'success'
                    );

                    return redirect()->route('all.banner')->with($notification);

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



            public function EditBanner($id){
                $banners = Banner::findOrFail($id);
                return view('backend.banner.banner_edit',compact('banners'));


            }//end method



            Public function UpdateBanner(Request $request){
                $banner_id = $request->id;
                $old_image = $request->old_image;

                if($request->file('banner_image')){
                    $manager = new ImageManager(new Driver());
                    $name_gen = hexdec(uniqid()).'.'.$request->file('banner_image')->getClientOriginalExtension();
                    $img = $manager->read($request->file('banner_image'));
                    $img = $img->resize(768,450);

                    $img->toJpeg(80)->save(base_path('public/upload/banner/'.$name_gen));
                    $save_url = 'public/upload/banner/'.$name_gen;



                    Banner::findOrFail($banner_id)->update([
                        'banner_title' => $request->banner_title,
                        'banner_url' => $request->banner_url,
                        'banner_image' => $save_url,
                    ]);

                   $notification = array(
                        'message' => 'Banner Updated with image Successfully',
                        'alert-type' => 'success'
                    );

                    return redirect()->route('all.banner')->with($notification);

                    } else {

                        Banner::findOrFail($banner_id)->update([
                        'banner_title' => $request->banner_title,
                        'banner_url' => $request->banner_url,
                    ]);

                   $notification = array(
                        'message' => 'Banner Updated without image Successfully',
                        'alert-type' => 'success'
                    );

                    return redirect()->route('all.banner')->with($notification);

                    } // end else

        }//end method


        public function DeleteBanner($id){
            $banner = Banner::findOrFail($id);
            $img =$banner->banner_image;
            $banner->delete();
            $notification = array(
                'message' => 'Banner Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);



        }//end method

}
