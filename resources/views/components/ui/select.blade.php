<select
    {{ $attributes->merge([
        'class' => 'input-default'
    ]) }}
>
    {{ $slot }}
</select>
