@props([
    'title',
    'subtitle' => null,
])

<div class="page-header">

    <div>

        <h1 class="page-header-title">
            {{ $title }}
        </h1>


        @if($subtitle)

            <p class="page-header-subtitle">
                {{ $subtitle }}
            </p>

        @endif

    </div>


    <div>

        {{ $slot }}

    </div>

</div>
