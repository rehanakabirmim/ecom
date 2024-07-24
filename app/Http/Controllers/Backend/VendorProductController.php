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
use Auth;

class VendorProductController extends Controller
{
    public function VendorAllProduct(){
        $id = Auth::user()->id;
        $products= product::where('vendor_id',$id)->latest()->get();


        return view('vendor.backend.product.vendor_product_all',compact('products'));
    }//end method


    public function VendorAddProduct(){


    $brands=Brand::latest()->get();
    $categories=Category::latest()->get();

    return view('vendor.backend.product.vendor_product_add',compact('brands','categories'));


    }//end method

    public function VendorGetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);


    }//end method



    public function VendorStoreProduct(Request $request){
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
                        'vendor_id'=>Auth::user()->id,

                         'hot_deals'=>$request->hot_deals,
                         'featured'=>$request->featured,
                         'special_offer'=>$request->special_offer,
                         'special_deals'=>$request->special_deals,
                         'status'=>1,
                         'created_at'=>Carbon::now(),


                    ]);

                //    $notification = array(
                //         'message' => 'Product Inserted Successfully',
                //         'alert-type' => 'success'
                //     );

                //     return redirect()->route('all.product')->with($notification);





                }//end if
                // else{
                //    Product::insert([
                //     'brand_id'=>$request->brand_id,
                //     'category_id'=>$request->category_id,
                //     'subcategory_id'=>$request->subcategory_id,
                //     'product_name' => $request->product_name,
                //    'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
                //     'product_code'=>$request->product_code,
                //     'product_tags'=>$request->product_tags,
                //     'product_size'=>$request->product_size,

                //     'product_color'=>$request->product_color,
                //     'selling_price'=>$request->selling_price,
                //     'discount_price'=>$request->discount_price,
                //     'short_descp'=>$request->short_descp,
                //     'long_descp'=>$request->long_descp,

                //    'vendor_id'=>$request->	vendor_id,

                //     'hot_deals'=>$request->hot_deals,
                //     'featured'=>$request->featured,
                //     'special_offer'=>$request->special_offer,
                //     'special_deals'=>$request->special_deals,

                //     ]);

                //    $notification = array(
                //         'message' => 'Product Inserted without Image Successfully',
                //         'alert-type' => 'success'
                //     );

                //     return redirect()->route('all.product')->with($notification);


                // }//end else

                //MultiImage Upload from here//

                // $images = $request->file('multi_img');
                // foreach( $images as $imge){

                //     // $manager = new ImageManager(new Driver());
                //     $make_name = hexdec(uniqid()).'.'.$request->file('$imge')->getClientOriginalExtension();
                //     $img = $manager->read($request->file('$imge'));
                //     $img = $img->resize(800,800);

                //     $img->toJpeg(80)->save(base_path('public/upload/Product/multi-image/'.$make_name));
                //     $uploadPath = 'public/upload/products/multi-image/'.$make_name;


                //     MultiImg::insert([

                //         'product_id' => $product_id,
                //         'photo_name' => $uploadPath,
                //         'created_at'=>Carbon::now(),


                //     ]);
                // }//end foreach
      //End MultiImage Upload from here//

            $notification = array(
                'message' => 'Product Inserted  Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.all.product')->with($notification);


            }//end method




            public function VendorEditProduct($id){


                $brands=Brand::latest()->get();
                $categories=Category::latest()->get();
                $subcategory=SubCategory::latest()->get();
                $products = Product::findOrFail($id);

        return view('vendor.backend.product.vendor_product_edit',compact('brands','categories','subcategory','products'));

            }//end method


        public function VendorUpdateProduct(Request $request){
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

            return redirect()->route('vendor.all.product')->with($notification);


        }//end method


        public function VendorProductInactive($id){

            Product::findOrFail($id)->update(['status' => 0 ]);
            $notification = array(
                'message' => 'Product Inactive',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }//end method


        public function VendorProductActive($id){

            Product::findOrFail($id)->update(['status' => 1]);
            $notification = array(
                'message' => 'Product Active',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }//end method


        public function VendorProductDelete($id){
            $deleted = Product::findOrFail($id);
            $img =$deleted->product_thambnail;
            $deleted->delete();

            $notification = array(
                    'message' => 'Vendor Product Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

        }//end method
}
