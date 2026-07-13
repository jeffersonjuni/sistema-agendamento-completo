@props([
    'service',
    'selected' => false,
])


<label
    class="
        block
        cursor-pointer
    "
>


    <input
        type="radio"
        name="service_id"
        value="{{ $service->id }}"
        class="hidden peer"
        @checked($selected)
    >




    <div
        class="
            border
            rounded-xl
            p-5
            transition
            peer-checked:ring-2
            peer-checked:ring-[var(--primary)]
            peer-checked:border-[var(--primary)]
            hover:border-[var(--primary)]
            bg-[var(--surface)]
        "
    >



        <div class="flex justify-between items-start gap-4">


            <div>


                <h3 class="font-semibold text-lg">

                    {{ $service->name }}

                </h3>



                @if($service->description)

                    <p class="
                        text-sm
                        text-[var(--text-secondary)]
                        mt-2
                    ">

                        {{ $service->description }}

                    </p>

                @endif


            </div>



            <div class="text-right">


                <p class="font-semibold">

                    R$ {{ number_format($service->price, 2, ',', '.') }}

                </p>



                <p class="
                    text-sm
                    text-[var(--text-secondary)]
                ">

                    {{ $service->duration }} min

                </p>


            </div>


        </div>


    </div>



</label>
