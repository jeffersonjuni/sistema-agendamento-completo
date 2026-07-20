@props([
    'title',
    'value',
    'icon' => 'bar-chart-3',
    'variant' => 'primary',
])


@php

$variants = [

    'primary' => [
        'background' => 'bg-primary/10',
        'text' => 'text-primary',
    ],

    'success' => [
        'background' => 'bg-success/10',
        'text' => 'text-success',
    ],

    'warning' => [
        'background' => 'bg-warning/10',
        'text' => 'text-warning',
    ],

    'danger' => [
        'background' => 'bg-destructive/10',
        'text' => 'text-destructive',
    ],

];

@endphp


<x-ui.card
    class="
        p-6

        flex
        items-center
        justify-between

        gap-6

        transition-all
        duration-300

        hover:-translate-y-1
        hover:shadow-xl
    "
>


    <div class="space-y-2">


        <p
            class="
                text-sm
                font-medium
                text-muted-foreground
            "
        >

            {{ $title }}

        </p>



        <h2
            class="
                text-3xl
                font-bold
            "
        >

            {{ $value }}

        </h2>


    </div>



    <div
        class="
            w-14
            h-14

            rounded-2xl

            flex
            items-center
            justify-center

            {{ $variants[$variant]['background'] }}
        "
    >


        <i
            data-lucide="{{ $icon }}"

            class="
                w-7
                h-7

                {{ $variants[$variant]['text'] }}
            "
        ></i>


    </div>


</x-ui.card>
