@extends('admin.layout')
@section('content')
<main>
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
                    <form action="{{route('catesave')}}" method="post">
                        @csrf
                        <div class="form-group ">
                            <input type="text" name="name" placeholder="Category Name" class="form-control">
                        </div>
                        <div class="form-group ">
                        <textarea name="description"class="form-control" placeholder="Description" id="" cols="3" rows="3"></textarea>
                            <!-- <input type="text" placeholder="Description" name="description" class="form-control"> -->
                        </div>
                        <input type="submit" class="btn btn-success mt-3" value="Submit">
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
           </div>
		</div>
	</div>
</main>
@endsection

@if(Session::has('category_create'))
<div class="alert alert-success "><em>{!! session('category_create') !!}</em>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
</div>
@endif

