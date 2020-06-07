<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="{{ route('main') }}">
            IS
        </a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('men.index') }}">Men</a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('women.index') }}">Women</a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('kids.index') }}">Kids</a>
        
        @auth
            <a class="py-2 d-none d-md-inline-block" href="{{ url('/home') }}">Home</a>
        @else
            <a class="py-2 d-none d-md-inline-block" href="{{ url('login') }}">Login</a>
            <a class="py-2 d-none d-md-inline-block" href="{{ url('register') }}">Register</a>
        @endauth
    </div>
</nav>