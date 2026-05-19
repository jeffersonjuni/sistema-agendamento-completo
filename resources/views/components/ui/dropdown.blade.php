<div
    x-data="{ open: false }"
    style="position: relative;"
>

    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        @click.outside="open = false"
        x-transition

        class="card-default"

        style="
            position:absolute;
            top:calc(100% + 10px);
            right:0;

            min-width:220px;

            padding:12px;

            z-index:999;
        "
    >

        {{ $slot }}

    </div>

</div>
