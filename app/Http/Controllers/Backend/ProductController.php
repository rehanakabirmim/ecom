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
}//end metho

    
}
