@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" @class([
    'block px-4 py-2 text-sm',
    'bg-gray-900 text-white' => $active,
    'text-gray-300 hover:bg-gray-700 hover:text-white' => !$active,
])>
    {{ $slot }}
</a>