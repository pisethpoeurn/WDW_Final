@extends('admin.layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Clothes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Admin Dashboard</a></li>
        <li class="breadcrumb-item active">Product List</li>
    </ol>
    @if (Session::has('product_create'))
    <div class="alert alert-success"><em>{!! session('product_create') !!}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>
    </div>
    @endif
    @if (Session::has('product_delete'))
    <div class="alert alert-success"><em>{!! session('product_delete') !!}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{asset('assets/img/products/'.$product->image)}}" width="150px" height="150px" alt="">
                        <div class="caption">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ $product->description }}</p>
                            <p><strong>Price: </strong> {{ $product->price }}$</p>
                            <p class="btn-holder">
                            <div class="row">
                                <a href="" class="btn btn-warning col-5 text-center openModal" data-toggle="modal" data-backdrop="false" aria-hidden="true" data-target="#exampleModal{{$product->id}}" href="#">Update</a>&nbsp;
                                <div class="modal fade modal-open" id="exampleModal{{$product->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel">
                                                    <form action="{{route('update_pro', $product->id)}}" method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="row form-group">
                                                            <input type='hidden' name='id' class='modal_hiddenid' value="{{$product->id}}">
                                                            <div class="col">
                                                                <input type="text" value="{{$product->name}}" name="name" class=" form-control">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" value="{{$product->description}}" name="desc" class=" form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col">
                                                                <input type="number" value="{{$product->price}}" name="price" class=" form-control">
                                                            </div>
                                                            <div class="col">
                                                                <input type="file" name="img" class=" form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a bindex="-1" type="button" data-toggle="modal" data-backdrop="false" aria-hidden="true" data-target="#exampleModalDeleted{{$product->id}}"  class="btn btn-danger col-5 text-center" role="button">Remove</a>

                                <!-- Modal -->
                                <div class="modal fade modal-open" id="exampleModalDeleted{{$product->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure want to delelte?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{route('remove_pro', $product->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection