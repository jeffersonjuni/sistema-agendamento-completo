@props([
    'title' => null,
])


<div x-data="{ open:false }">


    <div @click="open=true">

        {{ $trigger }}

    </div>



    <div
        x-cloak
        x-show="open"
        x-transition
        class="modal-overlay"
    >


        <div
            class="modal"
            @click.outside="open=false"
        >


            @if($title)

                <h3>
                    {{ $title }}
                </h3>

            @endif


            {{ $slot }}


        </div>


    </div>


</div>
