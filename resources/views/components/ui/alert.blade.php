@props([
    'variant' => 'success',
])

@php
    $variants = [
        'success' => '
            background: var(--success);
            color: var(--success-foreground);
        ',

        'warning' => '
            background: var(--warning);
            color: var(--warning-foreground);
        ',

        'danger' => '
            background: var(--destructive);
            color: var(--destructive-foreground);
        ',
    ];
@endphp

<div
    style="
        padding: 16px;
        border-radius: 14px;
        margin-bottom: 16px;

        {{ $variants[$variant] }}
    "
>
    {{ $slot }}
</div>
