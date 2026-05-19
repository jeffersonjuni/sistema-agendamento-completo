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
    x-data="{ show: true }"

    x-show="show"

    x-init="
        setTimeout(() => show = false, 3000)
    "

    x-transition

    style="
        position:fixed;
        top:24px;
        right:24px;

        padding:16px 20px;

        border-radius:14px;

        box-shadow: var(--shadow-lg);

        z-index:9999;

        {{ $variants[$variant] }}
    "
>

    {{ $slot }}

</div>
