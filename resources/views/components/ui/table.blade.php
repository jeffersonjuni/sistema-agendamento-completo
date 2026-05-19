<div style="overflow-x:auto;">

    <table
        {{ $attributes->merge([
            'class' => 'table-default'
        ]) }}
    >
        {{ $slot }}
    </table>

</div>
