@props([
    'variant' => 'primary',
])

@php
$variants = [
    'primary' => 'badge badge-primary',
    'success' => 'badge badge-success',
    'warning' => 'badge badge-warning',
    'danger' => 'badge badge-danger',
];
@endphp

<span
    {{ $attributes->merge([
        'class' => $variants[$variant] ?? $variants['primary']
    ]) }}
>
    {{ $slot }}
</span>
