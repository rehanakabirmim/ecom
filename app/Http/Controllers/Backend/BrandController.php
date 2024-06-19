<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    }//end method


    public function AddBrand(){
        return view ('backend.brand.brand_add');
    }//end method


    public function BrandStore(Request $request){
        if($request->file('brand_image')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('brand_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('brand_image'));
            $img = $img->resize(300,300);
            
            $img->toJpeg(80)->save(base_path('public/upload/brand/'.$name_gen));
            $save_url = 'public/upload/brand/'.$name_gen;
             Brand::insert([
                        'brand_name' => $request->brand_name,
                        'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
                        'brand_image' => $save_url, 
                    ]);
            
                   $notification = array(
                        'message' => 'Brand Inserted Successfully',
                        'alert-type' => 'success'
                    );
            
                    return redirect()->route('all.brand')->with($notification); 
            
            
            
            
            
                }//end if
            
            
            
            } //end method



            public function EditBrand($id){
                $brand = Brand::findOrFail($id);
                return view('backend.brand.brand_edit',compact('brand'));


            }//end method



            public function UpdateBrand(Request $request){
                $brand_id = $request->id;
                $old_image = $request->old_image;

                if($request->file('brand_image')){
                    $manager = new ImageManager(new Driver());
                    $name_gen = hexdec(uniqid()).'.'.$request->file('brand_image')->getClientOriginalExtension();
                    $img = $manager->read($request->file('brand_image'));
                    $img = $img->resize(300,300);
                    
                    $img->toJpeg(80)->save(base_path('public/upload/brand/'.$name_gen));
                    $save_url = 'public/upload/brand/'.$name_gen;


                    // if (file_exists($old_image)) {
                    //     unlink($old_img);
                    //  }
                     Brand::findOrFail($brand_id)->update([
                                'brand_name' => $request->brand_name,
                                'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
                                'brand_image' => $save_url, 
                            ]);
                    
                           $notification = array(
                                'message' => 'Brand Updateded with image Successfully',
                                'alert-type' => 'success'
                            );
                    
                            return redirect()->route('all.brand')->with($notification); 
                    
                    
                    
                    
                    
                        }//end if


                       
                            else {

                                Brand::findOrFail($brand_id)->update([
                               'brand_name' => $request->brand_name,
                               'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)), 
                           ]);
                    
                           $notification = array(
                            'message' => 'Brand Updated without image Successfully',
                            'alert-type' => 'success'
                        );
                
                        return redirect()->route('all.brand')->with($notification); 
                
                        }//end else 
                    
                    
                    
                        
    
    
    
    
                    }//end method
                

 }


    

