<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mb-4 box-shadow">
                <div class="card-body">
                    <h1><a href="{{ route('product.show', $product->name) }}">{{ ucfirst($product->name) }}</a></h1>
                    <b>Id: </b> {{ $product->id }} <br>
                    <b>Price: </b> {{ $product->price }} <del class="text text-danger">{{ $product->old_price}}</del><br>
                    <b>Category: </b> {{ $product->category_name }}<br>
                    <b>Type: </b>
                    @if (Auth::user() && Auth::user()->is_admin)
                        <td><a href="{{ route('type.show', $product->type->id) }}">{{ $product->type_name }}</a></td>
                    @else
                        <td>{{ $product->type_name }}</td>
                    @endif <br>
                    <b>Brand: </b>{{ ucfirst($product->brand) }} <br>
                    <b>Color: </b>{{ ucfirst($product->color) }} <br>

                    <a href="/" data-route="{{ route('cart.add') }}" data-product-name="{{ $product->name }}" class="btn btn-primary add-to-cart">Add to cart</a>
                </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
  
<div class="col-md-12 card-body ">
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>