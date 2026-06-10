@props([
    'type' => 'button',
    'variant' => 'primary',
    'loading' => false,
])

@php

$baseClasses = '

w-full

inline-flex
items-center
justify-center

px-4
py-3

rounded-xl

font-semibold
text-sm

transition-all
duration-200

shadow-md

disabled:opacity-50
disabled:cursor-not-allowed

cursor-pointer

';

$variants=[

'primary'=>'

bg-primary
text-primary-foreground

hover:opacity-90
hover:scale-[1.01]

',

'secondary'=>'

bg-secondary
text-secondary-foreground

hover:opacity-90

',

'danger'=>'

bg-destructive
text-destructive-foreground

hover:opacity-90

'

];

@endphp

<button
type="{{ $type }}"
{{ $attributes->merge([
'class'=>$baseClasses.' '.$variants[$variant]
]) }}
@disabled($loading)
>

@if($loading)

<span class="loader"></span>

@endif

{{ $slot }}

</button>
