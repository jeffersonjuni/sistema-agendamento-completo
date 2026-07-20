@props([
    'title',
    'chartId',
])

<x-ui.card
    class="
        p-6
    "
>

    <div
        class="
            flex
            items-center
            justify-between
            mb-6
        "
    >

        <h2
            class="
                text-lg
                font-semibold
            "
        >
            {{ $title }}
        </h2>

    </div>

    <div
        class="
            relative
            h-80
        "
    >

        <canvas id="{{ $chartId }}"></canvas>

    </div>

</x-ui.card>
