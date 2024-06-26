@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Product</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Product</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{route('add.product')}}" class="btn btn-primary">Add Product</a>
							
							
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">DataTable Example</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" >
								<thead>
									<tr>
										<th>#SL</th>
                                        <th>Image</th>
										<th>Product Name</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Discount</th>
                                        <th>Status</th>
										<th>Action</th>
						
									</tr>
								</thead>
								<tbody>
								@php
                                    $key = 1;
                                @endphp
                                        
                            @foreach($products as  $item)

									<tr>
										<td>{{$key ++}}</td>
										<td>{{$item->product_name}}</td>
										<td>
										<img src="{{ $item->product_thambnail ? asset(str_replace('public/', '', $item->product_thambnail)) : url('upload/no.png') }}" style="width:70px; height:40px;" alt="Brand Image">

                                        <td>{{$item->selling_price}}</td>
                                        <td>{{$item->product_qty}}</td>
                                        <td>{{$item->discount_price}}</td>
                                        <td>{{$item->status}}</td>
                                        
											
										</td>
										<td>
                                            <a href="{{route('edit.brand',$item->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('delete.brand',$item->id)}}" class="btn btn-danger" id="delete" >Delete</a>
                                        </td>
										
									
										
										
										
									</tr>
									
									@endforeach
								
									
									
								</tbody>
								<tfoot>
                                <tr>
										<th>#SL</th>
                                        <th>Image</th>
										<th>Product Name</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Discount</th>
                                        <th>Status</th>
										<th>Action</th>
						
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				
			</div>













@endsection