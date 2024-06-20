<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::latest()->get();
        return view('backend.category.category_all',compact('categories'));
    }//end method


    public function AddCategory(){
        return view ('backend.category.category_add');
    }//end method


    public function StoreCategory(Request $request){
        if($request->file('category_image')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('category_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('category_image'));
            $img = $img->resize(120,120);
            
            $img->toJpeg(80)->save(base_path('public/upload/category/'.$name_gen));
            $save_url = 'public/upload/category/'.$name_gen;
             Category::insert([
                        'category_name' => $request->category_name,
                        'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
                        'category_image' => $save_url, 
                    ]);
            
                   $notification = array(
                        'message' => 'Category Inserted Successfully',
                        'alert-type' => 'success'
                    );
            
                    return redirect()->route('all.category')->with($notification); 
            
            
            
            
            
                }//end if
            
            
            
            } //end method



}
