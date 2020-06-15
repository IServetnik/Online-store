@foreach ($types as $type)
    <a href="{{ route($category.'.type', strtolower($type)) }}">{{ ucfirst($type) }}</a>
@endforeach