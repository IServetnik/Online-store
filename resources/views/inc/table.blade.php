<div class="container products">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <h1><a href="{{ route('product.show', $product->name) }}">{{ ucfirst($product->name) }}</a></h1>
                        <h4>{{ $product->description }}</h4>
                        <b>Id: </b> {{ $product->id }} <br>
                        <b>Price: </b> {{ $product->price }} <del class="text text-danger">{{ $product->old_price}}</del><br>
                        <b>Category: </b> {{ $product->category_name }}<br>
                        <b>Type: </b>
                        @if (Auth::user() && Auth::user()->is_admin)
                            <td><a href="{{ route('type.show', $product->type->id) }}">{{ $product->type_name }}</a></td>
                        @else
                            <td>{{ $product->type_name }}</td>
                        @endif <br>
                        @if ($product->rating !== null)
                            <b>Rating: </b> {{ $product->rating }}<br>
                        @endif
                        <b>Brand: </b>{{ ucfirst($product->brand) }} <br>
                        <b>Color: </b>{{ ucfirst($product->color) }} <br>
                        <b>Sizes: </b>{{ $product->sizes }} <br>

                        <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{$product->name}}">Add to cart</button></div>
                        <div class="modal fade" id="modal-{{$product->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Choose size</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($product->sizeCollection as $size)
                                        <form>
                                            <div class="form-group">
                                                <input type="checkbox" value="{{$size}}" id="size-{{$product->name}}-{{$size}}" name="size" class="size-{{$product->name}}">
                                                <label class="form-check-label" for="size-{{$product->name}}-{{$size}}"> {{ strtoupper($size) }}</label>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>
                                <div data-product-name="{{ $product->name }}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary add-to-cart" data-product-name="{{ $product->name }}" data-dismiss="modal" data-route="{{ route('cart.add') }}">Add to cart</button>
                                    </div>
                                </div>
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
  
<div class="col-md-12 card-body div-pagination">
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>