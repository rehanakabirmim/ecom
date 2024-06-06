<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendonController extends Controller
{
    public function VendorDashboard(){
        return view('vendor.index');
    }
}
