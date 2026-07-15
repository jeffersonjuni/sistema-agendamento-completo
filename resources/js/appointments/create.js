document.addEventListener("DOMContentLoaded", () => {
    const calendar = document.getElementById("calendar");
    const dateInput = document.getElementById("appointment_date");
    const timeContainer = document.getElementById("time-slots");
    const timeInput = document.getElementById("appointment_time");

    const summaryService = document.getElementById("summary-service");
    const summaryDate = document.getElementById("summary-date");
    const summaryTime = document.getElementById("summary-time");
    const summaryDuration = document.getElementById("summary-duration");

    if (!calendar || !dateInput || !timeContainer || !timeInput) {
        return;
    }

    let currentDate = new Date();
    let selectedDate = null;

    let availableWeekdays = [];

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    function updateSummary() {
        const selectedService = document.querySelector(
            'input[name="service_id"]:checked',
        );

        if (selectedService) {
            const card = selectedService.closest("label");

            summaryService.textContent =
                card.querySelector("h3")?.textContent ?? "-";

            summaryDuration.textContent =
                card.querySelector("p:last-child")?.textContent ?? "-";
        }

        summaryDate.textContent = selectedDate
            ? selectedDate.toLocaleDateString("pt-BR")
            : "Nenhuma data selecionada.";

        summaryTime.textContent = timeInput.value
            ? timeInput.value
            : "Nenhum horário selecionado.";
    }

    async function loadSchedules() {
        const response = await fetch("/client/appointments/schedules");

        const schedules = await response.json();

        availableWeekdays = schedules
            .filter((schedule) => schedule.is_open)
            .map((schedule) => schedule.weekday);
    }

    function renderCalendar() {
        calendar.innerHTML = "";

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        const firstDay = new Date(year, month, 1).getDay();

        const days = new Date(year, month + 1, 0).getDate();

        const header = document.createElement("div");

        header.className = "flex items-center justify-between mb-6";

        header.innerHTML = `

            <button
                type="button"
                id="prev-month"
                class="btn btn-secondary"
            >
                ‹
            </button>

            <h3 class="font-semibold capitalize">
                ${currentDate.toLocaleDateString("pt-BR", {
                    month: "long",
                    year: "numeric",
                })}
            </h3>

            <button
                type="button"
                id="next-month"
                class="btn btn-secondary"
            >
                ›
            </button>

        `;

        calendar.appendChild(header);

        const grid = document.createElement("div");

        grid.className = "calendar-grid";

        ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"].forEach((day) => {
            const el = document.createElement("div");

            el.className =
                "text-sm font-semibold text-[var(--text-secondary)] p-2";

            el.textContent = day;

            grid.appendChild(el);
        });

        for (let i = 0; i < firstDay; i++) {
            grid.appendChild(document.createElement("div"));
        }

        for (let day = 1; day <= days; day++) {
            const button = document.createElement("button");

            const date = new Date(year, month, day);

            button.type = "button";

            button.textContent = day;

            button.className = `
                h-10
                w-10
                mx-auto
                rounded-lg
                flex
                items-center
                justify-center
                transition
                hover:bg-[var(--surface-secondary)]
            `;

            if (date < today) {
                button.disabled = true;

                button.classList.add("opacity-40", "cursor-not-allowed");
            }

            const weekday = date.getDay() === 0 ? 7 : date.getDay();

            if (!availableWeekdays.includes(weekday)) {
                button.disabled = true;

                button.title = "Dia sem expediente";

                button.classList.add("opacity-40", "cursor-not-allowed");
            }

            if (selectedDate && formatDate(date) === formatDate(selectedDate)) {
                button.classList.add(
                    "bg-[var(--primary)]",
                    "text-white",
                    "ring-2",
                    "ring-[var(--primary)]",
                );
            }

            button.onclick = () => {
                if (button.disabled) {
                    return;
                }

                selectedDate = date;

                dateInput.value = formatDate(date);

                renderCalendar();

                renderTimes();

                updateSummary();
            };

            grid.appendChild(button);
        }

        calendar.appendChild(grid);

        document.getElementById("prev-month").onclick = () => {
            const currentMonth = new Date(
                today.getFullYear(),
                today.getMonth(),
                1,
            );

            const selectedMonth = new Date(
                currentDate.getFullYear(),
                currentDate.getMonth(),
                1,
            );

            if (selectedMonth <= currentMonth) {
                return;
            }

            currentDate.setMonth(currentDate.getMonth() - 1);

            renderCalendar();
        };

        document.getElementById("next-month").onclick = () => {
            currentDate.setMonth(currentDate.getMonth() + 1);

            renderCalendar();
        };
    }

    async function renderTimes() {
        timeContainer.innerHTML = `

        <p class="text-sm text-[var(--text-secondary)]">
            Carregando horários disponíveis...
        </p>

    `;

        timeInput.value = "";

        const service = document.querySelector(
            'input[name="service_id"]:checked',
        );

        if (!service) {
            timeContainer.innerHTML = `
                <p class="text-sm text-[var(--text-secondary)]">
                    Escolha um serviço primeiro.
                </p>
            `;

            return;
        }

        let times = [];

        try {
            const response = await fetch(
                `/client/appointments/available-times?date=${dateInput.value}&service=${service.value}`,
            );

            if (!response.ok) {
                throw new Error("Erro ao buscar horários.");
            }

            times = await response.json();
        } catch (error) {
            timeContainer.innerHTML = `

        <p class="text-sm text-red-500">

            Não foi possível carregar os horários.

        </p>

    `;

            return;
        }

        if (times.length === 0) {
            timeContainer.innerHTML = `

        <p class="text-sm text-[var(--text-secondary)]">

            Nenhum horário disponível para esta data.

            <br>

            Escolha outro dia.

        </p>

    `;

            return;
        }

        times.forEach((time) => {
            const button = document.createElement("button");

            button.type = "button";

            button.textContent = time;

            button.className = `

    btn

    btn-secondary

    transition

    hover:scale-105

`;

            button.onclick = () => {
                document
                    .querySelectorAll("#time-slots button")
                    .forEach((btn) => btn.classList.remove("btn-primary"));

                button.classList.add("btn-primary");

                timeInput.value = time;

                updateSummary();
            };

            timeContainer.appendChild(button);
        });
    }

    function formatDate(date) {
        return date.toISOString().split("T")[0];
    }

    document.querySelectorAll('input[name="service_id"]').forEach((input) => {
        input.addEventListener("change", () => {
            updateSummary();

            if (selectedDate) {
                renderTimes();
            }
        });
    });

    (async () => {
        await loadSchedules();

        renderCalendar();

        updateSummary();
    })();
});
