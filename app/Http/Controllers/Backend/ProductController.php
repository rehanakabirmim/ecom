<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\User;
use App\Models\MultiImg;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;


class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_all',compact('products'));
    }//end method

public function AddProduct(){
    $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
    $brands=Brand::latest()->get();
    $categories=Category::latest()->get();

    return view('backend.product.product_add',compact('brands','categories','activeVendor'));
}//end method


public function StoreProduct(Request $request){
    if($request->file('product_thambnail')){
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$request->file('product_thambnail')->getClientOriginalExtension();
        $img = $manager->read($request->file('product_thambnail'));
        $img = $img->resize(800,800);

        $img->toJpeg(80)->save(base_path('public/upload/products/thambnail/'.$name_gen));
        $save_url = 'public/upload/products/thambnail/'.$name_gen;
        $product_id = Product::insertGetID([
                     'brand_id'=>$request->brand_id,
                     'category_id'=>$request->category_id,
                     'subcategory_id'=>$request->subcategory_id,
                     'product_name' => $request->product_name,
                    'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
                     'product_code'=>$request->product_code,
                     'product_qty'=>$request->product_qty,
                     'product_tags'=>$request->product_tags,
                     'product_size'=>$request->product_size,

                     'product_color'=>$request->product_color,
                     'selling_price'=>$request->selling_price,
                     'discount_price'=>$request->discount_price,
                     'short_descp'=>$request->short_descp,
                     'long_descp'=>$request->long_descp,
                     'product_thambnail' => $save_url,
                    'vendor_id'=>$request->	vendor_id,

                     'hot_deals'=>$request->hot_deals,
                     'featured'=>$request->featured,
                     'special_offer'=>$request->special_offer,
                     'special_deals'=>$request->special_deals,
                     'status'=>1,
                     'created_at'=>Carbon::now(),


                ]);






            }//end if


        $notification = array(
            'message' => 'Product Inserted  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);


        }//end method


        public function EditProduct($id){

            $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
            $brands=Brand::latest()->get();
            $categories=Category::latest()->get();
            $subcategory=SubCategory::latest()->get();
            $products = Product::findOrFail($id);

    return view('backend.product.product_edit',compact('brands','categories','activeVendor','subcategory','products'));

        }//end method


    public function UpdateProduct(Request $request){
        $product_id = $request->id;

        Product::findOrFail( $product_id)->update([

        'brand_id'=>$request->brand_id,
                     'category_id'=>$request->category_id,
                     'subcategory_id'=>$request->subcategory_id,
                     'product_name' => $request->product_name,
                    'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
                     'product_code'=>$request->product_code,
                     'product_qty'=>$request->product_qty,
                     'product_tags'=>$request->product_tags,
                     'product_size'=>$request->product_size,

                     'product_color'=>$request->product_color,
                     'selling_price'=>$request->selling_price,
                     'discount_price'=>$request->discount_price,
                     'short_descp'=>$request->short_descp,
                     'long_descp'=>$request->long_descp,

                    'vendor_id'=>$request->	vendor_id,

                     'hot_deals'=>$request->hot_deals,
                     'featured'=>$request->featured,
                     'special_offer'=>$request->special_offer,
                     'special_deals'=>$request->special_deals,
                     'status'=>1,
                     'created_at'=>Carbon::now(),


        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);


    }//end method


    public function ProductInactive($id){

        Product::findOrFail($id)->update(['status' => 0 ]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    public function ProductActive($id){

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    public function UpdateProductThambnail(Request $request){

        $pro_id = $request->id;
        $oldImage = $request->old_img;

        if($request->file('product_thambnail')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            $img = $manager->read($request->file('product_thambnail'));
            $img = $img->resize(800,800);

            $img->toJpeg(80)->save(base_path('public/upload/products/thambnail/'.$name_gen));
            $save_url = 'public/upload/products/thambnail/'.$name_gen;



         if (file_exists($oldImage)) {
           unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([

            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
    }//end if
       $notification = array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method


    public function ProductDelete($id){
        $deleted = Product::findOrFail($id);
        $img =$deleted->product_thambnail;
        $deleted->delete();

    $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method
}
