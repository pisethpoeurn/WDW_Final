@extends('normal.layout')
@section('content')
    <div class="container">
        <div class="container-fluid px-4 mt-5">
            <h3 class="mt-4">Product List</h3>
            @if (Session::has('product_create'))
                <div class="alert alert-success"><em>{!! session('product_create') !!}</em>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times</span></button>
                </div>
            @endif
            @if (Session::has('product_delete'))
                <div class="alert alert-success"><em>{!! session('product_delete') !!}</em>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times</span></button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        @foreach ($product as $item)
                            <div class="col-xs-18 col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('assets/img/products/' . $item->image) }}" width="150px"
                                        height="150px" alt="">
                                    <div class="caption">
                                        <h4>{{ $item->name }}</h4>
                                        <p>{{ $item->description }}</p>
                                        <p><strong>Price: </strong> {{ $item->price }}$</p>
                                        <p class="btn-holder">
                                            <a href="{{ route('add.to.cart', $item->id) }}"
                                                class="btn btn-warning btn-block text-center" role="button">Add to cart</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
