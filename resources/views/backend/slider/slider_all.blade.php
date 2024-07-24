@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Slider</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Slider</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <a href="{{route('add.slider')}}" class="btn btn-primary">Add Silder</a>


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
										<th>Slider Title</th>
										<th>Short Title</th>
										<th>Slider Image</th>
                                        <th>Action</th>

									</tr>
								</thead>
								<tbody>
								@php
                                    $key = 1;
                                @endphp

                            @foreach($sliders as $item)

									<tr>
										<td>{{$key ++}}</td>
										<td>{{$item->slider_title}}</td>
                                        <td>{{$item->short_title}}</td>
										<td>
										<img src="{{ $item->slider_image ? asset(str_replace('public/', '', $item->slider_image)) : url('upload/no.png') }}" style="width:70px; height:40px;" alt="Slider Image">
										</td>
										<td>
                                            <a href="{{route('edit.slider',$item->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('delete.slider',$item->id)}}" class="btn btn-danger" id="delete" >Delete</a>
                                        </td>





									</tr>

									@endforeach



								</tbody>
								<tfoot>
									<tr>
                                        <th>#SL</th>
										<th>Slider Title</th>
										<th>Short Title</th>
										<th>Slider Image</th>
                                        <th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>













@endsection
