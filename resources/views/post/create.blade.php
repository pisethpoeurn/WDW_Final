@extends('post.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 title">Create Post</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Static Navigation</li>
        </ol>
           
        <div class="card mb-4">
            @if(Session::has('post_create'))
            <div class="alert alert-success"><em>{!! session('post_create') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>    
            </div>
            @endif
         <!-- It Show the form/input error -->
         @include('common.error')
            <div class="card-body">
                <!-- It Create the new Category -->
               <div class="row">
                    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="form-group col-lg-6">
                            <select name="category_id" id="" class="form-control">
                                <option value="">Please choose category!</option>
                                @foreach ($categories as $cate)
                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="text" name="title" placeholder="Post Title" class="form-control">
                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" name="author" placeholder="Post Author" class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <input id="image" type="file" name="image">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <textarea name="short_desc"class="form-control" placeholder="Post Shot Description" id="" cols="3" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea name="description"class="form-control" placeholder="Post Description" id="" cols="3" rows="3"></textarea>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-primary mt-3">
                    </form>
               </div>
            </div>
        </div>
        <div style="height: 100vh"></div>
        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
    </div>
@endsection