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
    class="alert-component"
    style="
        padding:16px;
        border-radius:14px;
        margin-bottom:16px;

        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;

        transition:
            opacity .3s,
            transform .3s;

        {{ $variants[$variant] }}
    "
>

    <div>

        {{ $slot }}

    </div>

    <button
        type="button"
        class="alert-close"
        aria-label="Fechar alerta"
    >
        ✕
    </button>

</div>
