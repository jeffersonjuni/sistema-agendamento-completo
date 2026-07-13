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

    const today = new Date();

    today.setHours(0, 0, 0, 0);

    function updateSummary() {
        const selectedService = document.querySelector(
            'input[name="service_id"]:checked',
        );

        if (selectedService) {
            const card = selectedService.closest("label");

            const name = card.querySelector("h3")?.textContent;

            const duration = card.querySelector("p:last-child")?.textContent;

            summaryService.textContent = name;

            summaryDuration.textContent = duration;
        }

        if (selectedDate) {
            summaryDate.textContent = selectedDate.toLocaleDateString("pt-BR");
        }

        if (timeInput.value) {
            summaryTime.textContent = timeInput.value;
        }
    }

    function renderCalendar() {
        calendar.innerHTML = "";

        const year = currentDate.getFullYear();

        const month = currentDate.getMonth();

        const firstDay = new Date(year, month, 1).getDay();

        const days = new Date(year, month + 1, 0).getDate();

        const header = document.createElement("div");

        header.className = `
            flex
            items-center
            justify-between
            mb-6
        `;

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

        grid.className = `
            calendar-grid
        `;

        ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"].forEach((day) => {
            const el = document.createElement("div");

            el.className = `
                text-sm
                font-semibold
                text-[var(--text-secondary)]
                p-2
            `;

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

            /*
             * Data passada
             */

            if (date < today) {
                button.disabled = true;

                button.classList.add("opacity-40", "cursor-not-allowed");
            }

            /*
             * Data selecionada
             */

            if (selectedDate && formatDate(date) === formatDate(selectedDate)) {
                button.classList.add(
                    "bg-[var(--primary)]",

                    "text-white",

                    "ring-2",

                    "ring-[var(--primary)]",
                );
            }

            button.addEventListener("click", () => {
                selectedDate = date;

                dateInput.value = formatDate(date);

                updateSummary();

                renderCalendar();

                renderTimes();
            });

            grid.appendChild(button);
        }

        calendar.appendChild(grid);

        document.getElementById("prev-month").onclick = () => {
            currentDate.setMonth(currentDate.getMonth() - 1);

            renderCalendar();
        };

        document.getElementById("next-month").onclick = () => {
            currentDate.setMonth(currentDate.getMonth() + 1);

            renderCalendar();
        };
    }

    function renderTimes() {
        timeContainer.innerHTML = "";

        timeInput.value = "";

        const times = [
            "08:00",
            "08:30",
            "09:00",
            "09:30",
            "10:00",
            "10:30",
            "11:00",
            "11:30",
            "13:00",
            "13:30",
            "14:00",
            "14:30",
            "15:00",
            "15:30",
            "16:00",
            "16:30",
            "17:00",
            "17:30",
        ];

        times.forEach((time) => {
            const button = document.createElement("button");

            button.type = "button";

            button.textContent = time;

            button.className = "btn btn-secondary";

            button.onclick = () => {
                timeInput.value = time;
                updateSummary();

                document
                    .querySelectorAll("#time-slots button")
                    .forEach((btn) => {
                        btn.classList.remove("btn-primary");
                    });

                button.classList.add("btn-primary");
            };

            timeContainer.appendChild(button);
        });
    }

    function formatDate(date) {
        return date.toISOString().split("T")[0];
    }

    document.querySelectorAll('input[name="service_id"]').forEach((input) => {
        input.addEventListener("change", updateSummary);
    });

    renderCalendar();
});
