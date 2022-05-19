@props(['active'])

@php
$classes = $active ?? false ? 'flex items-center p-2 text-base font-normal rounded-lg bg-tertiary text-white' : 'flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-tertiary hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
