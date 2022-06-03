@extends('layouts.app')

@section('content')

{{-- <body class="bg-success"> --}}
    <div id="layoutAuthentication" >
        <div id="layoutAuthentication_content ">
            <main>
                <div class="container">
                    <div class="row justify-content-center ">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success"><em>{!! session('success') !!}</em>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>
                                    </div>
                                    @endif
                                    @if(Session::has('errors'))
                                    <div class="alert alert-danger"><em>{!! $errors->first() !!}</em>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>
                                    </div>
                                    @endif
                                    <form action="{{ route('be.login.post') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" name="remember" id="inputRememberPassword" type="checkbox" value="1" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    
</main>


@endsection
