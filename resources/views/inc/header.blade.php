<nav class="site-header sticky-top py-1" style="background-color: rgb(247, 247, 247)">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="{{ route('main.index') }}">
            IS
        </a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('men.all') }}">Men</a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('women.all') }}">Women</a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('kids.all') }}">Kids</a>
        
        @auth
            <a class="py-2 d-none d-md-inline-block" href="{{ url('/home') }}">Home</a>
        @else
            <a class="py-2 d-none d-md-inline-block" href="{{ url('login') }}">Login</a>
            <a class="py-2 d-none d-md-inline-block" href="{{ url('register') }}">Register</a>
        @endauth
    </div>
</nav>