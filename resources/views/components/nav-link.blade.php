@props(['active'])

@php
$classes = ($active ?? false)
            ? 'active'
            : '';
@endphp

<li {{ 'class=' . $classes }}>
    <a {{ $attributes }}>
        {{ $slot }}
    </a>
</li>
