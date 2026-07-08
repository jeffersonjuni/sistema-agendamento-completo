import DataTable from "datatables.net";

document.addEventListener("DOMContentLoaded", () => {

    const table = document.querySelector(".table-default");

    if (!table) return;

    new DataTable(table, {

        responsive: true,

        pageLength: 10,

        lengthMenu: [10, 25, 50],

        language: {

            search: "",

            searchPlaceholder: "Pesquisar serviço...",

            lengthMenu: "Mostrar _MENU_ registros",

            info: "Mostrando _START_ até _END_ de _TOTAL_ registros",

            infoEmpty: "Nenhum registro encontrado",

            zeroRecords: "Nenhum serviço encontrado",

            paginate: {

                previous: "←",

                next: "→",

            },

        },

    });

});
