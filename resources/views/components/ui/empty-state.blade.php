@props([
    'title' => 'Nenhum registro encontrado',
    'description' => 'Não há dados disponíveis.',
])

<div
    class="card-default"
    style="
        text-align:center;
        padding:48px 24px;
    "
>

    <h3 style="margin-bottom:12px;">
        {{ $title }}
    </h3>

    <p style="color:var(--muted-foreground);">
        {{ $description }}
    </p>

</div>
