<nav class="site-header sticky-top py-1" style="background-color: rgb(247, 247, 247)">
    <div class="container d-flex flex-md-row justify-content-between">
        <a class="py-2" href="{{ route('main') }}">
            IS
        </a>
        <a class="py-2" href="{{ route('men.all') }}">Men</a>
        <a class="py-2" href="{{ route('women.all') }}">Women</a>
        <a class="py-2" href="{{ route('kids.all') }}">Kids</a>
        
        <a class="py-2" href="{{ route('cart.index') }}">Cart</a>

        @auth
            <a class="py-2" href="{{ url('/home') }}">Home</a>
        @else
            <a class="py-2" href="{{ url('login') }}">Login</a>
            <a class="py-2" href="{{ url('register') }}">Register</a>
        @endauth
    </div>
</nav>