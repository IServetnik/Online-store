<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Old Price</th>
            <th scope="col">Category</th>
            <th scope="col">Type</th>
            <th scope="col">Brand</th>
            <th scope="col">Color</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td><a href="{{ route('product.show', $product->name) }}">{{ $product->name }}</a></td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->old_price }}</td>
                <td>{{ $product->category_name }}</td>
                <td>{{ $product->type->name }}</td>
                <td>{{ $product->brand }}</td>
                <td>{{ $product->color }}</td>
            </tr>
        @endforeach
    </tbody>
</table>