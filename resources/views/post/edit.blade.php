@extends('admin.layout')
@section('content')
	<div class="container-fluid">
		<h1 class="mt-4">Edit Post</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="/post">View All Posts</a></li>
			<li class="breadcrumb-item active"><a href="post/create">Create post</a></li>
		</ol>
		<div class="card mb-4">
                <div class="card-body">
                        <p class="mb-0">This page is an example of using static navigation. By removing the <code>.sb-nav-fixed</code> class from the <code>body</code>, the top navigation and side navigation will become static on scroll. Scroll down this page to see an example.</p>
                </div>
		</div>
		<div>
		<!-- It Show the form/input error -->
                @include('common.error')
            <div class="card-body">
                <!-- It Create the new Category -->
               <div class="row">
                    <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- {{csrf_field()}} -->
                        @method('put')
                        <div class="row">
                        <div class="form-group col-lg-6">
                        <label for="text" class="fw-bold">Category Name</label>
                        <select class="form-control" name="category_id">
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ $category->id === $post->category_id ? ' selected' : '' }} >{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                        <div class="form-group col-lg-6">
                        <label for="text" class="fw-bold">Post Title</label>
                            <input type="text" name="title" value="{{$post->title}}" class="form-control">
                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                            <label for="text" class="fw-bold">Post Author</label>
                                <input type="text" name="author" value="{{$post->author}}" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 input-icons">
                             <label for="upload" class="fw-bold"> Click to Upload New Image:
                                <img src="{{asset('assets/img/posts/'.$post->image)}}" id="img" class="rounded" width="80px" height="80px"/>
                            </label>
                            <input type="file" id="upload" class="text-center form-control-file custom_file"
                                accept=".png,.jpg,.gift,.jpeng" name="image">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                        <label for="text" class="fw-bold">Shot Description</label>
                            <input type="text" name="short_desc" value="{{$post->short_desc}}" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="text" class="fw-bold">Post Description</label>
                            <textarea name="description"class="form-control" id="" cols="3" rows="3">{{$post->description}}</textarea>
                        </div>

                        <input type="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
               </div>
            </div>
	</div>

    @section('script')
        <script>
           function updateImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#img').attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#upload").change(function() {
            updateImage(this);
        });
        </script>
    @endsection

@endsection