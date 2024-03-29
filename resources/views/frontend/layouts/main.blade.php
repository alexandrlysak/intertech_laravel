<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Intertech Test | Blog Home</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/assets/css/blog-home.css') }}" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Intertech L</a>

        @auth
        <span class="navbar-brand">Welcome</span>
            <form action="{{ url('/logout') }}" method="post">
                {{ csrf_field() }}
                <button class="btn btn-link" type="submit">Logout</button>
            </form>
        @endauth

        @guest
            <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-facebook"></i> Facebook</a> &nbsp;&nbsp;
            <a href="{{ url('/auth/redirect/github') }}" class="btn btn-sm btn-outline-success"><i class="fa fa-github"></i> Github</a>
        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <input type="hidden" id="currentPaginationPage" value="2" autocomplete="off">

        @section('content')

        @show

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            @section('sorting')
            @show

            <!-- Categories Widget -->
            <div class="card my-4">

                @if (count($categories) > 0)
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    @for ($i = 0; $i < count($categories)/2; $i++)
                                        <li>
                                            <a href="{{ route('frontend-category', ['slug' => $categories[$i]->slug]) }}">{{ $categories[$i]->title }}</a>
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    @for ($i = count($categories)/2; $i < count($categories); $i++)
                                        <li>
                                            <a href="{{ route('frontend-category', ['slug' => $categories[$i]->slug]) }}">{{ $categories[$i]->title }}</a>
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the
                    new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
</footer>

@section('scripts')
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('/assets/js/custom.js') }}"></script>

@show

</body>

</html>
