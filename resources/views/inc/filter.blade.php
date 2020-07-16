<div class="filter" style="border: 2px solid rgb(222, 226, 230);">
    <form action="{{ route("$category.type", $type->name) }}" method="GET">
        <div class="form-group filter-div">
            <label for="min_price"><h2>Price:</h2></label>
            <input type="text" class="form-control" id="min_price" value="{{ request()->input('min_price') }}" placeholder="Min Price" name="min_price">
            <input type="text" class="form-control" id="max_price" value="{{ request()->input('max_price') }}" placeholder="Max Price" name="max_price">
        </div>
        <div class="form-check filter-div">
            <input class="form-check-input" type="checkbox" selected id="discount" name="discount" @if (request()->filled('discount')) {{ 'checked' }} @endif>
            <label class="form-check-label" for="discount">
                Only with discount
            </label>
        </div><br>

        <h2>Color:</h2>
        <div class="form-check form-check-inline filter-div">
            <input class="form-check-input color" data-name="color" type="checkbox" value="white" id="white" name="color[]" @if (request()->has('color') && in_array('white', request()->input('color'))) {{ 'checked' }} @endif>
            <label class="form-check-label" for="white">White</label>
        </div>
        <div class="form-check form-check-inline filter-div">
            <input class="form-check-input color" data-name="color" type="checkbox" value="black" id="black" name="color[]" @if (request()->has('color') && in_array('black', request()->input('color'))) {{ 'checked' }} @endif>
            <label class="form-check-label" for="black">Black</label>
        </div>
        <div class="form-check form-check-inline filter-div">
            <input class="form-check-input color" data-name="color" type="checkbox" value="blue" id="blue" name="color[]" @if (request()->has('color') && in_array('blue', request()->input('color'))) {{ 'checked' }} @endif>
            <label class="form-check-label" for="blue">Blue</label>
        </div>
        <div class="form-check form-check-inline filter-div">
            <input class="form-check-input color" data-name="color" type="checkbox" value="red" id="red" name="color[]" @if (request()->has('color') && in_array('red', request()->input('color'))) {{ 'checked' }} @endif>
            <label class="form-check-label" for="red">Red</label>
        </div><br><br>

        <div class="form-group filter-div">
            <label for="brand"><h2>Brand:</h2></label>
            <input type="text" class="form-control" id="brand" value="{{ request()->input('brand') }}" placeholder="Brand" name="brand">
        </div>

        <div class="form-group filter-div">
            <label for="name"><h2>Name:</h2></label>
            <input type="text" class="form-control" id="name" value="{{ request()->input('name') }}" placeholder="Name" name="name">
        </div>

        <div class="filter-div">
            <a href="{{ route("$category.type", $type->name) }}" id="clear">Clear</a>
        </div>
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
</div>