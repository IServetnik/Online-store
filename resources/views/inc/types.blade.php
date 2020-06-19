@foreach ($types as $type)
    <a href="{{ route($category.'.type', strtolower($type->name)) }}">{{ ucfirst($type->name) }}</a>
@endforeach