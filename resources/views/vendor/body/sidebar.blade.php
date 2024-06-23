@php
	$id = Auth::user()->id;
	$vendorId = App\Models\User::find($id);
	$status = $vendorId->status;

@endphp



<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('adminbackend')}}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Admin</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{Route('vendor.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
	@if($status === 'active')
				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Product Manage</div>
					</a>
					<ul>
						<li> <a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>All Product</a>
						</li>
						<li> <a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
					</ul>
				</li>
					
				<li>
				<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">All Orders</div>
					</a>
					<ul>
						<li> <a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>All order</a>
						</li>
						<li> <a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Add order</a>
						</li>
					</ul>
				</li>
@else
@endif				
				
			
				
				
				<li>
					<a href=" " target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
				
				
			</ul>
			<!--end navigation-->
		</div>