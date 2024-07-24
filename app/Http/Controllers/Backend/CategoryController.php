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
                else{
                    Category::insert([
                        'category_name' => $request->category_name,
                        'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
                       
                    ]);
            
                   $notification = array(
                        'message' => 'Category Inserted without Image Successfully',
                        'alert-type' => 'success'
                    );
            
                    return redirect()->route('all.category')->with($notification); 
            
            
                }
            
            
            
            } //end method


            public function EditCategory($id){
                $category = Category::findOrFail($id);
                return view('backend.category.category_edit',compact('category'));


            }//end method   
            
            

            public function UpdateCategory(Request $request){
                $category_id = $request->id;
                $old_image = $request->old_image;

                if($request->file('category_image')){
                    $manager = new ImageManager(new Driver());
                    $name_gen = hexdec(uniqid()).'.'.$request->file('category_image')->getClientOriginalExtension();
                    $img = $manager->read($request->file('category_image'));
                    $img = $img->resize(120,120);
                    
                    $img->toJpeg(80)->save(base_path('public/upload/category/'.$name_gen));
                    $save_url = 'public/upload/category/'.$name_gen;


                    // if (file_exists($old_image)) {
                    //     unlink($old_img);
                    //  }
                     Category::findOrFail($category_id)->update([
                                'category_name' => $request->category_name,
                                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
                                'category_image' => $save_url, 
                            ]);
                    
                           $notification = array(
                                'message' => 'Category Updateded with image Successfully',
                                'alert-type' => 'success'
                            );
                    
                            return redirect()->route('all.category')->with($notification); 
                    
                    
                    
                    
                    
                        }//end if


                       
                            else {

                                Category::findOrFail($category_id)->update([
                               'category_name' => $request->category_name,
                               'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)), 
                           ]);
                    
                           $notification = array(
                            'message' => 'Category Updated without image Successfully',
                            'alert-type' => 'success'
                        );

                        return redirect()->route('all.category')->with($notification);

                        }//end else


                    }//end method


  public function DeleteCategory($id){

    $category = Category::findOrFail($id);
    $img = $category->category_image;
    


    Category::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Category Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 
  }  //end method                
                




}
