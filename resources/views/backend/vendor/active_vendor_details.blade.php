

@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Active Vendor Details</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Active Vendor Details</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
		<div class="container">
			<div class="main-body">
				<div class="row">
				
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<form method="post" action="{{ route('inactive.vendor.approve')}}" enctype="multipart/form-data">
									@csrf
                                <input type="hidden" name="id" value="{{$actiVendorDetails->id}}">

                                    <div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Shop Name</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" class="form-control" value="{{ $actiVendorDetails->name}}" disabled />
									</div>
								</div>

								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">User Name</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" name="username" class="form-control" value="{{ $actiVendorDetails->username}}" />
									</div>
								</div>
								
								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Vendor Email</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="email" name="email" class="form-control" value="{{ $actiVendorDetails->email}}" />
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Phone</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" name="phone" class="form-control" value="{{ $actiVendorDetails->phone}}" />
									</div>
								</div>
								
								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Address</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" name="address" class="form-control" value="{{ $actiVendorDetails->address}}" />
									</div>
								</div>
                                <div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Vendor Join Date</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" name="vendor_join" class="form-control" value="{{ $actiVendorDetails->vendor_join}}" />
									</div>
								</div>

                                

                                <div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Vendor Short Info</h6>
									</div>
									<div class="col-sm-9 text-secondary">
                                    <textarea name="vendor_short_info" class="form-control" id="inputAddress2" placeholder="Vendor_info" rows="3">{{$actiVendorDetails->vendor_short_info}}</textarea>
									</div>
								</div>

								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0"> Vendor Photo</h6>
									</div>
									<div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ !empty($actiVendorDetails->photo) ? url('upload/vendor_images/'.$actiVendorDetails->photo) : url('upload/no.png') }}" 
                                    alt="Vendor" sytle="width:100px; height:100px;">
									</div>
								</div>


								


								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9 text-secondary">
										<input type="submit" class="btn btn-danger px-4" value="Inactive Details" />
									</div>
								</div>
						
							</div>
						</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>





 @endsection              