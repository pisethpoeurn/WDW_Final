@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <header class="mb-4">
            <!-- Post title-->
            <h1 class="fw-bolder mb-1">Welcome to Blog Post!</h1>
            <!-- Post meta content-->
            <div class="text-muted fst-italic mb-2">Posted on January 1, 2021 by Start Bootstrap</div>
            <!-- Post categories-->
            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
        </header>

        <h1 class="mt-4 title">Post</h1>
        <div class="card mb-4">
            <div class="card-body">
                @if (Session::has('post_create'))
                    <div class="alert alert-success"><em>{!! session('post_create') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times</span></button>
                    </div>
                @endif
                @if (Session::has('post_update'))
                    <div class="alert alert-success"><em>{!! session('post_update') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times</span></button>
                    </div>
                @endif
                @if (Session::has('post_delete'))
                    <div class="alert alert-success"><em>{!! session('post_delete') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times</span></button>
                    </div>
                @endif
                <a href="{{ route('posts.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i></a>
                <!-- @if (count($posts) > 0) -->
                <div class="panel panel-default">
                    <div class="panel-heading title">
                        All Posts
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>

                            </thead>

                            <tbody id="searchResult">
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            <div>{!! $post->title !!}</div>
                                        </td>
                                        <td>
                                            <div>{!! $post->author !!}</div>
                                        </td>
                                        <td>
                                            <div>{!! $post->category->name !!}</div>
                                        </td>
                                        <td>
                                            <img src="{{ asset('assets/img/posts/' . $post->image) }}" width="50px"
                                                class="rounded-circle" height="50px" />
                                        </td>
                                        <td>
                                            <div>{!! $post->description !!}</div>
                                        </td>

                                        <td>
                                            <div class="row">
                                                <div class="col-2">
                                                    <a href="{{ route('posts.edit', $post->id) }}"><i
                                                            class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="col-2">
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button style="border: none; color: red;"> <i class="fa fa-trash"
                                                                onclick="return confirm('Are you sure?')"></i> </button>
                                                    </form>
                                                </div>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- @endif -->
            </div>
        </div>

    </div>

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#searchResult tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection


@endsection
