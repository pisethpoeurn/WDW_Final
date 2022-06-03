@extends('admin.layout')
@section('content')
<div class="container mt-5">
    <div class="container-fluid">
    <h3 class="title">Category Information</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Static Navigation</li>
        </ol>

        <a href="{{route('catecreate')}}" class="btn btn-success mb-2"><i class="fas fa-plus"></i></a>
        <div class="panel-body">
            @if(Session::has('category_create'))
            <div class="alert alert-success"><em>{!! session('category_create') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
            </div>
            @endif
            @if(Session::has('category_delete'))
            <div class="alert alert-success"><em>{!! session('category_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
            </div>
            @endif
            <table class="table table-striped task-table">
               <thead>
               <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
               </thead>
                <tbody id="searchResult">
                @foreach($categories as $cate)
                <tr>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td>{{$cate->description}}</td>
                    <td>
                        <div class="row">
                            <div class="col-2">
                                <a href="{{route('categoryedit',$cate->id)}}"><i class="fas fa-eye"></i></a> 
                            </div>
                            <div class="col-2">
                            <form action="{{route('catedestroy',$cate->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button style="border: none; color: red;"> <i class="fa fa-trash" onclick="return confirm('Are you sure?')"></i> </button>
                            </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>	
			<div style="height: 100vh;"></div>
			<div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
		</div>
    </div>
    @section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
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