<div class="table-container table-responsive">

    <table
        {{ $attributes->merge([
            'class' => 'table-default'
        ]) }}
    >

        {{ $slot }}

    </table>

</div>
