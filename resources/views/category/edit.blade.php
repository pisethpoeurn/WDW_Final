@extends('admin.layout')
@section('content')
	<div class="container-fluid">
		<h1 class="mt-4">Create Category</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="{{url('/')}}">View All Category </a></li>
			<li class="breadcrumb-item active"><a href="category/create">Create category</a></li>
		</ol>	
		<div>
        <!-- It Show the form/input error -->
           @include('common.error')
           <div class="row">
           <div class="col-3"></div>
			<div class="card col-6">
                <div class="card-header">
                    Insert Form
                </div>
                <div class="card-body">
                    <form action="{{route('categoryupdate', $categories->id)}}" method="post">
                     @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="text" class="fw-bold">Category Name</label>
                            <input type="text" name="name" value="{{$categories->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="text" class="fw-bold">Category Description</label>
                            <textarea name="description"class="form-control" placeholder="Description" id="" cols="3" rows="3">{{$categories->description}}</textarea>
                        </div>
                        <input type="submit" class="btn btn-success mt-3" value="Submit">
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
           </div>
		</div>
	</div>
@endsection

@if(Session::has('category_create'))
<div class="alert alert-success "><em>{!! session('category_create') !!}</em>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
</div>
@endif

