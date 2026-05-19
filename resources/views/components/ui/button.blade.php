@props([
    'type' => 'button',
    'variant' => 'primary',
    'loading' => false,
])

@php
    $baseClasses = '
        inline-flex items-center justify-center gap-2
        px-4 py-3
        rounded-xl
        text-sm font-semibold
        transition-all duration-200
        disabled:opacity-50
        disabled:cursor-not-allowed
    ';

    $variants = [
        'primary' => '
            bg-primary
            text-primary-foreground
            hover:opacity-90
        ',

        'secondary' => '
            bg-secondary
            text-secondary-foreground
            hover:opacity-90
        ',

        'danger' => '
            bg-destructive
            text-destructive-foreground
            hover:opacity-90
        ',
    ];
@endphp

<button
    type="{{ $type }}"

    {{ $attributes->merge([
        'class' => $baseClasses . ' ' . $variants[$variant]
    ]) }}

    @disabled($loading)
>

    @if($loading)

        <span
            class="loader"
            style="
                width:18px;
                height:18px;
                border-width:2px;
            "
        ></span>

    @endif

    {{ $slot }}

</button>
