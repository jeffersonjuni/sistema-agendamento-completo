import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import ptBrLocale from "@fullcalendar/core/locales/pt-br";

const calendarEl = document.getElementById("calendar");

if (calendarEl) {
    const events = JSON.parse(calendarEl.dataset.events);

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],

        locale: ptBrLocale,

        initialView: "dayGridMonth",

        height: "auto",

        events,

        headerToolbar: {
            left: "prev,next today",

            center: "title",

            right: "dayGridMonth",
        },

        buttonText: {
            today: "Hoje",

            month: "Mês",
        },

        eventDisplay: "block",

        eventClassNames() {
            return ["cursor-pointer", "rounded-lg"];
        },

        eventMouseEnter(info) {
            info.el.style.transform = "scale(1.03)";

            info.el.style.transition = ".2s";
        },

        eventMouseLeave(info) {
            info.el.style.transform = "scale(1)";
        },

        eventClick(info) {
            alert(
                `
Cliente:
${info.event.extendedProps.client}


Serviço:
${info.event.extendedProps.service}


Horário:
${info.event.extendedProps.time}


Status:
${info.event.extendedProps.status}
                        `,
            );
        },
    });

    calendar.render();
}
