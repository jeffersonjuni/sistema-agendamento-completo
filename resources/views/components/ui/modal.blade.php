@props([
    'name',
])

<div
    x-data="{ open: false }"
>

    <div @click="open = true">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition
        style="
            position: fixed;
            inset: 0;

            background: rgba(0,0,0,0.5);

            display:flex;
            align-items:center;
            justify-content:center;

            z-index:9999;
        "
    >

        <div
            class="card-default"
            style="
                width:100%;
                max-width:500px;
            "
        >

            {{ $slot }}

            <div style="margin-top:24px;">
                <x-ui.button
                    variant="secondary"
                    @click="open = false"
                >
                    Fechar
                </x-ui.button>
            </div>

        </div>

    </div>

</div>
