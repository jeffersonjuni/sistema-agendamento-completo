@props([
    'variant' => 'success',
])

@php
    $variants = [
        'success' => 'badge badge-success',
        'warning' => 'badge badge-warning',
        'danger' => 'badge badge-danger',
    ];
@endphp

<span
    {{ $attributes->merge([
        'class' => $variants[$variant]
    ]) }}
>
    {{ $slot }}
</span>
