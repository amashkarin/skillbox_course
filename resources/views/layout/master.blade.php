<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel Skillbox project">
    <meta name="author" content="Alexey Mashkarin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $title = $title ?? 'Skillbox Laravel';
    @endphp
    <title>{{ $title }}</title>

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/">Laravel Skillbox</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                </a>
                @guest
                        <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                            <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <span class="font-weight-bold mr-4">
                        {{ Auth::user()->name }}
                    </span>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </header>

    @include('layout.nav')
</div>
@include('layout.messages')
<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                {{ $title }}
            </h3>

            <div class="blog-post">
                @yield('content')
            </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        @section('aside')
            @include('layout.aside')
        @show
    </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer container border-top">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        Holder.addTheme('thumb', {
            bg: '#55595c',
            fg: '#eceeef',
            text: 'Thumbnail'
        });
    </script>
</body>
</html>
